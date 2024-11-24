<?php
session_start();

require_once 'conecta.php';

// Define o cabeçalho para retornar um Json
header('Content-Type: application/json');

$dados = file_get_contents('php://input'); 
$dados = json_decode($dados, true);

$id_tarefa = $dados['idTarefa'];
$status = $dados['idColuna'];


$sql = "UPDATE tarefas SET status = '$status' WHERE id_tarefa = '$id_tarefa'";

if ($conn->query($sql) === TRUE) {
    echo 'Tarefa atualizada com sucesso!'; 
    exit();  
} else {
    echo 'Não foi possível realizar a alteração';
    exit();
}


$conn->close();
?>