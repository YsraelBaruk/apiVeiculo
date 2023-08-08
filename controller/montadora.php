<?php
require_once 'model/Montadora.php';
require_once 'view/montadora.php';

array_shift($url);

function get($consulta, $valor=''){
    $montadora = new Montadora();
    $viewMontadora = new ViewMontadora();
    if($consulta == 'id'){
        $montadora = $montadora->consultarPorId($valor);
        $viewMontadora->exibirMontadora($montadora);
    }
    else if($consulta == 'nome'){
        $montadoras = $montadora->consultar($valor);
        $viewMontadora->exibirMontadoras($montadoras);
    }
    else{
        $montadoras = $montadora->consultar();
        $viewMontadora->exibirMontadoras($montadoras);
    }
}

// function post($dados_veiculo){
//     $veiculo = new Veiculo();
//     $viewVeiculo = new ViewVeiculo();
//     $veiculo->modelo            = $dados_veiculo->modelo;
//     $veiculo->ano_fabricacao    = $dados_veiculo->ano_fabricacao;
//     $veiculo->ano_modelo        = $dados_veiculo->ano_modelo;
//     $veiculo->cor               = $dados_veiculo->cor;
//     $veiculo->num_portas        = $dados_veiculo->num_portas;
//     $veiculo->foto              = $dados_veiculo->foto;
//     $veiculo->categoria_id      = $dados_veiculo->categoria_id;
//     $veiculo->montadora_id      = $dados_veiculo->montadora_id;
//     $veiculo->tipo_cambio       = $dados_veiculo->tipo_cambio;
//     $veiculo->tipo_direcao      = $dados_veiculo->tipo_direcao;    
//     $viewVeiculo->exibirVeiculo($veiculo->cadastrar());
// }

// $this->id = $m->id;
// $this->nome = $m->nome;
// $this->logotipo = $m->logotipo;
// $this->data_cadastro = $m->data_cadastro;
// $this->data_alteracao = $m->data_alteracao;

function post($dados_montadora){
    $montadora = new Montadora();
    $viewMontadora = new viewMontadora();
    $montadora->nome          = $dados_montadora->nome;
    $montadora->logotipo      = $dados_montadora->logotipo;
    $viewMontadora->exibirMontadora($montadora->cadastrar());
}

switch($method){
    case 'GET':get(@$url[0],@$url[1]);
    break;
    case "POST":post($dadosRecebidos);
    break;
    case "PUT":{
        echo json_encode(["method"=>"PUT"]);
    }
    break;
    case "DELETE":{
        echo json_encode(["method"=>"DELETE"]);
    }
}