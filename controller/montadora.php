<?php
require_once 'model/Montadora.php';
require_once 'view/Montadora.php';

array_shift($url);

function get($consulta, $valor=''){
    $montadora = new Montadora();
    $viewMontadora = new ViewMontadora();
    if(count($consulta) == 1 && $consulta[0] == ""){
        $montadoras = $veiculo->consultar();
        $viewMontadora->exibirMontadoras($montadoras);
    }
    elseif(count($consulta) == 1){
        $montadora = $montadora->consultarPorId($consulta[0]);
        $viewMontadora->exibirMontadora($montadora);
    }    
    elseif(count($consulta) == 2 && $consulta[0] == "modelo"){       
        $montadoras = $montadora->consultar($consulta[1]);
        $viewMontadora->exibirMontadoras($montadoras);
    }
    else{
        $codigo_resposta = 404;
        $erro = [
            'result'=>false,
            'erro'  => 'Erro: 404 - Recurso não encontrado'
        ];
        require_once 'view/erro404.php';
    } 
}

function post($dados_montadora){
    $montadora = new Montadora();
    $viewMontadora = new viewMontadora();
    $montadora->nome = $dados_montadora->nome;
    $montadora->logotipo = $dados_montadora->logotipo;
    $result = $montadora->cadastrar();
    $viewMontadora->exibirMontadoraCadastrada($result);
}

function put($registro, $dados_montadora){
    $montadora = new Montadora();
    $viewMontadora = new ViewMontadora();

    $montadora->id = $registro;
    $montadora->nome = $dados_montadora->nome;
    $montadora->logotipo = $dados_montadora->$logotipo;
    $result = $montadora->alterar();
    $viewMontadora->exibirMontadoraCadastrada($result);
}

switch($method){
    case "GET":get($url);
    break;
    case "POST":post($dadosRecebidos);
    break;
    case "PUT":put(@$url[0],$dadosRecebidos);
    break;
    case "DELETE":{
        echo json_encode(["method"=>"DELETE"]);
    }
    break;
    default:{
        echo json_encode(["method"=>"ERRO"]);
    }
    break;
}