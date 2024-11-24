<?php
session_start();
include_once 'database/conecta.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $senha = $_POST['senha'];

    // Verifica se o email existe no banco
    $sql = "SELECT * FROM usuarios WHERE email = '$email'";
    $result = $conn->query($sql);

    if (!$result) {
        die('Erro na consulta: ' . $conn->error);
    }

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // Verifica a senha
        if (password_verify($senha, $user['senha'])) {
            // Armazena o nome e o id do usuário na sessão
            $_SESSION['usuario'] = [
                'id' => $user['id_usuario'],
                'nome' => $user['nome']
            ];
            
            // Redireciona para a página de projetos após login
            header('Location: meusprojetos.php');
            exit();
        } else {
            $_SESSION['erro'] = 'Senha incorreta.';
        }
    } else {
        $_SESSION['erro'] = 'Usuário não encontrado.';
    }

    // Se houve erro, redireciona para a página de login com a mensagem de erro
    header('Location: index.php');
    exit();
}
?>
