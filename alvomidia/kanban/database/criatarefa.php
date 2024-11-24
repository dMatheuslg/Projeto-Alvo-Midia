<?php
session_start();

require_once 'conecta.php';

// Define o cabeçalho para retornar um Json
header('Content-Type: application/json');

// Captura os valores da requisição
$dados = file_get_contents('php://input'); 
$dados = json_decode($dados, true);

$cliente = $dados['cliente'];
$descricao = $dados['tarefa'];
$data = date('d/m/Y', strtotime($dados['data']));
$data_hora = $data .' '. $dados['hora'];
$adm = $_SESSION['usuario'];



$sql = "INSERT INTO tarefas (cliente_cod, descricao, data_hora, status, administrador, arquivo_code_feed) 
                    VALUES ('$cliente', '$descricao', '$data_hora', 'pendente', '$adm', NULL)";

if ($conn->query($sql) === TRUE) {
    echo 'Cadastro realizado com sucesso!'; 
    exit();  
} else {
    echo 'Não foi possível realizar o cadastro';
    exit();
}


// Fechar conexão
$conn->close();
?>