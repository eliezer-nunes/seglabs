<?php

/* 
 * Created by Eliézer Santos Nunes
*/
require_once dirname(__FILE__) . '/DB.php';

abstract class Crud extends DB {

    protected $table;

    abstract public function insert();

    abstract public function update($id);

    public function find($id) {
        $sql = "SELECT * FROM $this->table WHERE id = :id";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }
    public function findChave($chave) {
        $sql = "SELECT * FROM $this->table WHERE chave = :chave";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':chave', $chave, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function findAll() {
        $sql = "SELECT * FROM $this->table order by id desc";
        $stmt = DB::prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function findAllAsc() {
        $sql = "SELECT * FROM $this->table order by id asc";
        $stmt = DB::prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function delete($id) {
        $sql = "DELETE FROM $this->table WHERE id = :id";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
    
    public function maxId() {
        $sql = "select max(id) as id FROM $this->table";
        $stmt = DB::prepare($sql);
        $stmt->execute();
        return $stmt->fetch();
    }
}
