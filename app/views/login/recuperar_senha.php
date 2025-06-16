<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Senha - Controle de Estoque</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container login-container">
        <h1>Recuperar Senha</h1>
        
        <?php
        if (isset($_GET['status']) && $_GET['status'] == 'success') {
            echo '<p style="color:green;">Sua senha foi redefinida com sucesso! Use a nova senha para entrar.</p>';
        }
        if (isset($_GET['error'])) {
            $error_msg = '';
            switch ($_GET['error']) {
                case 'empty':
                    $error_msg = 'Por favor, preencha todos os campos.';
                    break;
                case 'mismatch':
                    $error_msg = 'As senhas não coincidem.';
                    break;
                case 'user_not_found':
                    $error_msg = 'CPF ou Data de Nascimento não correspondem a um usuário válido.';
                    break;
                case 'reset_failed':
                    $error_msg = 'Não foi possível redefinir sua senha. Tente novamente.';
                    break;
                default:
                    $error_msg = 'Ocorreu um erro. Tente novamente.';
                    break;
            }
            echo '<p style="color:red;">' . $error_msg . '</p>';
        }
        ?>

        <form action="?page=recuperar_senha_action" method="POST">
            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token'] ?? '') ?>">
            <div>
                <label for="cpf">CPF:</label>
                <input type="text" id="cpf" name="cpf" required placeholder="Ex: 123.456.789-00">
            </div>
            <br>
            <div>
                <label for="data_nascimento">Data de Nascimento:</label>
                <input type="date" id="data_nascimento" name="data_nascimento" required>
            </div>
            <br>
            <div>
                <label for="nova_senha">Nova Senha:</label>
                <input type="password" id="nova_senha" name="nova_senha" required>
            </div>
            <br>
            <div>
                <label for="confirma_senha">Confirme a Nova Senha:</label>
                <input type="password" id="confirma_senha" name="confirma_senha" required>
            </div>
            <br>
            <div>
                <button type="submit">Redefinir Senha</button>
            </div>
        </form>
        <p><a href="?page=login">Voltar para o Login</a></p>
    </div>
</body>
</html>