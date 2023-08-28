<?php
require_once 'model/Montadora.php';
require_once 'view/Montadora.php';

array_shift($url);

function get($consulta, $valor=''){
    $montadora = new Montadora();
    $viewMontadora = new ViewMontadora();
    if($consulta == 'id'){
        // $montadora->consultarPorId($valor);
        $montId = $montadora->consultarPorId($valor);
        $viewMontadora->exibirMontadora($montId);
    }                                               
    else if($consulta == 'nome'){
        $montadoras = $montadora->consultar($valor);
        $viewMontadora->exibirMontadoras($montadoras);
    }
    else if(){
        $montadoras = $montadora->consultar();
        $viewMontadora->exibirMontadora($montadoras);
    }
    else{
        $codigo_resposta = 404;
        $erro = [
            'result'=>false,
            'erro'  => 'Erro: 404 - Recurso não encontrado'
        ];
        require_once 'view/erro404.php';
    }  

    // if(count($consulta) == 1 && $consulta[0] == ""){
    //     // $montadora->consultarPorId($valor);
    //     $montId = $montadora->consultarPorId($consulta[0]);
    //     $viewMontadora->exibirMontadora($montId);
    // }                                               
    // else if(count($consulta) == 1){
    //     $montadoras = $montadora->consultar($valor);
    //     $viewMontadora->exibirMontadoras($montadoras);
    // }
    // else if(count($consulta) == 2 && $consulta[0] == "modelo"){
    //     $montadoras = $montadora->consultar();
    //     $viewMontadora->exibirMontadora($montadoras);
    // }
    // else{
    //     $codigo_resposta = 404;
    //     $erro = [
    //         'result'=>false,
    //         'erro'  => 'Erro: 404 - Recurso não encontrado'
    //     ];
    //     require_once 'view/erro404.php';
    // }  
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
    case "GET":get(@$url[0],@$url[1]);
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