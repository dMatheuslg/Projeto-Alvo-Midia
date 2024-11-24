<?php
session_start();

require_once 'conecta.php';

header('Content-Type: application/json');

$dados = file_get_contents('php://input'); 
$dados = json_decode($dados, true);

$id_tarefa = $dados['idTarefa'];
$status = $dados['idColuna'];

$sql = "UPDATE tarefas_stories SET status = '$status' WHERE id_tarefa_stories = '$id_tarefa'";

if ($conn->query($sql) === TRUE) {
    echo json_encode(['message' => 'Tarefa atualizada com sucesso!']); 
    exit();  
} else {
    echo json_encode(['message' => 'Não foi possível realizar a alteração']);
    exit();
}

$conn->close();
?>
