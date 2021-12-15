<?php

/* 
 * Created by Eliézer Santos Nunes
*/
require_once dirname(__FILE__) . '/Crud.php';

class Transporte extends Crud {

    protected $table = "transporte";
    private $id;
    private $tipo_id;
    private $altura;
    private $largura;
    private $comprimento;
    private $responsavel;
    
    function __construct() {
    }


    public function insert() {
        $sql = " INSERT INTO $this->table (tipo_id, altura, largura, comprimento, responsavel) "
                ." VALUES (:tipo_id, :altura, :largura, :comprimento, :responsavel); ";
        
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':tipo_id', $this->getTipo_id(), PDO::PARAM_INT);
        $stmt->bindParam(':altura', $this->getAltura(), PDO::PARAM_STR);
        $stmt->bindParam(':largura', $this->getLargura(), PDO::PARAM_STR);
        $stmt->bindParam(':comprimento', $this->getComprimento(), PDO::PARAM_STR);
        $stmt->bindParam(':responsavel', $this->getResponsavel(), PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function update($id) {
        $sql = "UPDATE $this->table SET tipo_id = :tipo_id, altura=:altura, largura=:largura, comprimento=:comprimento, responsavel=:responsavel WHERE id = :id ";
        
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':tipo_id', $this->getTipo_id(), PDO::PARAM_INT);
        $stmt->bindParam(':altura', $this->getAltura(), PDO::PARAM_STR);
        $stmt->bindParam(':largura', $this->getLargura(), PDO::PARAM_STR);
        $stmt->bindParam(':comprimento', $this->getComprimento(), PDO::PARAM_STR);
        $stmt->bindParam(':responsavel', $this->getResponsavel(), PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function findAllByTipoId($tipo_id) {
        $sql = "SELECT * FROM $this->table WHERE tipo_id = :tipo_id";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':tipo_id', $tipo_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
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
     * Get the value of altura
     */ 
    public function getAltura()
    {
        return $this->altura;
    }

    /**
     * Set the value of altura
     *
     * @return  self
     */ 
    public function setAltura($altura)
    {
        $this->altura = $altura;

        return $this;
    }

    /**
     * Get the value of largura
     */ 
    public function getLargura()
    {
        return $this->largura;
    }

    /**
     * Set the value of largura
     *
     * @return  self
     */ 
    public function setLargura($largura)
    {
        $this->largura = $largura;

        return $this;
    }

    /**
     * Get the value of comprimento
     */ 
    public function getComprimento()
    {
        return $this->comprimento;
    }

    /**
     * Set the value of comprimento
     *
     * @return  self
     */ 
    public function setComprimento($comprimento)
    {
        $this->comprimento = $comprimento;

        return $this;
    }

    /**
     * Get the value of responsavel
     */ 
    public function getResponsavel()
    {
        return $this->responsavel;
    }

    /**
     * Set the value of responsavel
     *
     * @return  self
     */ 
    public function setResponsavel($responsavel)
    {
        $this->responsavel = $responsavel;

        return $this;
    }

    /**
     * Get the value of tipo_id
     */ 
    public function getTipo_id()
    {
        return $this->tipo_id;
    }

    /**
     * Set the value of tipo_id
     *
     * @return  self
     */ 
    public function setTipo_id($tipo_id)
    {
        $this->tipo_id = $tipo_id;

        return $this;
    }
}
