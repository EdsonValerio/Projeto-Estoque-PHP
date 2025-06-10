<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Painel - Controle de Estoque</title>
</head>
<body>
    <h1>Painel de Controle</h1>
    
    <p>Bem-vindo(a), <?= htmlspecialchars($_SESSION['user_login']) ?>!</p>
    
    <hr>
    
    <nav>
        <h3>Gerenciar:</h3>
        <ul>
            <li><a href="?page=produtos">Estoque de Produtos</a></li>
            </ul>
    </nav>
    
    <br>
    
    <a href="?page=logout">Sair do Sistema</a>
</body>
</html>