<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastre-se - Sistema de Estoque</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container" style="max-width: 500px;">
        <h1>Crie sua Conta</h1>
        <p>Preencha os campos abaixo para se registrar no sistema.</p>
        <br>

        <?php
        // Bloco para exibir mensagens de erro, se houver
        if (isset($_GET['error'])) {
            $error_msg = '';
            if ($_GET['error'] == 'empty') {
                $error_msg = 'Todos os campos são obrigatórios.';
            } elseif ($_GET['error'] == 'login_exists') {
                $error_msg = 'Este nome de usuário já está em uso. Por favor, escolha outro.';
            }
            echo '<p style="color:#ff8e8e;">' . $error_msg . '</p>';
        }
        ?>

        <form action="?page=register_action" method="POST">
            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token'] ?? '') ?>">

            <div>
                <label for="nome_completo">Nome Completo:</label>
                <input type="text" id="nome_completo" name="nome_completo" required>
            </div>
            <br>
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
                <label for="login">Login (Nome de Usuário):</label>
                <input type="text" id="login" name="login" required>
            </div>
            <br>
            <div>
                <label for="senha">Senha:</label>
                <input type="password" id="senha" name="senha" required>
            </div>
            <br>
            <div>
                <button type="submit">Cadastrar</button>
            </div>
        </form>
        <hr style="margin-top: 20px; border-color: #4a8fdf;">
        <p style="text-align: center;">
            Já tem uma conta? <a href="?page=login">Faça o login aqui</a>.
        </p>
    </div>
</body>
</html>