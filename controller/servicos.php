<?php
/* 
 * Created by Eliézer Santos Nunes
*/
require_once dirname(__FILE__) . '/../model/Servico.php';
require_once dirname(__FILE__) . '/../model/Transporte.php';
require_once dirname(__FILE__) . '/../model/TipoTransporte.php';
require_once dirname(__FILE__) . '/../model/Response.php';
require_once dirname(__FILE__) . '/../utils/Util.php';

$method = $_SERVER['REQUEST_METHOD'];

switch($method){
    case "POST":
        switch($_POST['action']){
            case 'insert':
                cadastrar($_POST);
                break;
            case 'cancelar':
                cancelar($_POST['id']);
                break;
            case 'finalizar':
                finalizar($_POST['id']);
                break;
        }
        break;
    case 'GET':
        filter($_GET['data']);
        break;
}

function cadastrar($paramethes){
    //Validando os parametros
    validateForm($paramethes);

    $servico = new Servico();
    $servico->setOrigem($paramethes['origem']);
    $servico->setDestino($paramethes['destino']);
    $servico->setData_saida(Util::dateFormatSql($paramethes['data_saida']));
    $servico->setTransporte_id($paramethes['transporte_id']);
    $servico->setCancelado(0);
    $servico->setFinalizado(0);
    $servico->setValor(getValorM3($paramethes['transporte_id']));
    if($servico->insert()){
        $response = new Response(0, "");
        $response->setMsg('Serviço cadastrado com sucesso.');
        echo $response->show(Response::$SUCCESS);
    }
    exit;
}

function cancelar($id){
    $response = new Response(0, "");

    $servico = new Servico();

    if(intval($servico->find($id)->cancelado) == 1){
        $response->addMsgs('Serviço já cancelado.');
    }

    if(intval($servico->find($id)->finalizado) == 1){
        $response->addMsgs('Não é permitido cancelar serviço(s) finalizado(s).');
    }

    if(count($response->getMsgs()) > 0){
        $response->setErro(1);
        echo $response->show(Response::$ERROR);

    }else if($servico->cancelar($id)){
        $response->setMsg('Serviço cancelado com sucesso.');
        echo $response->show(Response::$SUCCESS);
    }
    exit;

}

function finalizar($id){
    $response = new Response(0, "");

    $servico = new Servico();

    if(intval($servico->find($id)->finalizado) == 1){
        $response->addMsgs('Serviço já finalizado.');
    }

    if(intval($servico->find($id)->cancelado) == 1){
        $response->addMsgs('Não é permitido finalizar serviço(s) cancelado(s).');
    }

    if(count($response->getMsgs()) > 0){
        $response->setErro(1);
        echo $response->show(Response::$ERROR);

    }else if($servico->finalizar($id)){
        $response->setMsg('Carga entregue com sucesso.');
        echo $response->show(Response::$SUCCESS);
    }
    exit;
}

//Buscando resultado do filtro aplicado
function filter($paramethes){
    $servico = new Servico();
    $paramethes = json_decode($paramethes);
    foreach($paramethes as $key => $value){
        if(empty($value->value)) continue;
        switch($value->name){
            case 'status':
                //Em transporte
                if($value->value == 't'){
                    $servico->setFinalizado(0);
                    $servico->setCancelado(0);

                //Carga entregue
                }else if($value->value == 'f'){
                    $servico->setFinalizado(1);
                    
                //Cancelado
                }else if($value->value == 'c'){
                    $servico->setCancelado(1);
                }
                break;
            case ('origem'):
                $servico->setOrigem($value->value);
                break;
            case ('destino'):
                $servico->setDestino($value->value);
                break;
            case 'data_saida':
                $servico->setData_saida(Util::dateFormatSql($value->value));
                break;
            case 'valor':
                $servico->setValor(Util::formatNumber($value->value));
                break;
            case 'tipo_id':
                $servico->setTipo_id($value->value);
                break;
            case 'responsavel':
                $servico->setResponsavel($value->value);
                break;
        }
    }

    echo json_encode($servico->findAllFilter());
    exit;
}

//Validando os campos obrigatórios do formulário
function validateForm($paramethes){
    $response = new Response(1, "");

    if(!Util::hasParameter($paramethes['origem'])){
        $response->addMsgs('Informe a origem.');
    }
    if(!Util::hasParameter($paramethes['destino'])){
        $response->addMsgs('Informe o destino.');
    }
    if(!Util::hasParameter($paramethes['data_saida'])){
        $response->addMsgs('Informe a data de saída.');
    }
    if(!Util::hasParameter($paramethes['transporte_id'])){
        $response->addMsgs('Selecione um transporte.');
    }else{
        $servico = new Servico();
        if(count($servico->findAllByIdTransporte($paramethes['transporte_id'])) > 0){
            $response->addMsgs('Já existe um serviço lançado para o Transporte selecionado.');
        }
    }

    if(count($response->getMsgs()) > 0){
        echo $response->show(Response::$ERROR);
        exit;
    }
}

//Calculando o valor por metro cubico
function getValorM3($transporte_id){
    //Obtendo os altura, largura e compriemnto da carga
    $transporte = new Transporte();
    $transporte = $transporte->find($transporte_id);
    $altura = $transporte->altura;
    $largura = $transporte->largura;
    $comprimento = $transporte->comprimento;

    //Obtendo o valor por metro cubico
    $tipo = new TipoTransporte();
    $tipo = $tipo->find($transporte->tipo_id);
    $valor = $tipo->custo_medio;

    //Calculando o custo médio da carga
    return ($altura*$largura*$comprimento) * $valor;

}