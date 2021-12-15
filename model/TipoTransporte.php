<?php

/* 
 * Created by Eliézer Santos Nunes
*/
require_once dirname(__FILE__) . '/Crud.php';

class TipoTransporte extends Crud {

    protected $table = "tipo_transporte";
    private $id;
    private $nome;
    private $custo_medio;
    
    function __construct() {
    }


    public function insert() {
        $sql = " INSERT INTO $this->table (nome, custo_medio) "
                ." VALUES (:nome, :custo_medio); ";
        
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':nome', $this->getNome(), PDO::PARAM_STR);
        $stmt->bindParam(':custo_medio', $this->getCusto_medio(), PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function update($id) {
        $sql = "UPDATE $this->table SET nome = :nome, custo_medio=:custo_medio WHERE id = :id ";
        
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':nome', $this->getNome(), PDO::PARAM_STR);
        $stmt->bindParam(':custo_medio', $this->getCusto_medio(), PDO::PARAM_STR);
        return $stmt->execute();
    }


    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of nome
     */ 
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Set the value of nome
     *
     * @return  self
     */ 
    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Get the value of custo_medio
     */ 
    public function getCusto_medio()
    {
        return $this->custo_medio;
    }

    /**
     * Set the value of custo_medio
     *
     * @return  self
     */ 
    public function setCusto_medio($custo_medio)
    {
        $this->custo_medio = $custo_medio;

        return $this;
    }
}
