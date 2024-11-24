<?php
session_start();

require_once 'conecta.php';

$_SESSION['erro'] = '';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $login = $_POST['login'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

    $sql = "UPDATE adm SET senha = '$senha' WHERE login = '$login'";

    if ($conn->query($sql) === TRUE) {
        header('Location: ../login.php');  
    } 
    else {
        $_SESSION['erro'] = '*Não foi possível atualizar a senha';
        header('Location: ../recuperasenha.php');
    }
}
else {
    header('Location: ../login.php');
}

$conn->close();
?>