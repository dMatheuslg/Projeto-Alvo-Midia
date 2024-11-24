<?php
session_start();

include_once 'conecta.php';

$_SESSION['erro'] = ''; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $cpf_cnpj = $_POST['cpf_cnpj'];
    $email =  $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
    $plano = $_POST['plano']; 
   
    $sql = "SELECT * FROM usuarios WHERE email = '$email'";
    $result = $conn->query($sql);

    if (!$result) {
        die('Erro na consulta: ' . $conn->error);
    }

    $user = $result->fetch_assoc();

    if ($user) {
        $_SESSION['erro'] = '*E-mail já cadastrado.';
        header('Location: ../cadastre.php');
        die;
    }
   
    $sql = "SELECT * FROM usuarios WHERE cpf_cnpj = '$cpf_cnpj'";
    $result = $conn->query($sql);

    $user = $result->fetch_assoc();
    
    if ($user) {
        $_SESSION['erro'] = '*CPF ou CNPJ já cadastrado.';
        header('Location: ../cadastre.php');
        die;
    }

   

    $sql = "INSERT INTO usuarios (nome, cpf_cnpj, email, senha, plano) VALUES ('$nome', '$cpf_cnpj', '$email', '$senha', '$plano')";

    if ($conn->query($sql) === TRUE) {
        echo "Cadastro realizado com sucesso!";
        header('Refresh: 2; URL=../login_usuario.php');
    } else {
        $_SESSION['erro'] = 'Erro ao realizar o cadastro: ' . $conn->error;
        header('Location: ../cadastre.php');
    }
} else {
    header('Location: ../cadastre.php');
}

$conn->close();
?>
