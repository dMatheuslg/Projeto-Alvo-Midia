<?php
session_start();

if (isset($_GET['from']) && $_GET['from'] === 'no_account') {
    echo "
    <script>
        alert('Hum, vi aqui que ainda não tem uma conta conosco. Aperte ok e se junte ao nosso time!');
    </script>
    ";
}
?>

<!DOCTYPE html>
<html lang="PT-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.2.0/remixicon.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Alvo-cadastro</title>
</head>
<body>
    <nav>
        <div class="nav-logo">
            <a href="#">
                <img src="images/logo_semfundo.png" alt="Logo Empresa">
            </a>
            <p class="nome-empresa"> Alvo mídia</p>
        </div>
        <ul class="nav-links">
            <li class="link"><a href="index.php">Início</a></li>
            <li class="link"><a href="index.php#planos">Planos</a></li>
            <li class="link"><a href="sobre.php">Sobre Nós</a></li>
            <li class="link"><a href="minhaconta.php">Minha Conta</a></li>
            <li class="link"><a href="meusprojetos.php">Meus Projetos</a></li>
        </ul>
        <a href="cadastre.php" class="cadastro_btn">Cadastre-se/login</a>
    </nav>

    <section class="form-section">
        <h2>Cadastre-se</h2>
        <form class="form-cadastro" action="database/cadastrar.php" method="POST">
            <label for="nome">Nome/Razão Social:</label>
            <input type="text" id="nome" name="nome" placeholder="Digite seu nome ou razão social" required>
            
            <label for="cpf_cnpj">CPF/CNPJ:</label>
            <input type="text" id="cpf_cnpj" name="cpf_cnpj" placeholder="Digite seu CPF ou CNPJ" required>
            
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="Digite seu email" required>

            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" placeholder="Crie sua senha" required>

            <label for="plano">Selecionar Plano</label>
              <select id="plano" name="plano">
                <option>Sem plano, quero receber as promoções por email</option>
                <option value="basico">Básico</option>
                <option value="premium">Premium</option>
                <option value="empresarial">Empresarial</option>
            </select>
            <?php 
                    if(isset($_SESSION['erro'])){
                        echo "<p class='msg-erro'>".$_SESSION['erro']."</p>";
                    }
                ?>
            <button type="submit">Enviar</button>
            <label>já tem uma conta?</label>
        </form>
        <a href="login_usuario_principal.php"><button class="cadastro_btn">Entrar</button></a>
    </section>

    <footer class="container">
        <span class="blur"></span>
        <span class="blur"></span>
        <div class="footer-content">
            <div class="logo">
                <img src="images/logo_semfundo.png" alt="Logo Empresa">
            </div>
            <p>Conecte-se com o futuro da sua marca. Conte conosco para uma presença online de sucesso!</p>
            <div class="socials">
                <a href="#"><i class="ri-youtube-line"></i></a>
                <a href="#"><i class="ri-instagram-line"></i></a>
                <a href="#"><i class="ri-twitter-line"></i></a>
            </div>
            <div class="column">
                <h4>Company</h4>
                <a href="#">Business</a>
                <a href="#">Partnership</a>
                <a href="#">Network</a>
            </div>
            <div class="column">
                <h4>About Us</h4>
                <a href="#">Blogs</a>
                <a href="#">Channels</a>
                <a href="#">Sponsors</a>
            </div>
            <div class="column">
                <h4>Contact</h4>
                <a href="#">Contact Us</a>
                <a href="#">Privacy Policy</a>
                <a href="#">Terms & Conditions</a>
            </div>
        </div>
    </footer>

    <div class="copyright">
    Copyright © 2024 Todos os Direitos Reservados.
    </div>

    <script src="script.js"></script>
</body>
</html>
