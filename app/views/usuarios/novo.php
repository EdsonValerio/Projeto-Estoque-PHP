<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Novo Usuário</title>
</head>
<body>
    <h1>Cadastrar Novo Usuário</h1>
    <a href="?page=usuarios">Voltar para a Lista</a>
    <hr>

    <?php
    if (isset($_GET['error'])) {
        if ($_GET['error'] == 'empty_fields') {
            echo '<p style="color:red;">Por favor, preencha todos os campos obrigatórios.</p>';
        }
    }
    ?>

    <form action="?page=usuarios_salvar" method="POST">
        <div>
            <label for="nome_completo">Nome Completo:</label><br>
            <input type="text" id="nome_completo" name="nome_completo" required style="width: 300px;">
        </div>
        <br>
        <div>
            <label for="login">Login (Usuário):</label><br>
            <input type="text" id="login" name="login" required style="width: 300px;">
        </div>
        <br>
        <div>
            <label for="senha">Senha:</label><br>
            <input type="password" id="senha" name="senha" required style="width: 300px;">
        </div>
        <br>
        <div>
            <label for="nivel_acesso">Nível de Acesso:</label><br>
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
        </div>
    </form>
</body>
</html>