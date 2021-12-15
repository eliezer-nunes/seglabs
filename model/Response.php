<?php

/* 
 * Created by Eliézer Santos Nunes
*/
class Response {
    public static $SUCCESS = "Sucesso";
    public static $ERROR = "Erro";
    private $erro = 0;
    private $msg = "";
    private $msgs = array();
    
    function __construct($erro, $msg) {
        $this->erro = $erro;
        $this->msg = $msg;
    }

    function getMsgs() {
        return $this->msgs;
    }

    function setMsgs($msgs) {
        $this->msgs = $msgs;
    }

    function addMsgs($msg){
        array_push($this->msgs, $msg);
    }
            
    function getErro() {
        return $this->erro;
    }

    function getMsg() {
        return $this->msg;
    }

    function setErro($erro) {
        $this->erro = $erro;
    }

    function setMsg($msg) {
        $this->msg = $msg;
    }

    function show($type){
        return json_encode(array("erro"=>$this->getErro(), "msg"=>$this->getMsg(), "msgs"=>array($this->getMsgs()), "title"=>$type));
    }
}