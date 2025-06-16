<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Novo Usuário</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h1>Cadastrar Novo Usuário</h1>

        <?php
        if (isset($_GET['error']) && $_GET['error'] == 'empty_fields') {
            echo '<p style="color:#ff8e8e;">Por favor, preencha todos os campos obrigatórios.</p>';
        }
        ?>

        <form action="?page=usuarios_salvar" method="POST">
            <input type="hidden" name="csrf_token" value="<?= gerarTokenCSRF(); ?>">

            <div>
                <label for="nome_completo">Nome Completo:</label>
                <input type="text" id="nome_completo" name="nome_completo" required>
            </div>
            <br>
            <div>
                <label for="login">Login (Usuário):</label>
                <input type="text" id="login" name="login" required>
            </div>
            <br>
            <div>
                <label for="senha">Senha:</label>
                <input type="password" id="senha" name="senha" required>
            </div>
            <br>
            <div>
                <label for="nivel_acesso">Nível de Acesso:</label>
                <select id="nivel_acesso" name="nivel_acesso" required>
                    <option value="">Selecione o nível</option>
                    <?php
                    foreach ($niveisAcesso as $valor => $nome) {
                        echo "<option value='" . htmlspecialchars($valor) . "'>" . htmlspecialchars($nome) . "</option>";
                    }
                    ?>
                </select>
            </div>
            <br>
            <div>
                <button type="submit">Salvar Usuário</button>
                <a href="?page=usuarios" class="btn" style="background: linear-gradient(to bottom, #ccc, #999);">Voltar para a Lista</a>
            </div>
        </form>
    </div>
</body>
</html>