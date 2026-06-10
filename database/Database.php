<?php
/**
 * Database Connection Class - Singleton Pattern
 */
class Database {
    private static ?Database $instance = null;
    private PDO $connection;
    
    private function __construct() {
        $config = require __DIR__ . '/config.php';
        $dsn = "mysql:host={$config['host']};dbname={$config['dbname']};charset={$config['charset']}";
        $this->connection = new PDO($dsn, $config['username'], $config['password'], $config['options']);
    }
    
    public static function getInstance(): Database {
        if (self::$instance === null) self::$instance = new self();
        return self::$instance;
    }
    
    public function query(string $sql, array $params = []): PDOStatement {
        $stmt = $this->connection->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }
    
    public function fetchOne(string $sql, array $params = []): ?array {
        $result = $this->query($sql, $params)->fetch();
        return $result ?: null;
    }
    
    public function fetchAll(string $sql, array $params = []): array {
        return $this->query($sql, $params)->fetchAll();
    }
    
    public function insert(string $table, array $data): int {
        $columns = implode(', ', array_keys($data));
        $placeholders = ':' . implode(', :', array_keys($data));
        $this->query("INSERT INTO {$table} ({$columns}) VALUES ({$placeholders})", $data);
        return (int) $this->connection->lastInsertId();
    }
}