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
            <h1>Redefinir Senha</h1>
            <form id="loginForm" action="database/recuperasenha.php" method="POST">
                <input type="text" placeholder="Login" name="login" required>
                <input type="password" placeholder="Nova Senha" name="senha" required>
                <button type="submit">Enviar</button>
            </form>            
            <?php 
                if(isset($_SESSION['erro'])){
                    echo "<p class='msg-erro'>".$_SESSION['erro']."</p>";
                }
            ?>
        </div>
    </div>

</body>

</html>
