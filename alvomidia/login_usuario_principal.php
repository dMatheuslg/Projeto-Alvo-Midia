<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Usuário</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="login-container">
        <section class="form-section">
            <h2>Login</h2>
            <form class="form-cadastro" action="login_usuario.php" method="POST">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" placeholder="Digite seu email" required>

                <label for="senha">Senha:</label>
                <input type="password" id="senha" name="senha" placeholder="Digite sua senha" required>

                <button type="submit">Entrar</button>
                <label>Não tem uma conta? <a href="cadastre.php">Cadastre-se aqui</a></label>

                <?php
                if (!empty($_SESSION['erro'])) {
                    echo '<div class="error-message">' . $_SESSION['erro'] . '</div>';
                    $_SESSION['erro'] = ''; // Limpar erro após exibir
                }
                ?>
            </form>
        </section>
    </div>
</body>
</html>
