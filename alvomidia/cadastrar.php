<?php
session_start();

include_once 'database/conecta.php';

$_SESSION['erro'] = ''; // Limpar mensagens de erro

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = mysqli_real_escape_string($conn, $_POST['nome']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

    // Verificar se o email já está cadastrado
    $sql = "SELECT * FROM usuarios WHERE email = '$email'";
    $result = $conn->query($sql);

    if (!$result) {
        die('Erro na consulta: ' . $conn->error);
    }

    $user = $result->fetch_assoc();

    if ($user) {
        $_SESSION['erro'] = '*E-mail já cadastrado.';
        header('Location: cadastro_usuario.php');
        die;
    }

    // Inserir novo usuário no banco
    $sql = "INSERT INTO usuarios (nome, cpf_cnpj, email, senha, plano) VALUES ('$nome', '$cpf_cnpj', '$email', '$senha', '$plano')";

    if ($conn->query($sql) === TRUE) {
        echo "Cadastro realizado com sucesso!";
        header('Refresh: 2; URL=login_usuario.php');
    } else {
        $_SESSION['erro'] = 'Erro ao realizar o cadastro: ' . $conn->error;
        header('Location: cadastro_usuario.php');
    }
} else {
    header('Location: cadastro_usuario.php');
}

$conn->close();
?>
