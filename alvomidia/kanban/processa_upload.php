<?php
session_start();
include_once "verifica.php";
include_once "conecta.php";


// Verifica se o formulário foi enviado e se o arquivo foi enviado sem erro
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['arquivo']) && $_FILES['arquivo']['error'] == 0) {

    // lugar onde os arquivos estão armazenados
    $uploadDir = 'uploads/';

    // Verifica se o diretório de uploads existe, caso contrário, cria ele
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true); // Cria o diretório se não existir
    }

    // Nome do arquivo original e sanitização
    $nome_arquivo = preg_replace("/[^a-zA-Z0-9.-_]/", "_", $_FILES['arquivo']['name']);

    // Caminho completo do arquivo (incluindo o diretório)
    $uploadFile = $uploadDir . $nome_arquivo;

    // Dados do formulário
    $tipoArquivo = $_POST['tipo_arquivo'];
    $tipoTarefa = $_POST['tipo_tarefa'];
    $clienteId = $_POST['cliente'];
    $id_tarefa_video = isset($_POST['id_tarefa_video']) ? $_POST['id_tarefa_video'] : NULL;
    $id_tarefa_storie = isset($_POST['id_tarefa_story']) ? $_POST['id_tarefa_story'] : NULL;
    $id_tarefa = isset($_POST['id_feed']) ? $_POST['id_feed'] : NULL;
    $data_upload = date('Y-m-d'); // Formato de data para o banco de dados
    $caminho_arquivo = 'kanban/database/'.$uploadFile;
    
    // Tenta mover o arquivo para o diretório de uploads
    if (move_uploaded_file($_FILES['arquivo']['tmp_name'], $uploadFile)) {

        switch ($tipoTarefa) {
            case 'feed':
                $query = "INSERT INTO arquivos (id_tarefa, id_tarefa_story, id_tarefa_video, tipo_arquivo, nome_arquivo, caminho_arquivo, data_upload) 
                                        VALUES ('$id_tarefa', NULL, NULL, '$tipoArquivo', '$nome_arquivo', '$caminho_arquivo', '$data_upload')";
                
                if ($conn->query($query) === TRUE) {
                    // Pega o ID do arquivo inserido
                    $id_upload = $conn->insert_id;

                    //Atualiza tarefa para adicionar o id do arquivo
                    $conn->query("UPDATE tarefas set arquivo_code_feed = '$id_upload' WHERE id_tarefa = '$id_tarefa'");

                    // Redireciona para uma página de sucesso
                    header('Location: ../upload.php?status=success');
                    exit();
                }else {
                    echo "Erro ao inserir no banco de dados.";
                }
                
                break;
            case 'story':
                $query = "INSERT INTO arquivos (id_tarefa, id_tarefa_story, id_tarefa_video, tipo_arquivo, nome_arquivo, caminho_arquivo, data_upload) 
                                        VALUES (NULL, '$id_tarefa_storie', NULL, '$tipoArquivo', '$nome_arquivo', '$caminho_arquivo', '$data_upload')";
                
                if ($conn->query($query) === TRUE) {

                    $id_upload = $conn->insert_id;
                    
                    $conn->query("UPDATE tarefas_stories set arquivo_code_feed = '$id_upload' WHERE id_tarefa_stories = '$id_tarefa_storie'");

                    header('Location: ../upload.php?status=success');
                    exit();
                }else {
                    echo "Erro ao inserir no banco de dados.";
                }
                
                break;
            case 'video':
                $query = "INSERT INTO arquivos (id_tarefa, id_tarefa_story, id_tarefa_video, tipo_arquivo, nome_arquivo, caminho_arquivo, data_upload) 
                                        VALUES (NULL, NULL, '$id_tarefa_video', '$tipoArquivo', '$nome_arquivo', '$caminho_arquivo', '$data_upload')";
                
                if ($conn->query($query) === TRUE) {

                    $id_upload = $conn->insert_id;
                    
                    $conn->query("UPDATE tarefas_video set arquivo_code_video = '$id_upload' WHERE id_tarefa_video = '$id_tarefa_video'");

                    header('Location: ../upload.php?status=success');
                    exit();
                }else {
                    echo "Erro ao inserir no banco de dados.";
                }
                
                break;
            
            default:
                header('Location: ../upload.php?status=success');
                break;
        }
    } else {
        echo "Erro no upload do arquivo.";
    }
} else {
    echo "Nenhum arquivo enviado ou erro no envio.";
}

?>
