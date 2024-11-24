<?php
session_start();
// Verifica se o usuario está logado
if (!isset($_SESSION['usuario'])) {
    // Se nao estiver logado, redireciona para a página de login ou cadastro
    header('Location: cadastre.php');
    exit();
}

include_once 'database/conecta.php';

// Agora você pode acessar os dados do usuário na sessão
$usuario = $_SESSION['usuario'];

$sql = "SELECT t.*, a.* FROM tarefas t 
        INNER JOIN arquivos a ON (t.arquivo_code_feed = a.id_arquivo)
        WHERE cliente_cod = '{$usuario['id']}'";

$result = $conn->query($sql);
$tarefas = [];

$count = 0;
if ($result->num_rows > 0) {
    while ($tarefa = $result->fetch_assoc()) {
        $tarefas[] = $tarefa;
        $tarefas[$count]['tipo'] = 'Feed';
        $count++;
    }
}

?>

<!DOCTYPE html>
<html lang="PT-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.2.0/remixicon.min.css">
    <link rel="stylesheet" href="style.css?V=<?php echo time()?>">
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
            <li class="link"><a href="index.php">Início</a></li>
            <li class="link"><a href="index.php#planos">Planos</a></li>
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

    <title>Meus projetos</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: 'Noto Sans', sans-serif;
            background-color: #181818;
            margin: 0;
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #181818;
        }
        th {
            background-color: #7851A9;
            color: white;
        }
        tr:hover {
            background-color: #181818;
        }
        button{
            width: 100px;
            margin-top:200px;
            padding: 12px;
            background-color: #7851A9; 
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
        }
    </style>
</head>
<body>
    <section class="section-table">
        <h1>Meus Projetos</h1>
        
        <table id="tabela-relatorios">
            <thead>
                <tr>
                    <th>Descrição</th>
                    <th>Tipo</th>
                    <th>Data e Hora Agendada</th>
                    <th>Situação</th>
                    <th>Arquivo</th>
                </tr>
            </thead>
            <tbody>
                
                <?php
                    if(empty($tarefas)){
                        echo "<tr>
                                <td colspan='4'>Nenhuma projeto encontrado</td>
                            </tr>";
                    }

                    foreach ($tarefas as $key => $tarefa) {
                        echo "<tr>
                                <td>{$tarefa['descricao']}</td>
                                <td>{$tarefa['tipo']}</td>
                                <td>{$tarefa['data_hora']}</td>
                                <td>".ucfirst($tarefa['status'])."</td>
                                <td><a href='{$tarefa['caminho_arquivo']}' download>Baixar arquivo</a></td>
                            </tr>";
                    }            
                ?>
            </tbody>
        </table>
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