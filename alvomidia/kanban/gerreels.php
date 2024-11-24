<?php
session_start();
include_once "database/verifica.php";
require_once 'database/conecta.php';

//Faz a busca dos clientes
$sql = "SELECT * FROM usuarios";
$clientes = $conn->query($sql);

//Faz a busca das tarefas
$adm = $_SESSION['usuario'];

$sql = "SELECT tarefas_stories *, c.nome FROM tarefas_stories t 
        INNER JOIN usuarios c ON (t.cliente_cod = c.id_usuario) 
        WHERE administrador = '$adm'";

$result = $conn->query($sql);

$tarefas_stories = [];
if ($result->num_rows > 0) {
    while ($tarefas_stories = $result->fetch_assoc()) {
        $tarefas_stories[] = $tarefas_stories;
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciador de Tarefas de Stories</title>
    <link rel="stylesheet" href="css/kanban.css?V=<?php echo time()?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-k6RqeWeci5ZR/Lv4MR0sA0FfDOMwW9jY2mZ1yZlU1fT/8c5V0gtQWcY5mZ0DAsF" crossorigin="anonymous">
</head>
<body>

    <!-- Barra lateral à esquerda -->
    <div class="sidebar">
        <h4>Olá, <?php echo $_SESSION['usuario']?></h4>
        <h2>Menu</h2>
        <ul>
            <li>
                <button onclick="location.href='../index.html'">
                    Início
                    <span class="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed">
                            <path d="M240-200h120v-240h240v240h120v-360L480-740 240-560v360Zm-80 80v-480l320-240 320 240v480H520v-240h-80v240H160Zm320-350Z"/>
                        </svg>
                    </span>
                </button>
            </li>
            <li>
                <button onclick="location.href='kanban.php'">
                    Tarefas Post
                    <span class="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed">
                            <path d="M480-80q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q65 0 123 19t107 53l-58 59q-38-24-81-37.5T480-800q-133 0-226.5 93.5T160-480q0 133 93.5 226.5T480-160q32 0 62-6t58-17l60 61q-41 20-86 31t-94 11Zm280-80v-120H640v-80h120v-120h80v120h120v80H840v120h-80ZM424-296 254-466l56-56 114 114 400-401 56 56-456 457Z"/>
                        </svg>
                    </span>
                </button>
            </li>
            <li>
                <button onclick="location.href='gervid.php'">
                    Tarefas Vídeos
                    <span class="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed">
                            <path d="M480-80q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q65 0 123 19t107 53l-58 59q-38-24-81-37.5T480-800q-133 0-226.5 93.5T160-480q0 133 93.5 226.5T480-160q32 0 62-6t58-17l60 61q-41 20-86 31t-94 11Zm280-80v-120H640v-80h120v-120h80v120h120v80H840v120h-80ZM424-296 254-466l56-56 114 114 400-401 56 56-456 457Z"/>
                        </svg>
                    </span>
                </button>
            </li>
            <li>
                <button onclick="location.href='gerreels.php'">
                    Tarefas Stories
                    <span class="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed">
                            <path d="M480-80q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q65 0 123 19t107 53l-58 59q-38-24-81-37.5T480-800q-133 0-226.5 93.5T160-480q0 133 93.5 226.5T480-160q32 0 62-6t58-17l60 61q-41 20-86 31t-94 11Zm280-80v-120H640v-80h120v-120h80v120h120v80H840v120h-80ZM424-296 254-466l56-56 114 114 400-401 56 56-456 457Z"/>
                        </svg>
                    </span>
                </button>
            </li>
            <li>
                <button  id="toggleApprovedBtn" onclick="location.href='relatorio.php'">
                    Relatórios
                    <span class="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed">
                            <path d="M680-80q-83 0-141.5-58.5T480-280q0-83 58.5-141.5T680-480q83 0 141.5 58.5T880-280q0 83-58.5 141.5T680-80Zm67-105 28-28-75-75v-112h-40v128l87 87Zm-547 65q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h167q11-35 43-57.5t70-22.5q40 0 71.5 22.5T594-840h166q33 0 56.5 23.5T840-760v250q-18-13-38-22t-42-16v-212h-80v120H280v-120h-80v560h212q7 22 16 42t22 38H200Zm280-640q17 0 28.5-11.5T520-800q0-17-11.5-28.5T480-840q-17 0-28.5 11.5T440-800q0 17 11.5 28.5T480-760Z"/>
                        </svg>
                    </span>
                </button>
            </li>
            <li>
                <button onclick="location.href='cadastroadm.php'">
                    Novo Admistrador
                    <span class="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed">
                            <path d="m370-80-16-128q-13-5-24.5-12T307-235l-119 50L78-375l103-78q-1-7-1-13.5v-27q0-6.5 1-13.5L78-585l110-190 119 50q11-8 23-15t24-12l16-128h220l16 128q13 5 24.5 12t22.5 15l119-50 110 190-103 78q1 7 1 13.5v27q0 6.5-2 13.5l103 78-110 190-118-50q-11 8-23 15t-24 12L590-80H370Zm70-80h79l14-106q31-8 57.5-23.5T639-327l99 41 39-68-86-65q5-14 7-29.5t2-31.5q0-16-2-31.5t-7-29.5l86-65-39-68-99 42q-22-23-48.5-38.5T533-694l-13-106h-79l-14 106q-31 8-57.5 23.5T321-633l-99-41-39 68 86 64q-5 15-7 30t-2 32q0 16 2 31t7 30l-86 65 39 68 99-42q22 23 48.5 38.5T427-266l13 106Zm42-180q58 0 99-41t41-99q0-58-41-99t-99-41q-59 0-99.5 41T342-480q0 58 40.5 99t99.5 41Zm-2-140Z"/>
                        </svg>
                    </span>
                </button>
            </li>
            <li>
                <button onclick="location.href='database/logout.php'">
                    Logout
                    <span class="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed">
                            <path d="m370-80-16-128q-13-5-24.5-12T307-235l-119 50L78-375l103-78q-1-7-1-13.5v-27q0-6.5 1-13.5L78-585l110-190 119 50q11-8 23-15t24-12l16-128h220l16 128q13 5 24.5 12t22.5 15l119-50 110 190-103 78q1 7 1 13.5v27q0 6.5-2 13.5l103 78-110 190-118-50q-11 8-23 15t-24 12L590-80H370Zm70-80h79l14-106q31-8 57.5-23.5T639-327l99 41 39-68-86-65q5-14 7-29.5t2-31.5q0-16-2-31.5t-7-29.5l86-65-39-68-99 42q-22-23-48.5-38.5T533-694l-13-106h-79l-14 106q-31 8-57.5 23.5T321-633l-99-41-39 68 86 64q-5 15-7 30t-2 32q0 16 2 31t7 30l-86 65 39 68 99-42q22 23 48.5 38.5T427-266l13 106Zm42-180q58 0 99-41t41-99q0-58-41-99t-99-41q-59 0-99.5 41T342-480q0 58 40.5 99t99.5 41Zm-2-140Z"/>
                        </svg>
                    </span>
                </button>
            </li>
        </ul>
    </div>

    <div class="app-container">
        <h1>Gerenciador de Tarefas Stories</h1>
    
        <div class="kanban">
            <div class="column" id="todo">
                <h2>A Fazer</h2>
                <div class="task-container" id="pendente">
                    <?php
                        foreach ($tarefas_stories as $key => $tarefas_stories) {
                            if(strtolower($tarefas_stories['status']) == 'pendente'){
                                echo "<div class='task' id='".$tarefas_stories['id_tarefa_stories']."' draggable='true' ondragstart='dragStart(event)' ondragend='dragEnd(event)'>
                                        <ul>
                                            <li class='task-detail'>Cliente: {$tarefas_stories['nome']}</li>
                                            <li class='task-detail'>{$tarefas_stories['descricao']}</li>
                                            <li class='task-detail'>{$tarefas_stories['data_hora']}</li>
                                        </ul>
                                        <button class='delete-btn' onclick='deletaTarefa(".$tarefas_stories['id_tarefa_stories'].");this.closest(&#39;.task &#39;).remove();'>X</button>
                                    </div>";
                            }
                        } 
                    ?>
                </div>
            </div>
            <div class="column" id="in-progress">
                <h2>Processando</h2>
                <div class="task-container" id="processando">
                    <?php                        
                        foreach ($tarefas_stories as $key => $tarefas_stories) {
                            if(strtolower($tarefas_stories['status']) == 'processando'){
                                echo "<div class='task' id='".$tarefas_stories['id_tarefa_stories']."' draggable='true' ondragstart='dragStart(event)' ondragend='dragEnd(event)'>
                                        <ul>
                                            <li class='task-detail'>Cliente: {$tarefas_stories['nome']}</li>
                                            <li class='task-detail'>{$tarefas_stories['descricao']}</li>
                                            <li class='task-detail'>{$tarefas_stories['data_hora']}</li>
                                        </ul>
                                        <button class='delete-btn' onclick='deletaTarefa(".$tarefas_stories['id_tarefa_stories'].");this.closest(&#39;.task &#39;).remove();'>X</button>
                                    </div>";
                            }
                        } 
                    ?>
                </div>
            </div>
            <div class="column" id="done">
                <h2>Finalizado</h2>
                <div class="task-container" id="finalizado">
                    <?php                       
                       foreach ($tarefas_stories as $key => $tarefas_stories) {
                            if(strtolower($tarefas_stories['status']) == 'finalizado'){
                                echo "<div class='task' id='".$tarefas_stories['id_tarefa_stories']."' draggable='true' ondragstart='dragStart(event)' ondragend='dragEnd(event)'>
                                        <ul>
                                            <li class='task-detail'>Cliente: {$tarefas_stories['nome']}</li>
                                            <li class='task-detail'>{$tarefas_stories['descricao']}</li>
                                            <li class='task-detail'>{$tarefas_stories['data_hora']}</li>
                                        </ul>
                                        <button class='delete-btn' onclick='deletaTarefa(".$tarefas_stories['id_tarefa_stories'].");this.closest(&#39;.task &#39;).remove();'>X</button>
                                    </div>";
                            }
                        }
                    ?>
                </div>
            </div>
        </div>

        <button class="add-task-btn" onclick="openModal()">+ Nova Tarefa</button>
    </div>

    <!-- Modal para adicionar nova tarefa -->
    <div id="taskModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2>Adicionar Nova Tarefa</h2>

            <label for="clienteSelect">Cliente:</label>
            <select class="modal-input" id="clienteSelect" required>
                <option value="" selected disabled>Selecione</option>
                <?php
                    while($cliente = $clientes->fetch_assoc()) {
                        echo "<option value=".$cliente['id_usuario'].">".$cliente['nome']."</option>";
                    }
                ?>
            </select>

            <label for="taskInput">Tarefa:</label>
            <input type="text" class="modal-input" id="taskInput" placeholder="Digite a tarefa" aria-label="Tarefa" required>

            <label for="dateInput">Data:</label>
            <input type="date" class="modal-input" id="dateInput" aria-label="Data" required>
            
            <label for="timeInput">Hora:</label>
            <input type="time" class="modal-input" id="timeInput" aria-label="Hora" required>     
            
            <button class="modal-button" onclick="addTask()">Adicionar Tarefa</button>
        </div>
    </div>

    <script src="script.js?v=<?php echo time()?>"></script>
</body>
</html>