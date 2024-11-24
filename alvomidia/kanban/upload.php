<?php
session_start();
include_once "database/verifica.php";
include_once "database/conecta.php"; 

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload de Arquivos</title>
    <link rel="stylesheet" href="css/kanban.css?V=<?php echo time() ?>">

    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f0f0f5;
            margin: 0;
            display: flex;
        }

        .sidebar {
            width: 220px;
            background-color: #fff;
            padding: 20px;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
            height: 100vh;
            position: fixed;
        }

        .sidebar ul {
            list-style-type: none;
            padding: 0;
        }

        .sidebar li {
            margin-bottom: 15px;
        }

        .sidebar button {
            width: 100%;
            padding: 10px;
            background-color: #f5f5f5;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .sidebar button:hover {
            background-color: #e0e0e0;
        }

        form {
            margin: auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            width: 50%;
            position: relative;
            top: 20px;
            left: 240px;
        }

        label {
            display: block;
            font-weight: bold;
            margin: 15px 0 5px;
        }

        input, select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 14px;
        }

        button.enviar_upload {
            background-color: #007BFF;
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.2s;
        }

        button.enviar_upload:hover {
            background-color: #0056b3;
        }

        button.enviar_upload:active {
            transform: scale(0.98);
        }

        .tarefa_container {
            display: none;
        }
    </style>
</head>

</head>
<body>
    <div class="sidebar">
        <ul>
            <li><button onclick="location.href='kanban.php'">Voltar</button></li>
        </ul>
    </div>

    <form action="database/processa_upload.php" method="POST" enctype="multipart/form-data">
        <label for="arquivo">Selecione um arquivo:</label>
        <input type="file" name="arquivo" id="arquivo" required>

        <label for="tipo_arquivo">Tipo de Arquivo:</label>
        <select name="tipo_arquivo" id="tipo_arquivo">
            <option value="imagem">Imagem</option>
            <option value="video">Vídeo</option>
        </select>

        <label for="tipo_tarefa">Tipo de Tarefa:</label>
        <select name="tipo_tarefa" id="tipo_tarefa">
            <option value="feed">Feed</option>
            <option value="story">Stories</option>
            <option value="video">Vídeo</option>
        </select>

        <label for="cliente">Cliente:</label>
        <select name="cliente" id="cliente">
            <!-- Popule as opções com os clientes do banco de dados -->
            <?php
            $result = $conn->query(query: "SELECT id_usuario, nome FROM usuarios");
            while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['id_usuario'] . "'>" . $row['nome'] . "</option>";
            }
            ?>
        </select>

        <!-- Campos de Tarefa (Feed, Stories ou Vídeo) -->
        <div id="feed_container" class="tarefa_container">
            <label for="id_feed">Tarefa Feed:</label>
            <select name="id_feed" id="id_feed">
                <!-- Popule dinamicamente as tarefas Feed -->
                <?php
                $result = $conn->query("SELECT id_tarefa, descricao FROM tarefas");
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['id_tarefa'] . "'>" . $row['descricao'] . "</option>";
                }
                ?>
            </select>
        </div>

        <div id="story_container" class="tarefa_container">
            <label for="id_tarefa_story">Tarefa Stories:</label>
            <select name="id_tarefa_story" id="id_tarefa_story">
                <!-- Popule dinamicamente as tarefas Stories -->
                <?php
                $result = $conn->query("SELECT id_tarefa_stories, descricao FROM tarefas_stories");
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['id_tarefa_stories'] . "'>" . $row['descricao'] . "</option>";
                }
                ?>
            </select>
        </div>

        <div id="video_container" class="tarefa_container">
            <label for="id_tarefa_video">Tarefa de Vídeo:</label>
            <select name="id_tarefa_video" id="id_tarefa_video">
                <!-- Popule dinamicamente as tarefas de vídeo -->
                <?php
                $result = $conn->query("SELECT id_tarefa_video, descricao FROM tarefas_video");
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['id_tarefa_video'] . "'>" . $row['descricao'] . "</option>";
                }
                ?>
            </select>
        </div>

        <button class="enviar_upload" type="submit">Enviar</button>
    </form>

    <script>
    function toggleTarefaFields() {
        var tipoTarefa = document.getElementById("tipo_tarefa").value;
        
        var containers = document.querySelectorAll('.tarefa_container');
        containers.forEach(function(container) {
            container.style.display = 'none';
        });

        // Exibe o campo selecionado da tarefa 
        if (tipoTarefa == "feed") {
            document.getElementById("feed_container").style.display = 'block';
        } else if (tipoTarefa == "story") {
            document.getElementById("story_container").style.display = 'block';
        } else if (tipoTarefa == "video") {
            document.getElementById("video_container").style.display = 'block';
        }
    }

    window.onload = toggleTarefaFields;

    // Chama a função quando o tipo de tarefa for alterado
    document.getElementById("tipo_tarefa").addEventListener("change", toggleTarefaFields);
    </script>

</body>
</html>
