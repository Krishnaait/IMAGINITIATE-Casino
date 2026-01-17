<?php
/**
 * Database Class - Handles all database operations
 */

class Database {
    private $connection;
    private static $instance = null;

    private function __construct() {
        try {
            $this->connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            
            if ($this->connection->connect_error) {
                throw new Exception("Connection failed: " . $this->connection->connect_error);
            }
            
            $this->connection->set_charset("utf8");
        } catch (Exception $e) {
            die("Database Error: " . $e->getMessage());
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

    public function query($sql) {
        return $this->connection->query($sql);
    }

    public function prepare($sql) {
        return $this->connection->prepare($sql);
    }

    public function escape($string) {
        return $this->connection->real_escape_string($string);
    }

    public function lastInsertId() {
        return $this->connection->insert_id;
    }

    public function affectedRows() {
        return $this->connection->affected_rows;
    }

    public function close() {
        if ($this->connection) {
            $this->connection->close();
        }
    }
}

/**
 * Initialize Database Tables
 */
function initializeDatabaseTables() {
    $db = Database::getInstance()->getConnection();
    
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
        FOREIGN KEY (session_id) REFERENCES sessions(id) ON DELETE CASCADE,
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
        FOREIGN KEY (session_id) REFERENCES sessions(id) ON DELETE CASCADE,
        INDEX idx_session (session_id),
        INDEX idx_created (created_at)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
    
    // Achievements Table
    $achievements_table = "CREATE TABLE IF NOT EXISTS achievements (
        id INT AUTO_INCREMENT PRIMARY KEY,
        session_id VARCHAR(255),
        achievement_name VARCHAR(100),
        achievement_icon VARCHAR(255),
        earned_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (session_id) REFERENCES sessions(id) ON DELETE CASCADE,
        UNIQUE KEY unique_achievement (session_id, achievement_name),
        INDEX idx_session (session_id)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
    
    // Execute table creation queries
    $tables = [
        $sessions_table,
        $game_stats_table,
        $transactions_table,
        $achievements_table
    ];
    
    foreach ($tables as $table_sql) {
        if (!$db->query($table_sql)) {
            error_log("Error creating table: " . $db->error);
        }
    }
}
?>
