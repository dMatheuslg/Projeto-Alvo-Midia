<?php 
session_start();
// Verificar se o usuário está logado
if (!isset($_SESSION['usuario'])) {
    header('Location: cadastre.php');
    exit(); // Impede que o restante do código seja executado
}

include_once 'database/conecta.php';

// aqui voce consegue acessar sua conta
$usuario = $_SESSION['usuario'];

// Consulta se o Usuario existe
$sql = "SELECT * FROM usuarios WHERE id_usuario = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $usuario['id']);
$stmt->execute();
$result = $stmt->get_result();
$cliente = $result->fetch_assoc();

// Planos
$planos = ['basico' => 'Básico', 'premium' => 'Premium', 'empresarial' => 'Empresarial'];

// Se o formulário for enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['excluir_cadastro'])) {
        // Codígo para exclusao do usuário no banco de dados
        $sql_excluir = "DELETE FROM usuarios WHERE id_usuario = ?";
        $stmt = $conn->prepare($sql_excluir);
        $stmt->bind_param("i", $usuario['id']);
        
        if ($stmt->execute()) {
            // Se a exclusao estiver funcionado ele destroi a sessão e redireciona 
            session_destroy();
            header('Location: cadastre.php');
            exit(); 
        } else {
            echo "<p class='erro'>Erro ao excluir o cadastro. Tente novamente.</p>";
        }
    } else {
        // capta a Atualização de informação
        $novo_email = $_POST['email'];
        $nova_senha = $_POST['senha'];
        $novo_plano = $_POST['plano'];

        // Se a senha for informada, a senha será alterada, senão, será mantida a atual
        if (!empty($nova_senha)) {
            // Criptografa a nova senha
            $nova_senha = password_hash($nova_senha, PASSWORD_DEFAULT);
            // Atualiza a senha no banco de dados
            $sql_update = "UPDATE usuarios SET email = ?, senha = ?, plano = ? WHERE id_usuario = ?";
        } else {
            // Mantem a senha atual caso o campo senha esteja vazio
            $sql_update = "UPDATE usuarios SET email = ?, plano = ? WHERE id_usuario = ?";
        }

        // Prepara a query de atualização
        $stmt = $conn->prepare($sql_update);
        if (!empty($nova_senha)) {
            // Se a senha foi preenchida, inclui a senha criptografada
            $stmt->bind_param("sssi", $novo_email, $nova_senha, $novo_plano, $usuario['id']);
        } else {
            // Se a senha não foi preenchida, apenas atualiza email e plano
            $stmt->bind_param("ssi", $novo_email, $novo_plano, $usuario['id']);
        }

        if ($stmt->execute()) {
            echo "<p class='sucesso'>Alterações realizadas com sucesso!</p>";
        } else {
            echo "<p class='erro'>Erro ao atualizar os dados. Tente novamente.</p>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="PT-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.2.0/remixicon.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Minha Conta - Alvo Mídia</title>
</head>
<body>
    <nav>
        <div class="nav-logo">
            <a href="#">
                <img src="images/logo_semfundo.png" alt="Logo Empresa">
            </a>
            <p class="nome-empresa">Alvo Mídia</p>
        </div>

        <ul class="nav-links">
            <li class="link"><a href="index.php">Início</a></li>
            <li class="link"><a href="index.php#planos">Planos</a></li>
            <li class="link"><a href="sobre.php">Sobre Nós</a></li>
            <li class="link"><a href="minhaconta.php">Minha Conta</a></li>
            <li class="link"><a href="meusprojetos.php">Meus Projetos</a></li>
        </ul>
        <a href="logout1.php" class="cadastro_btn">Sair da minha conta</a>
    </nav>
    <section class="form-section">
        <h2>Minha Conta</h2>
        <form class="form-cadastro" method="POST" action="">
            <label for="email">Alterar Email</label>
            <input type="email" id="email" name="email" placeholder="Digite seu novo email" value="<?php echo $cliente['email']?>" required>

            <label for="senha">Alterar Senha</label>
            <input type="password" id="senha" name="senha" placeholder="Digite sua nova senha">

            <label for="plano">Selecionar Plano</label>
            <select id="plano" name="plano">
                <?php
                    foreach ($planos as $key => $value) {
                        $selected = ($key == $cliente['plano']) ? 'selected' : '';
                        echo "<option value='$key' $selected>$value</option>";
                    }
                ?>
            </select>
            <button type="submit" name="excluir_cadastro" class="cancelar-plano">Excluir Cadastro</button>
            <button type="submit">Salvar Alterações</button>
        </form>
    </section>

    <!-- Rodapé -->
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
</body>
</html>
