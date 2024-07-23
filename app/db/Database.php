<?php

namespace App\Db;

require 'vendor/autoload.php';

use App\Common\Environment;
use PDO;

Environment::load(__DIR__.'/../../');

define('DB_HOST', getenv('DB_HOST'));
define('DB_NAME', getenv('DB_NAME'));
define('DB_USER', getenv('DB_USER'));
define('DB_PASSWORD', getenv('DB_PASSWORD'));

class Database {

    private $table;
    private $connection;

    public function __construct($table = null) {
        $this->table = $table;
        $this->setConnection();
    }

    private function setConnection() {
        try {
            $this->connection = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD, [
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