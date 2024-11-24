<?php
require_once 'conecta.php';

// Define o cabeçalho para retornar um Json
header('Content-Type: application/json');

// Captura os valores da requisição
$dados = file_get_contents('php://input'); 
$dados = json_decode($dados, true); 

$id_tarefa = $dados['id']; 

$sql = "DELETE FROM tarefas_stories WHERE id_tarefa_stories = '$id_tarefa'";

if ($conn->query($sql) === TRUE) {
    echo json_encode(['message' => 'A tarefa foi excluída!']); 
    exit();  
} else {
    echo json_encode(['message' => 'Não foi possível excluir a tarefa']);
    exit();
}

$conn->close();
?>
