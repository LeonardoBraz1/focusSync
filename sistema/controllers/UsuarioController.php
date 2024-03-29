<?php
require_once '../models/UsuarioModel.php';

@session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuarioModel = new UsuarioModel();

    $id = isset($_POST['id']) ? $_POST['id'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $nome = isset($_POST['nome']) ? $_POST['nome'] : '';
    $senha = isset($_POST['senha']) ? $_POST['senha'] : '';
    $id_nivel = isset($_POST['id_nivel']) ? $_POST['id_nivel'] : '';
    $ativo = isset($_POST['ativo']) ? $_POST['ativo'] : '';
    $imagem = isset($_POST['imagem']) ? file_get_contents($_POST['imagem']) : '';

    // Verifica qual ação está sendo realizada
    if ($_POST['action'] === 'editar') {

        $response = $usuarioModel->editarUsuario($id, $email, $nome, $senha, $id_nivel, $ativo, $imagem);

    } elseif ($_POST['action'] === 'deletar') {

        $response = $usuarioModel->deletarUsuario($id);

    } elseif ($_POST['action'] === 'inserir') {

        $response = $usuarioModel->inserirUsuario($email, $nome, $senha, $id_nivel, $ativo, $imagem, $_SESSION["barbearia_id"]);
    
    } elseif ($_POST['action'] === 'validarNome') {

        $response = $usuarioModel->validarNome($nome);

    } elseif ($_POST['action'] === 'validarEmail') {

        $response = $usuarioModel->validarEmail($email);
        
    } elseif ($_POST['action'] === 'obterUsuarios') {
        $usuarios = $usuarioModel->obterUsuarios($_SESSION["barbearia_id"]);
        $response = json_encode($usuarios);
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