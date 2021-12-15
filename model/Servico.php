<?php

/* 
 * Created by Eliézer Santos Nunes
*/
require_once dirname(__FILE__) . '/Crud.php';

class Servico extends Crud {

    protected $table = "servico";
    protected $table_transporte = "transporte";
    protected $table_tipo_transporte = "tipo_transporte";
    private $id;
    private $origem;
    private $destino;
    private $data_saida;
    private $transporte_id;
    private $valor;
    private $cancelado;
    private $finalizado;
    private $tipo_id;
    private $responsavel;
    
    function __construct() {
    }

    public function insert() {
        $sql = " INSERT INTO $this->table (origem, destino, data_saida, transporte_id, valor, cancelado, finalizado) "
                ." VALUES (:origem, :destino, :data_saida, :transporte_id, :valor, :cancelado, :finalizado); ";
        
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':origem', $this->getOrigem(), PDO::PARAM_STR);
        $stmt->bindParam(':destino', $this->getDestino(), PDO::PARAM_STR);
        $stmt->bindParam(':data_saida', $this->getData_saida(), PDO::PARAM_STR);
        $stmt->bindParam(':transporte_id', $this->getTransporte_id(), PDO::PARAM_INT);
        $stmt->bindParam(':valor', $this->getValor(), PDO::PARAM_STR);
        $stmt->bindParam(':cancelado', $this->getCancelado(), PDO::PARAM_INT);
        $stmt->bindParam(':finalizado', $this->getFinalizado(), PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function update($id) {
        return null;
    }

    public function cancelar($id) {
        $sql = "UPDATE $this->table SET cancelado=1 WHERE id = :id ";
        
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function finalizar($id) {
        $sql = "UPDATE $this->table SET finalizado=1 WHERE id = :id ";
        
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function findAllByIdTransporte($transporte_id) {
        $sql = "SELECT * FROM $this->table WHERE transporte_id = :transporte_id AND cancelado = 0";
        $stmt = DB::prepare($sql);
        $stmt->bindParam(':transporte_id', $transporte_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function findAllFilter() {
        $sql = " SELECT s.id, s.finalizado, s.cancelado, s.origem, s.destino, s.data_saida, s.valor, tt.nome, t.responsavel FROM $this->table s  ";
        $sql .= " INNER JOIN $this->table_transporte t on (t.id = s.transporte_id)  ";
        $sql .= " INNER JOIN $this->table_tipo_transporte tt on (tt.id = t.tipo_id)  ";

        $condition = "";
        if(is_int($this->getFinalizado())) $condition .= "AND s.finalizado = :finalizado "; 
        if(is_int($this->getCancelado())) $condition .= "AND s.cancelado = :cancelado "; 
        if(!empty($this->getOrigem())) $condition .= "AND s.origem LIKE :origem "; 
        if(!empty($this->getDestino())) $condition .= "AND s.destino LIKE :destino "; 
        if(!empty($this->getData_saida())) $condition .= "AND s.data_saida  = :data_saida "; 
        if(!empty($this->getValor())) $condition .= "AND s.valor  = :valor "; 
        if(!empty($this->getTipo_id())) $condition .= "AND t.tipo_id  = :tipo_id "; 
        if(!empty($this->getResponsavel())) $condition .= "AND t.responsavel  LIKE :responsavel "; 

        //Substituindo o primeiro AND por WHERE
        $sql .= " WHERE ".substr($condition, 3, strlen($condition));
        $sql .= " ORDER BY s.id DESC ";

        $stmt = DB::prepare($sql);
        if(is_int($this->getFinalizado())) $stmt->bindParam(':finalizado', $this->getFinalizado(), PDO::PARAM_INT);
        if(is_int($this->getCancelado())) $stmt->bindParam(':cancelado', $this->getCancelado(), PDO::PARAM_INT);
        if(!empty($this->getOrigem())) $stmt->bindValue(':origem', '%'.$this->getOrigem().'%');
        if(!empty($this->getDestino())) $stmt->bindValue(':destino', '%'.$this->getDestino().'%');
        if(!empty($this->getData_saida())) $stmt->bindParam(':data_saida', $this->getData_saida(), PDO::PARAM_STR);
        if(!empty($this->getValor())) $stmt->bindParam(':valor', $this->getValor(), PDO::PARAM_STR);
        if(!empty($this->getTipo_id())) $stmt->bindParam(':tipo_id', $this->getTipo_id(), PDO::PARAM_INT);
        if(!empty($this->getResponsavel())) $stmt->bindValue(':responsavel', '%'.$this->getResponsavel().'%');
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
     * Get the value of origem
     */ 
    public function getOrigem()
    {
        return $this->origem;
    }

    /**
     * Set the value of origem
     *
     * @return  self
     */ 
    public function setOrigem($origem)
    {
        $this->origem = $origem;

        return $this;
    }

    /**
     * Get the value of destino
     */ 
    public function getDestino()
    {
        return $this->destino;
    }

    /**
     * Set the value of destino
     *
     * @return  self
     */ 
    public function setDestino($destino)
    {
        $this->destino = $destino;

        return $this;
    }

    /**
     * Get the value of data_saida
     */ 
    public function getData_saida()
    {
        return $this->data_saida;
    }

    /**
     * Set the value of data_saida
     *
     * @return  self
     */ 
    public function setData_saida($data_saida)
    {
        $this->data_saida = $data_saida;

        return $this;
    }

    /**
     * Get the value of transporte_id
     */ 
    public function getTransporte_id()
    {
        return $this->transporte_id;
    }

    /**
     * Set the value of transporte_id
     *
     * @return  self
     */ 
    public function setTransporte_id($transporte_id)
    {
        $this->transporte_id = $transporte_id;

        return $this;
    }

    /**
     * Get the value of valor
     */ 
    public function getValor()
    {
        return $this->valor;
    }

    /**
     * Set the value of valor
     *
     * @return  self
     */ 
    public function setValor($valor)
    {
        $this->valor = $valor;

        return $this;
    }

    /**
     * Get the value of cancelado
     */ 
    public function getCancelado()
    {
        return $this->cancelado;
    }

    /**
     * Set the value of cancelado
     *
     * @return  self
     */ 
    public function setCancelado($cancelado)
    {
        $this->cancelado = $cancelado;

        return $this;
    }

    /**
     * Get the value of finalizado
     */ 
    public function getFinalizado()
    {
        return $this->finalizado;
    }

    /**
     * Set the value of finalizado
     *
     * @return  self
     */ 
    public function setFinalizado($finalizado)
    {
        $this->finalizado = $finalizado;

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
}
