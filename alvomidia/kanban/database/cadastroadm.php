<?php
session_start();

require_once 'conecta.php';

$_SESSION['erro'] = '';

if($_SERVER['REQUEST_METHOD'] === 'POST'){

    $nome = $_POST['nome'];
    $login = $_POST['login'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

    $sql = "SELECT * FROM adm WHERE login = '$login'";
    $result = $conn->query($sql);
    $user = mysqli_fetch_assoc($result);

    if($user){
        $_SESSION['erro'] = '*Usuário já cadastrado';
        header('Location: ../cadastroadm.php');
        die;
    }

    $sql = "INSERT INTO adm (nome, login, senha) VALUES ('$nome', '$login', '$senha')";

    if ($conn->query($sql) === TRUE) {
        echo "Cadastro realizado com sucesso!";   
        header('Refresh: 2; URL=../kanban.php');
    } 
    else {
        $_SESSION['erro'] = '*Não foi possível realizar o cadastro';
        header('Location: ../cadastroadm.php');
    }
}
else{
    header('Location: ../login.php');
}

$conn->close();
?>