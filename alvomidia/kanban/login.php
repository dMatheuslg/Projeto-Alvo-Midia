<?php
session_start();
?>

<!DOCTYPE html>
<html lang="PT-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <title>Login</title>
</head>

<body>
    <div class="login-container">
        <div class="form-box">
            <h1>Login</h1>
            <form id="loginForm" action="database/login.php" method="POST">
                <input type="text" placeholder="Login" name="login" required>
                <input type="password" placeholder="Senha" name="senha" required>
                <button type="submit">Entrar</button>
            </form>            
            <a href="recuperasenha.php">Esqueceu sua senha?</a>
            <?php 
                if(isset($_SESSION['erro'])){
                    echo "<p class='msg-erro'>".$_SESSION['erro']."</p>";
                }
            ?>
        </div>
    </div>

</body>

</html>
