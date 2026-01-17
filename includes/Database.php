<?php
/**
 * Database Class - Handles all database operations
 * Now supports optional database mode - falls back to session-only if DB unavailable
 */

class Database {
    private $connection;
    private static $instance = null;
    private $useDatabase = false;

    private function __construct() {
        // Try to connect to database, but don't die if it fails
        try {
            // Check if database is configured
            if (!defined('DB_HOST') || empty(DB_HOST)) {
                throw new Exception("Database not configured");
            }

            $this->connection = @new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME, defined('DB_PORT') ? DB_PORT : 3306);
            
            if ($this->connection->connect_error) {
                throw new Exception("Connection failed: " . $this->connection->connect_error);
            }
            
            $this->connection->set_charset("utf8mb4");
            $this->useDatabase = true;
            
            // Initialize tables if database is available
            $this->initializeTables();
            
        } catch (Exception $e) {
            // Database not available - use session-only mode
            $this->useDatabase = false;
            $this->connection = null;
            error_log("Database unavailable, using session-only mode: " . $e->getMessage());
        }
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->connection;
    }

    public function isAvailable() {
        return $this->useDatabase && $this->connection !== null;
    }

    public function query($sql) {
        if (!$this->isAvailable()) {
            return false;
        }
        return @$this->connection->query($sql);
    }

    public function prepare($sql) {
        if (!$this->isAvailable()) {
            return false;
        }
        return @$this->connection->prepare($sql);
    }

    public function escape($string) {
        if (!$this->isAvailable()) {
            return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
        }
        return $this->connection->real_escape_string($string);
    }

    public function lastInsertId() {
        if (!$this->isAvailable()) {
            return 0;
        }
        return $this->connection->insert_id;
    }

    public function affectedRows() {
        if (!$this->isAvailable()) {
            return 0;
        }
        return $this->connection->affected_rows;
    }

    public function close() {
        if ($this->isAvailable()) {
            $this->connection->close();
        }
    }

    private function initializeTables() {
        if (!$this->isAvailable()) {
            return;
        }

        $db = $this->connection;
        
        // Sessions Table
        $sessions_table = "CREATE TABLE IF NOT EXISTS sessions (
            id VARCHAR(255) PRIMARY KEY,
            ip_address VARCHAR(45),
            user_agent VARCHAR(255),
            virtual_coins INT DEFAULT " . INITIAL_CREDITS . ",
            last_bonus_date DATE,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            INDEX idx_created (created_at)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
        
        // Game Statistics Table
        $game_stats_table = "CREATE TABLE IF NOT EXISTS game_statistics (
            id INT AUTO_INCREMENT PRIMARY KEY,
            session_id VARCHAR(255),
            game_type VARCHAR(50),
            bet_amount INT,
            win_amount INT,
            result VARCHAR(50),
            played_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            INDEX idx_game_type (game_type),
            INDEX idx_session (session_id)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
        
        // Coin Transactions Table
        $transactions_table = "CREATE TABLE IF NOT EXISTS coin_transactions (
            id INT AUTO_INCREMENT PRIMARY KEY,
            session_id VARCHAR(255),
            transaction_type VARCHAR(50),
            amount INT,
            reason VARCHAR(255),
            balance_after INT,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            INDEX idx_session (session_id),
            INDEX idx_created (created_at)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
        
        // Contact Submissions Table
        $contact_table = "CREATE TABLE IF NOT EXISTS contact_submissions (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255),
            email VARCHAR(255),
            subject VARCHAR(255),
            message TEXT,
            ip_address VARCHAR(45),
            submitted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
        
        // Execute table creation queries
        $tables = [
            $sessions_table,
            $game_stats_table,
            $transactions_table,
            $contact_table
        ];
        
        foreach ($tables as $table_sql) {
            @$db->query($table_sql);
        }
    }
}
?>
