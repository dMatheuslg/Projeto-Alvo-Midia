<?php
session_start();
?>

<!DOCTYPE html>
<html lang="PT-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.2.0/remixicon.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Alvo-inicio</title>
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
            <li class="link"><a href="#">Início</a></li>
            <li class="link"><a href="#planos">Planos</a></li>
            <li class="link"><a href="sobre.php">Sobre Nós</a></li>
            <li class="link"><a href="minhaconta.php">Minha Conta</a></li>
            <li class="link"><a href="meusprojetos.php">Meus Projetos</a></li>
        </ul>

       <?php if (isset($_SESSION['usuario'])): ?>
            <div class="user-greeting">
           <h4>Olá, <?php echo $_SESSION['usuario']['nome']; ?></h4>
            </div>
        <?php else: ?>
            <a href="cadastre.php" class="cadastro_btn">Cadastre-se/login</a>
        <?php endif; ?>

    </nav>

    <header class="container">
        <div class="content">
            <span class="blur"></span>
            <span class="blur"></span>
            <h1>Transforme Sua Presença <span>Online</span> com Nossos Planos de Assinatura</h1>
            <p>Na era digital, a imagem é tudo. Elevamos sua marca com conteúdos visuais impactantes para redes sociais e websites. Nossos planos de assinatura oferecem flexibilidade e resultados excepcionais.</p>
        </div>
        <a href="#planos" class="explorar_btn">Explorar Planos</a>
    </header>
    <img class="alvo" src="./images/alvo_semfundo.png" alt="">

    <section class="container" id="planos">
        <h2 class="header">Nossos Planos</h2>
        <p class="sub-header">
            Escolha o plano perfeito para impulsionar sua presença digital e atrair mais clientes.
        </p>
        <div class="pricing">
            <div class="card">
                <div class="content">
                    <h4>Plano Básico</h4>
                    <h3>R$ 1000,00</h3>
                    <p><i class="ri-checkbox-circle-line"></i> 15 Artes</p>
                    <p><i class="ri-checkbox-circle-line"></i> 20 Stories</p>
                    <p><i class="ri-checkbox-circle-line"></i> 3 Reels</p>
                    <p><i class="ri-checkbox-circle-line"></i> Modelagem de Perfil</p>
                    <a href="cadastre.php"><button class="btn">Assinar</button></a>
                </div>
            </div>
            <div class="card">
                <div class="content">
                    <h4>Plano Premium</h4>
                    <h3>R$ 2500,00</h3>
                    <p><i class="ri-checkbox-circle-line"></i> 20 Artes</p>
                    <p><i class="ri-checkbox-circle-line"></i> 30 Stories</p>
                    <p><i class="ri-checkbox-circle-line"></i> 8 Reels</p>
                    <p><i class="ri-checkbox-circle-line"></i> Modelagem de Perfil</p>
                    <a href="cadastre.php"><button class="btn">Assinar</button></a>
                </div>
            </div>
            <div class="card">
                <div class="content">
                    <h4>Plano Empresarial</h4>
                    <h3>R$ 5000,00</h3>
                    <p><i class="ri-checkbox-circle-line"></i> 20 Artes</p>
                    <p><i class="ri-checkbox-circle-line"></i> 30 Stories</p>
                    <p><i class="ri-checkbox-circle-line"></i> 12 Reels</p>
                    <p><i class="ri-checkbox-circle-line"></i> Modelagem de Perfil</p>
                    <p><i class="ri-checkbox-circle-line"></i> Geração de lead qualificado</p>
                    <a href="cadastre.php"><button class="btn">Assinar</button></a>
                </div>
            </div>
        </div>
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
                <h4>Empresa</h4>
                <a href="#">Business</a>
                <a href="#">Parcerias</a>
                <a href="#">Network</a>
            </div>
            <div class="column">
                <h4>Sobre Nós</h4>
                <a href="#">Blogs</a>
                <a href="#">Canais</a>
                <a href="#">Patrocinadores</a>
            </div>
            <div class="column">
                <h4>Contato</h4>
                <a href="#">Fale Conosco</a>
                <a href="#">Política de Privacidade</a>
                <a href="#">Termos & Condições</a>
            </div>
        </div>
    </footer>
    
    <div class="copyright">
        Copyright © 2024 Todos os Direitos Reservados.
    </div>

    <script src="script.js"></script>
</body>
</html>
