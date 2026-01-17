<?php
/**
 * Session Manager - Handles user sessions and virtual coins
 * Works with or without database - uses PHP sessions as fallback
 */

class SessionManager {
    private $sessionId;
    private $db;
    private $useDatabase;

    public function __construct() {
        $this->db = Database::getInstance();
        $this->useDatabase = $this->db->isAvailable();
        $this->sessionId = $this->getOrCreateSession();
    }

    /**
     * Get or create a session for the user
     */
    private function getOrCreateSession() {
        if ($this->useDatabase) {
            return $this->getOrCreateDatabaseSession();
        } else {
            return $this->getOrCreatePHPSession();
        }
    }

    /**
     * Database-based session
     */
    private function getOrCreateDatabaseSession() {
        $conn = $this->db->getConnection();
        
        // Check if session cookie exists
        if (isset($_COOKIE['casino_session_id'])) {
            $sessionId = $_COOKIE['casino_session_id'];
            
            // Verify session exists in database
            $result = $conn->query("SELECT id FROM sessions WHERE id = '" . $conn->real_escape_string($sessionId) . "'");
            if ($result && $result->num_rows > 0) {
                return $sessionId;
            }
        }
        
        // Create new session
        $sessionId = $this->generateSessionId();
        $ipAddress = $_SERVER['REMOTE_ADDR'] ?? '';
        $userAgent = $_SERVER['HTTP_USER_AGENT'] ?? '';
        
        $stmt = $conn->prepare("INSERT INTO sessions (id, ip_address, user_agent, virtual_coins) VALUES (?, ?, ?, ?)");
        $coins = INITIAL_CREDITS;
        $stmt->bind_param("sssi", $sessionId, $ipAddress, $userAgent, $coins);
        $stmt->execute();
        $stmt->close();
        
        // Set cookie
        setcookie('casino_session_id', $sessionId, time() + COOKIE_LIFETIME, '/', '', false, true);
        
        return $sessionId;
    }

    /**
     * PHP session-based (no database)
     */
    private function getOrCreatePHPSession() {
        if (!isset($_SESSION['casino_session_id'])) {
            $_SESSION['casino_session_id'] = $this->generateSessionId();
            $_SESSION['virtual_coins'] = INITIAL_CREDITS;
            $_SESSION['last_bonus_date'] = null;
            $_SESSION['game_stats'] = [];
            $_SESSION['transactions'] = [];
        }
        return $_SESSION['casino_session_id'];
    }

    /**
     * Generate unique session ID
     */
    private function generateSessionId() {
        return 'sess_' . bin2hex(random_bytes(16)) . '_' . time();
    }

    /**
     * Get current session ID
     */
    public function getSessionId() {
        return $this->sessionId;
    }

    /**
     * Get virtual coin balance
     */
    public function getBalance() {
        if ($this->useDatabase) {
            $conn = $this->db->getConnection();
            $result = $conn->query("SELECT virtual_coins FROM sessions WHERE id = '" . $conn->real_escape_string($this->sessionId) . "'");
            if ($result && $result->num_rows > 0) {
                $row = $result->fetch_assoc();
                return (int)$row['virtual_coins'];
            }
            return 0;
        } else {
            return isset($_SESSION['virtual_coins']) ? (int)$_SESSION['virtual_coins'] : INITIAL_CREDITS;
        }
    }

    /**
     * Add coins to balance
     */
    public function addCoins($amount, $reason = 'Game Win') {
        $amount = (int)$amount;
        if ($amount <= 0) return false;
        
        $currentBalance = $this->getBalance();
        $newBalance = $currentBalance + $amount;
        
        if ($this->useDatabase) {
            $conn = $this->db->getConnection();
            $stmt = $conn->prepare("UPDATE sessions SET virtual_coins = ? WHERE id = ?");
            $stmt->bind_param("is", $newBalance, $this->sessionId);
            $result = $stmt->execute();
            $stmt->close();
            
            if ($result) {
                $this->logTransaction('ADD', $amount, $reason, $newBalance);
            }
            return $result;
        } else {
            $_SESSION['virtual_coins'] = $newBalance;
            $this->logTransaction('ADD', $amount, $reason, $newBalance);
            return true;
        }
    }

    /**
     * Deduct coins from balance
     */
    public function deductCoins($amount, $reason = 'Game Bet') {
        $amount = (int)$amount;
        if ($amount <= 0) return false;
        
        $currentBalance = $this->getBalance();
        if ($currentBalance < $amount) {
            return false; // Insufficient balance
        }
        
        $newBalance = $currentBalance - $amount;
        
        if ($this->useDatabase) {
            $conn = $this->db->getConnection();
            $stmt = $conn->prepare("UPDATE sessions SET virtual_coins = ? WHERE id = ?");
            $stmt->bind_param("is", $newBalance, $this->sessionId);
            $result = $stmt->execute();
            $stmt->close();
            
            if ($result) {
                $this->logTransaction('DEDUCT', $amount, $reason, $newBalance);
            }
            return $result;
        } else {
            $_SESSION['virtual_coins'] = $newBalance;
            $this->logTransaction('DEDUCT', $amount, $reason, $newBalance);
            return true;
        }
    }

    /**
     * Claim daily bonus
     */
    public function claimDailyBonus() {
        $today = date('Y-m-d');
        
        if ($this->useDatabase) {
            $conn = $this->db->getConnection();
            $result = $conn->query("SELECT last_bonus_date FROM sessions WHERE id = '" . $conn->real_escape_string($this->sessionId) . "'");
            if ($result && $result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $lastBonusDate = $row['last_bonus_date'];
                
                if ($lastBonusDate === $today) {
                    return ['success' => false, 'message' => 'Daily bonus already claimed'];
                }
            }
            
            $this->addCoins(DAILY_BONUS_CREDITS, 'Daily Bonus');
            
            $stmt = $conn->prepare("UPDATE sessions SET last_bonus_date = ? WHERE id = ?");
            $stmt->bind_param("ss", $today, $this->sessionId);
            $stmt->execute();
            $stmt->close();
        } else {
            $lastBonusDate = $_SESSION['last_bonus_date'] ?? null;
            
            if ($lastBonusDate === $today) {
                return ['success' => false, 'message' => 'Daily bonus already claimed'];
            }
            
            $this->addCoins(DAILY_BONUS_CREDITS, 'Daily Bonus');
            $_SESSION['last_bonus_date'] = $today;
        }
        
        return ['success' => true, 'message' => 'Daily bonus claimed!', 'amount' => DAILY_BONUS_CREDITS];
    }

    /**
     * Reset credits when balance is low
     */
    public function resetCredits() {
        $currentBalance = $this->getBalance();
        
        if ($currentBalance > 0) {
            return ['success' => false, 'message' => 'Credits can only be reset when balance is depleted'];
        }
        
        if ($this->useDatabase) {
            $conn = $this->db->getConnection();
            $amount = RESET_CREDITS;
            $stmt = $conn->prepare("UPDATE sessions SET virtual_coins = ? WHERE id = ?");
            $stmt->bind_param("is", $amount, $this->sessionId);
            $result = $stmt->execute();
            $stmt->close();
            
            if ($result) {
                $this->logTransaction('RESET', RESET_CREDITS, 'Credit Reset', RESET_CREDITS);
                return ['success' => true, 'message' => 'Credits reset successfully!', 'amount' => RESET_CREDITS];
            }
            return ['success' => false, 'message' => 'Failed to reset credits'];
        } else {
            $_SESSION['virtual_coins'] = RESET_CREDITS;
            $this->logTransaction('RESET', RESET_CREDITS, 'Credit Reset', RESET_CREDITS);
            return ['success' => true, 'message' => 'Credits reset successfully!', 'amount' => RESET_CREDITS];
        }
    }

    /**
     * Log coin transaction
     */
    private function logTransaction($type, $amount, $reason, $balanceAfter) {
        if ($this->useDatabase) {
            $conn = $this->db->getConnection();
            $stmt = $conn->prepare("INSERT INTO coin_transactions (session_id, transaction_type, amount, reason, balance_after) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("ssisi", $this->sessionId, $type, $amount, $reason, $balanceAfter);
            $stmt->execute();
            $stmt->close();
        } else {
            if (!isset($_SESSION['transactions'])) {
                $_SESSION['transactions'] = [];
            }
            $_SESSION['transactions'][] = [
                'type' => $type,
                'amount' => $amount,
                'reason' => $reason,
                'balance_after' => $balanceAfter,
                'timestamp' => time()
            ];
        }
    }

    /**
     * Record game statistics
     */
    public function recordGameStat($gameType, $betAmount, $winAmount, $result) {
        if ($this->useDatabase) {
            $conn = $this->db->getConnection();
            $stmt = $conn->prepare("INSERT INTO game_statistics (session_id, game_type, bet_amount, win_amount, result) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("ssiis", $this->sessionId, $gameType, $betAmount, $winAmount, $result);
            $stmt->execute();
            $stmt->close();
        } else {
            if (!isset($_SESSION['game_stats'])) {
                $_SESSION['game_stats'] = [];
            }
            $_SESSION['game_stats'][] = [
                'game_type' => $gameType,
                'bet_amount' => $betAmount,
                'win_amount' => $winAmount,
                'result' => $result,
                'timestamp' => time()
            ];
        }
    }

    /**
     * Get game statistics
     */
    public function getGameStats($gameType = null) {
        if ($this->useDatabase) {
            $conn = $this->db->getConnection();
            $query = "SELECT game_type, COUNT(*) as plays, SUM(CASE WHEN result = 'win' THEN 1 ELSE 0 END) as wins, SUM(bet_amount) as total_bet, SUM(win_amount) as total_won FROM game_statistics WHERE session_id = '" . $conn->real_escape_string($this->sessionId) . "'";
            
            if ($gameType) {
                $query .= " AND game_type = '" . $conn->real_escape_string($gameType) . "'";
            }
            
            $query .= " GROUP BY game_type";
            
            $result = $conn->query($query);
            $stats = [];
            
            if ($result) {
                while ($row = $result->fetch_assoc()) {
                    $stats[] = $row;
                }
            }
            
            return $stats;
        } else {
            return $_SESSION['game_stats'] ?? [];
        }
    }
}
?>
