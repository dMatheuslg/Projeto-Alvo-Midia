<?php
session_start();
include_once "database/verifica.php";
?>

<!DOCTYPE html>
<html lang="PT-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <title>Cadastro</title>
</head>

<body>
    <div class="login-container">
        <div class="form-box">
            <h1>Cadastrar Admistrador</h1>
            <form id="loginForm" action="database/cadastroadm.php" method="POST">
                <input type="text" placeholder="Nome" name="nome" required>
                <input type="text" placeholder="Login" name="login" required>
                <input type="password" placeholder="Senha" name="senha" required>
                <?php 
                    if(isset($_SESSION['erro'])){
                        echo "<p class='msg-erro'>".$_SESSION['erro']."</p>";
                    }
                ?>
                <button type="submit">Cadastrar</button>
            </form>
            <a href="kanban.php">Voltar</a>
        </div>
    </div>

</body>

</html>
