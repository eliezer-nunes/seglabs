<?php
/* 
 * Created by Eliézer Santos Nunes
*/
require_once dirname(__FILE__) . '/../model/Transporte.php';
require_once dirname(__FILE__) . '/../model/Servico.php';
require_once dirname(__FILE__) . '/../model/Response.php';
require_once dirname(__FILE__) . '/../utils/Util.php';

$method = $_SERVER['REQUEST_METHOD'];

switch($method){
    case 'POST':
        cadastrar($_POST);
        break;
    case 'GET':
        findById($_GET['id']);
        break;
    case 'PUT':
        editar($_GET);
        exit;
    case 'DELETE':
        deletar($_GET['id']);
        break;

}

function cadastrar($paramethes){
    //Validando os parametros
    validateForm($paramethes);

    $transporte = getObjTransporte($paramethes);
    if($transporte->insert()){
        $response = new Response(0, "");
        $response->setMsg('Transporte cadastrado com sucesso.');
        echo $response->show(Response::$SUCCESS);
    }
    exit;
}

function findById($id){
    $transporte = new Transporte();
    echo json_encode($transporte->find($id));
    exit;
}

function editar($paramethes){
    $response = new Response(0, "");

    //Validando os parametros
    validateForm($paramethes);

    $servico = new Servico();
    if(intval($servico->findAllByIdTransporte($paramethes['id'])[0]->finalizado) == 1){
        $response->setErro(1);
        $response->setMsg('Não é permitido alterar Transportes com carga entregue.');
        echo $response->show(Response::$ERROR);

    }else{
        $transporte = getObjTransporte($paramethes);
        if($transporte->update($paramethes['id'])){
            $response->setMsg('Transporte atualizado com sucesso.');
            echo $response->show(Response::$SUCCESS);
        }
    }
    exit;
}

function deletar($id){
    $response = new Response(0, "");
    
    //Validando se existe algum serviço vinculado ao transporte
    $servico = new Servico();
    if(count($servico->findAllByIdTransporte($id)) > 0){
        $response->setErro(1);
        $response->setMsg('Encontramos Serviço(s) cadastro(s) com este Transporte.');
        echo $response->show(Response::$ERROR);

    }else{
        $transporte = new Transporte();
        if($transporte->delete($id)){
            $response->setMsg('Transporte removido com sucesso.');
            echo $response->show(Response::$SUCCESS);
        }
    }
    exit;
}

//Validando os campos obrigatórios do formulário
function validateForm($paramethes){
    $response = new Response(1, "");

    if(!Util::hasParameter($paramethes['tipo'])){
        $response->addMsgs('Selecione o tipo.');
    }
    if(!Util::hasParameter($paramethes['altura'])){
        $response->addMsgs('Informe a altura.');
    }
    if(!Util::hasParameter($paramethes['largura'])){
        $response->addMsgs('Informe a largura.');
    }
    if(!Util::hasParameter($paramethes['comprimento'])){
        $response->addMsgs('Informe o comprimento.');
    }
    if(!Util::hasParameter($paramethes['responsavel'])){
        $response->addMsgs('Informe o responsável.');
    }

    if(count($response->getMsgs()) > 0){
        echo $response->show(Response::$ERROR);
        exit;
    }
}

//Montando objeto Transporte
function getObjTransporte($paramethes){
    $transporte = new Transporte();
    $transporte->setTipo_id($paramethes['tipo']);
    $transporte->setAltura(Util::formatNumber($paramethes['altura']));
    $transporte->setLargura(Util::formatNumber($paramethes['largura']));
    $transporte->setComprimento(Util::formatNumber($paramethes['comprimento']));
    $transporte->setResponsavel($paramethes['responsavel']);
    return $transporte;
}