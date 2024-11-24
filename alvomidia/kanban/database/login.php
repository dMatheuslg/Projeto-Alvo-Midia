<?php
session_start();

require_once 'conecta.php';

$_SESSION['erro'] = '';

if($_SERVER['REQUEST_METHOD'] === 'POST'){

    $login = $_POST['login'];
    $senha = $_POST['senha'];

    $sql = "SELECT * FROM adm WHERE login = '$login'";
    $result = $conn->query($sql);
    $user = mysqli_fetch_assoc($result);

    if($user && password_verify($senha, $user['senha'])){

        $_SESSION['usuario'] = $user['nome'];
        header('Location: ../kanban.php');
        exit();
    }
    else{
        $_SESSION['erro'] = '*Usuário ou senha inválidos!';
        header('Location: ../login.php');
    }
}
else{
    header('Location: ../login.php');
}

$conn->close();
?>