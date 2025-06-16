<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Controle de Estoque</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container" style="max-width: 400px;">
        <?php
        if (isset($_GET['success']) && $_GET['success'] == 'register') {
            echo '<p style="color:#a7e8a7;">Cadastro realizado com sucesso! Você já pode fazer o login.</p>';
        }
        ?>
        <h1>Acessar o Sistema</h1>
        
        <?php
        if (isset($_GET['error'])) {
            $error_msg = '';
            switch ($_GET['error']) {
                case 'invalid':
                    $error_msg = 'Usuário ou senha inválidos!';
                    break;
                case 'empty':
                    $error_msg = 'Por favor, preencha todos os campos.';
                    break;
                case 'auth':
                    $error_msg = 'Você precisa estar logado para acessar esta página.';
                    break;
                default:
                    $error_msg = 'Ocorreu um erro. Tente novamente.';
                    break;
            }
            echo '<p style="color:red;">' . $error_msg . '</p>';
        }
        ?>

        <form action="?page=login_action" method="POST">
            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token'] ?? '') ?>">
            <div>
                <label for="login">Usuário:</label>
                <input type="text" id="login" name="login" required>
            </div>
            <br>
            <div>
                <label for="senha">Senha:</label>
                <input type="password" id="senha" name="senha" required>
            </div>
            <br>
            <div>
                <button type="submit">Entrar</button>
            </div>
        </form>
        <hr style="margin-top: 20px; border-color: #4a8fdf;">
        <p style="text-align: center;">
            Não tem uma conta? <a href="?page=register">Cadastre-se aqui</a>.
        </p>
        <p style="text-align: center;">
            <a href="?page=recuperar_senha">Esqueceu sua senha?</a>
        </p>
    </div>
</body>
</html>