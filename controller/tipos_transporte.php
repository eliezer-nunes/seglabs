<?php
/* 
 * Created by Eliézer Santos Nunes
*/
require_once dirname(__FILE__) . '/../model/TipoTransporte.php';
require_once dirname(__FILE__) . '/../model/Transporte.php';
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

    $tipo = getTipoTransporte($paramethes);
    if($tipo->insert()){
        $response = new Response(0, "");
        $response->setMsg('Tipo Transporte cadastrado com sucesso.');
        echo $response->show(Response::$SUCCESS);
    }
    exit;
}

function editar($paramethes){
    //Validando os parametros
    validateForm($paramethes);

    $tipo = getTipoTransporte($paramethes);
    if($tipo->update($paramethes['id'])){
        $response = new Response(0, "");
        $response->setMsg('Tipo Transporte atualizado com sucesso.');
        echo $response->show(Response::$SUCCESS);
    }
    exit;

}

function findById($id){
    $tipo = new TipoTransporte();
    echo json_encode($tipo->find($id));
    exit;
}

function deletar($id){
    $response = new Response(0, "");

    //Validando se existe algum transporte vinculado ao tipo
    $transporte = new Transporte();
    if(count($transporte->findAllByTipoId($id)) > 0){
        $response->setErro(1);
        $response->addMsgs('Encontramos Transporte(s) cadastrado(s) com este Tipo.');
        echo $response->show(Response::$ERROR);
    }else{
        $tipo = new TipoTransporte();
        if($tipo->delete($id)){
            $response->setMsg('Tipo Transporte removido com sucesso.');
            echo $response->show(Response::$SUCCESS);
        }
    }
    exit;
}

//Validando os campos obrigatórios do formulário
function validateForm($paramethes){
    $response = new Response(1, "");

    if(!Util::hasParameter($paramethes['nome'])){
        $response->addMsgs('Informe o nome.');
    }
    if(!Util::hasParameter($paramethes['custo_medio'])){
        $response->addMsgs('Informe o custo médio.');
    }
    if(count($response->getMsgs()) > 0){
        echo $response->show(Response::$ERROR);
        exit;

    }
}

//Mondanto o objeto TipoTransporte
function getTipoTransporte($paramethes){
    $tipo = new TipoTransporte();
    $tipo->setNome($paramethes['nome']);
    $tipo->setCusto_medio(Util::formatNumber($paramethes['custo_medio']));
    return $tipo;
}