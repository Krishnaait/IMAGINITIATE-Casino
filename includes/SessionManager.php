<?php
/**
 * Session Manager - Handles user sessions and virtual coins
 */

class SessionManager {
    private $sessionId;
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
        $this->sessionId = $this->getOrCreateSession();
    }

    /**
     * Get or create a session for the user
     */
    private function getOrCreateSession() {
        // Check if session cookie exists
        if (isset($_COOKIE['casino_session_id'])) {
            $sessionId = $_COOKIE['casino_session_id'];
            
            // Verify session exists in database
            $result = $this->db->query("SELECT id FROM sessions WHERE id = '" . $this->db->real_escape_string($sessionId) . "'");
            if ($result && $result->num_rows > 0) {
                return $sessionId;
            }
        }
        
        // Create new session
        $sessionId = $this->generateSessionId();
        $ipAddress = $_SERVER['REMOTE_ADDR'] ?? '';
        $userAgent = $_SERVER['HTTP_USER_AGENT'] ?? '';
        
        $stmt = $this->db->prepare("INSERT INTO sessions (id, ip_address, user_agent, virtual_coins) VALUES (?, ?, ?, ?)");
        $coins = INITIAL_CREDITS;
        $stmt->bind_param("sssi", $sessionId, $ipAddress, $userAgent, $coins);
        $stmt->execute();
        $stmt->close();
        
        // Set cookie
        setcookie('casino_session_id', $sessionId, time() + COOKIE_LIFETIME, '/', '', false, true);
        
        // Log transaction
        $this->logTransaction('INITIAL', INITIAL_CREDITS, 'Initial Credits', INITIAL_CREDITS);
        
        return $sessionId;
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
        $result = $this->db->query("SELECT virtual_coins FROM sessions WHERE id = '" . $this->db->real_escape_string($this->sessionId) . "'");
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return (int)$row['virtual_coins'];
        }
        return 0;
    }

    /**
     * Add coins to balance
     */
    public function addCoins($amount, $reason = 'Game Win') {
        $amount = (int)$amount;
        if ($amount <= 0) return false;
        
        $currentBalance = $this->getBalance();
        $newBalance = $currentBalance + $amount;
        
        $stmt = $this->db->prepare("UPDATE sessions SET virtual_coins = ? WHERE id = ?");
        $stmt->bind_param("is", $newBalance, $this->sessionId);
        $result = $stmt->execute();
        $stmt->close();
        
        if ($result) {
            $this->logTransaction('ADD', $amount, $reason, $newBalance);
        }
        
        return $result;
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
        
        $stmt = $this->db->prepare("UPDATE sessions SET virtual_coins = ? WHERE id = ?");
        $stmt->bind_param("is", $newBalance, $this->sessionId);
        $result = $stmt->execute();
        $stmt->close();
        
        if ($result) {
            $this->logTransaction('DEDUCT', $amount, $reason, $newBalance);
        }
        
        return $result;
    }

    /**
     * Claim daily bonus
     */
    public function claimDailyBonus() {
        $today = date('Y-m-d');
        
        $result = $this->db->query("SELECT last_bonus_date FROM sessions WHERE id = '" . $this->db->real_escape_string($this->sessionId) . "'");
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $lastBonusDate = $row['last_bonus_date'];
            
            // Check if bonus already claimed today
            if ($lastBonusDate === $today) {
                return ['success' => false, 'message' => 'Daily bonus already claimed'];
            }
        }
        
        // Add daily bonus
        $this->addCoins(DAILY_BONUS_CREDITS, 'Daily Bonus');
        
        // Update last bonus date
        $stmt = $this->db->prepare("UPDATE sessions SET last_bonus_date = ? WHERE id = ?");
        $stmt->bind_param("ss", $today, $this->sessionId);
        $stmt->execute();
        $stmt->close();
        
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
        
        $stmt = $this->db->prepare("UPDATE sessions SET virtual_coins = ? WHERE id = ?");
        $stmt->bind_param("is", $amount, $this->sessionId);
        $amount = RESET_CREDITS;
        $stmt->bind_param("is", $amount, $this->sessionId);
        $result = $stmt->execute();
        $stmt->close();
        
        if ($result) {
            $this->logTransaction('RESET', RESET_CREDITS, 'Credit Reset', RESET_CREDITS);
            return ['success' => true, 'message' => 'Credits reset successfully!', 'amount' => RESET_CREDITS];
        }
        
        return ['success' => false, 'message' => 'Failed to reset credits'];
    }

    /**
     * Log coin transaction
     */
    private function logTransaction($type, $amount, $reason, $balanceAfter) {
        $stmt = $this->db->prepare("INSERT INTO coin_transactions (session_id, transaction_type, amount, reason, balance_after) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssis i", $this->sessionId, $type, $amount, $reason, $balanceAfter);
        $stmt->execute();
        $stmt->close();
    }

    /**
     * Record game statistics
     */
    public function recordGameStat($gameType, $betAmount, $winAmount, $result) {
        $stmt = $this->db->prepare("INSERT INTO game_statistics (session_id, game_type, bet_amount, win_amount, result) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssii s", $this->sessionId, $gameType, $betAmount, $winAmount, $result);
        $stmt->execute();
        $stmt->close();
    }

    /**
     * Get game statistics
     */
    public function getGameStats($gameType = null) {
        $query = "SELECT game_type, COUNT(*) as plays, SUM(CASE WHEN result = 'win' THEN 1 ELSE 0 END) as wins, SUM(bet_amount) as total_bet, SUM(win_amount) as total_won FROM game_statistics WHERE session_id = '" . $this->db->real_escape_string($this->sessionId) . "'";
        
        if ($gameType) {
            $query .= " AND game_type = '" . $this->db->real_escape_string($gameType) . "'";
        }
        
        $query .= " GROUP BY game_type";
        
        $result = $this->db->query($query);
        $stats = [];
        
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $stats[] = $row;
            }
        }
        
        return $stats;
    }

    /**
     * Award achievement
     */
    public function awardAchievement($achievementName, $icon = 'badge.png') {
        $stmt = $this->db->prepare("INSERT INTO achievements (session_id, achievement_name, achievement_icon) VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE earned_at = NOW()");
        $stmt->bind_param("sss", $this->sessionId, $achievementName, $icon);
        return $stmt->execute();
    }

    /**
     * Get achievements
     */
    public function getAchievements() {
        $result = $this->db->query("SELECT achievement_name, achievement_icon, earned_at FROM achievements WHERE session_id = '" . $this->db->real_escape_string($this->sessionId) . "' ORDER BY earned_at DESC");
        $achievements = [];
        
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $achievements[] = $row;
            }
        }
        
        return $achievements;
    }
}
?>
