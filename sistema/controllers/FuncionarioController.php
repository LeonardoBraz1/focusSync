<?php
require_once '../models/FuncionarioModel.php';

@session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $funcionarioModel = new FuncionarioModel();

    $id = isset($_POST['id']) ? $_POST['id'] : '';
    $nome = isset($_POST['nome']) ? $_POST['nome'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $id_nivel = isset($_POST['id_nivel']) ? $_POST['id_nivel'] : '';
    $cpf = isset($_POST['cpf']) ? $_POST['cpf'] : '';
    $comissao = isset($_POST['comissao']) ? $_POST['comissao'] : '';
    $atendimento = isset($_POST['atendimento']) ? $_POST['atendimento'] : '';
    $endereco = isset($_POST['endereco']) ? $_POST['endereco'] : '';
    $cidade = isset($_POST['cidade']) ? $_POST['cidade'] : '';
    $tipoPix = isset($_POST['tipoPix']) ? $_POST['tipoPix'] : '';
    $pix = isset($_POST['pix']) ? $_POST['pix'] : '';
    $diaSemana = isset($_POST['diaSemana']) ? $_POST['diaSemana'] : '';
    $id_dia = isset($_POST['id_dia']) ? $_POST['id_dia'] : '';
    $serv = isset($_POST['serv']) ? $_POST['serv'] : '';
    $id_servico = isset($_POST['id_servico']) ? $_POST['id_servico'] : '';
    
    // Verifica qual ação está sendo realizada
    if ($_POST['action'] === 'editar') {
        $response = $funcionarioModel->editarFuncionario($id, $nome, $email, $id_nivel, $cpf, $comissao, $atendimento, $endereco, $cidade, $tipoPix, $pix);
    } elseif ($_POST['action'] === 'deletar') {

        $response = $funcionarioModel->deletarFuncionario($id);
    } elseif ($_POST['action'] === 'inserir') {

        $response = $funcionarioModel->inserirFuncionario($nome, $email, $id_nivel, $cpf, $comissao, $atendimento, $endereco, $cidade, $tipoPix, $pix, $_SESSION["barbearia_id"]);
    } elseif ($_POST['action'] === 'validarNome') {

        $response = $funcionarioModel->validarNome($nome);
    } elseif ($_POST['action'] === 'validarEmail') {

        $response = $funcionarioModel->validarEmail($email);

    } elseif ($_POST['action'] === 'obterHorarios') {

        $response = $funcionarioModel->obterHorarios($id, $_SESSION["barbearia_id"]);
        
    } elseif ($_POST['action'] === 'inserirDia') {

        $response = $funcionarioModel->inserirDia($id, $diaSemana, $_SESSION["barbearia_id"]);
        
    } elseif ($_POST['action'] === 'deletarDiaSemana') {

        $response = $funcionarioModel->deletarDiaSemana($id_dia);
        
    } elseif ($_POST['action'] === 'obterServ') {

        $response = $funcionarioModel->obterServ($id);
        
    }elseif ($_POST['action'] === 'inserirServ') {

        $response = $funcionarioModel->inserirServ($id, $serv);
        
    } elseif ($_POST['action'] === 'deletarServ') {

        $response = $funcionarioModel->deletarServ($id_servico);
        
    } else {
        // Ação desconhecida
        $response = array("status" => "erro", "message" => "Ação desconhecida.");
    }

    echo json_encode($response);
} else {
    // Retorna uma resposta em caso de requisição inválida
    $response = array('error' => false, 'message' => 'Requisição inválida!');
    echo json_encode($response);
}
