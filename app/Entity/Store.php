<?php

namespace App\Entity;

use App\Db\Database;
use PDO;

class Store {

    public $id;
    public $loja;
    public $endereco;

    public function cadastrar() {
        $database = new Database('lojas');

        $database->insert([
            'id' => $this->id,
            'loja' => $this->loja,
            'endereco' =>$this->endereco
        ]);
    }

    public function editar($id) {
        $database = new Database('lojas');

        $database->update([
            'id' => $this->id,
            'loja' =>$this->loja,
            'endereco' => $this->endereco
        ], $id);
    }

    public function deletar($id) {
        return (new Database('lojas'))->delete($id);
    }

    public static function getQuantidadeLojas($where = null) {
        return (new Database('lojas'))->select($where, null, null, 'COUNT(*) as qtd')->fetchObject()->qtd;
    }

    public static function getLojas($where = null, $order = null, $limit = null) {
        return (new Database('lojas'))->select($where, $order, $limit)->fetchAll(PDO::FETCH_CLASS, self::class);
    }

    public static function getLoja($id) {
        return (new Database('lojas'))->select(' id = '.$id)->fetchObject(self::class);
    }
}
