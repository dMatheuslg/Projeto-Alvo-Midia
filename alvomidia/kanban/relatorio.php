<?php
session_start();
include_once "database/verifica.php";
require_once 'database/conecta.php';

// Faz a busca das tarefas
$adm = $_SESSION['usuario'];

// Consulta unificada com UNION
$sql = "
    SELECT t.*, c.nome FROM tarefas t
    INNER JOIN usuarios c ON (t.cliente_cod = c.id_usuario)
    WHERE administrador = '$adm'
    
    UNION ALL
    
    SELECT tv.*, c.nome FROM tarefas_video tv
    INNER JOIN usuarios c ON (tv.cliente_cod = c.id_usuario)
    WHERE administrador = '$adm'
    
    UNION ALL
    
    SELECT ts.*, c.nome FROM tarefas_stories ts
    INNER JOIN usuarios c ON (ts.cliente_cod = c.id_usuario)
    WHERE administrador = '$adm'
";

$result = $conn->query($sql);

$tarefas = [];
if ($result->num_rows > 0) {
    while ($tarefa = $result->fetch_assoc()) {
        $tarefas[] = $tarefa;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatórios de Aprovação</title>
    <link rel="stylesheet" href="css/styles.css">
    <style>
        body {
            font-family: 'Noto Sans', sans-serif;
            background-color: #f0f0f5;
            margin: 0;
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #7851A9;
            color: white;
        }
        tr:hover {
            background-color: #f0f0f0;
        }
        button{
            width: 100px;
            margin-top:200px;
            padding: 12px;
            background-color: #7851A9; 
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
        }
    </style>
</head>
<body>

    <h1>Relatórios de Aprovação</h1>
    
    <table id="tabela-relatorios">
        <thead>
            <tr>
                <th>Cliente</th>
                <th>Descrição</th>
                <th>Data e Hora Agendada</th>
                <th>Situação</th>
            </tr>
        </thead>
        <tbody>
            <?php
                if (empty($tarefas)) {
                    echo "<tr>
                            <td colspan='4'>Nenhuma tarefa encontrada</td>
                        </tr>";
                }

                foreach ($tarefas as $key => $tarefa) {
                    echo "<tr>
                            <td>{$tarefa['nome']}</td>
                            <td>{$tarefa['descricao']}</td>
                            <td>{$tarefa['data_hora']}</td>
                            <td>".ucfirst($tarefa['status'])."</td>
                        </tr>";
                }            
            ?>
        </tbody>
    </table>

    <button onclick="location.href='kanban.php'" class="">Voltar</button>

</body>
</html>
