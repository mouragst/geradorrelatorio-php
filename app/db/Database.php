<?php

namespace App\Db;
use PDO;
use PDOException;

class Database {

    const DB_HOST = 'localhost';
    const DB_NAME = 'auditoria_estoque_cellular';
    const DB_USER = 'root';
    const DB_PASS = '';

    private $table;
    private $connection;

    public function __construct($table = null) {
        $this->table = $table;
        $this->setConnection();
    }

    private function setConnection() {
        try {
            $this->connection = new PDO('mysql:host='.self::DB_HOST.';dbname='.self::DB_NAME, self::DB_USER, self::DB_PASS, [
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
            ]);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            print_r($e->getMessage());
        }
    }

    public function execute($query, $params =[]) {
        try {
            $statement = $this->connection->prepare($query);
            $statement->execute($params);
            return $statement;
        } catch (\PDOException $e) {
            print_r($e->getMessage());
        }
    }

    public function insert($params = []) {
        $fields = array_keys($params);
        $binds = array_pad([], count($fields), "?");

        $query = "INSERT INTO {$this->table} (".implode(", ", $fields).") VALUES (".implode(", ", $binds).")";

        return $this->execute($query, array_values($params));
    }

    public function update ($params, $id) {
        $fields = array_keys($params);

        $query = "UPDATE {$this->table} SET ".implode(" = ?, ", $fields)." = ? WHERE id = ".$id;

        return $this->execute($query, array_values($params));
    }

    public function delete ($id) {
        $query = "DELETE FROM {$this->table} WHERE id = ".$id;
        return $this->execute($query);
    }

    public function select ($where = null, $order = null, $limit = null, $fields = '*') {
        $where = !empty($where) ? ' WHERE '.$where : '';
        $order = !empty($order) ? ' ORDER BY '.$order : '';
        $limit = !empty($limit) ? ' LIMIT '.$limit : '';

        $query = "SELECT {$fields} FROM {$this->table} {$where} {$order} {$limit}";

        return $this->execute($query);
    }
}