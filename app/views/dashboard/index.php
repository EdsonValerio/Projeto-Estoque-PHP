
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Painel - Controle de Estoque</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <?php
        if (isset($_GET['error']) && $_GET['error'] == 'permission') {
            echo '<p style="color:#ff8e8e;">Você não tem permissão para acessar esta página.</p>';
        }

        if (isset($_COOKIE['bem_vindo'])) {
            echo '<p style="background-color: #d4edda; color: #155724; padding: 10px; border-radius: 4px; border: 1px solid #c3e6cb;">
                    Login realizado com sucesso. Que bom te ver por aqui!
                </p>';

            setcookie('bem_vindo', '', time() - 3600, '/'); 
        }
        ?>
        <h1>Painel de Controle</h1>

        <p style="font-size: 18px;">Bem-vindo(a), <strong><?= htmlspecialchars($_SESSION['user_login']) ?></strong>!</p>

        <nav>
            <h3 style="border-bottom: 1px solid #4a8fdf; padding-bottom: 5px;">Gerenciar:</h3>
                <ul style="list-style: none; padding-left: 0;">
                    <li style="margin-bottom: 10px;"><a href="?page=produtos" class="btn">Estoque de Produtos</a></li>
                    <li style="margin-bottom: 10px;"><a href="?page=categorias" class="btn">Categorias de Produtos</a></li>
                    <?php if (isset($_SESSION['user_level']) && $_SESSION['user_level'] == 3): ?>
                        <li style="margin-bottom: 10px;">
                            <a href="?page=usuarios" class="btn">Usuários do Sistema</a>
                        </li>
                    <?php endif; ?>
                </ul>
        </nav>

        <br>
        <a href="?page=logout" style="color: #ff9d9d;">Sair do Sistema</a>
    </div>
</body>
</html>