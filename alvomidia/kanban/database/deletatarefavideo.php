<?php
require_once 'conecta.php';

// Define o cabeçalho para retornar um Json
header('Content-Type: application/json');

// Captura os valores da requisição
$dados = file_get_contents('php://input'); 
$dados = json_decode($dados, true); 

$id_tarefa = $dados['id'];

$sql = "DELETE FROM tarefas_video WHERE id_tarefa_video = '$id_tarefa'";

if ($conn->query($sql) === TRUE) {
    echo 'A tarefa foi excluida!'; 
    exit();  
} else {
    echo 'Não foi possível excluir a tarefa';
    exit();
}

$conn->close();

?>