<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Painel - Controle de Estoque</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h1>Painel de Controle</h1>

        <p style="font-size: 18px;">Bem-vindo(a), <strong><?= htmlspecialchars($_SESSION['user_login']) ?></strong>!</p>

        <nav>
            <h3 style="border-bottom: 1px solid #4a8fdf; padding-bottom: 5px;">Gerenciar:</h3>
            <ul style="list-style: none; padding-left: 0;">
                <li style="margin-bottom: 10px;"><a href="?page=produtos" class="btn">Estoque de Produtos</a></li>
                <li style="margin-bottom: 10px;"><a href="?page=categorias" class="btn">Categorias de Produtos</a></li>
                <li style="margin-bottom: 10px;"><a href="?page=usuarios" class="btn">Usuários do Sistema</a></li>
            </ul>
        </nav>

        <br>
        <a href="?page=logout" style="color: #ff9d9d;">Sair do Sistema</a>
    </div>
</body>
</html>