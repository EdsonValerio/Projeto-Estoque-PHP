<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Usuário</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h1>Editar Usuário</h1>

        <form action="?page=usuarios_atualizar" method="POST">
            <input type="hidden" name="id_usuario" value="<?= htmlspecialchars($usuario['id_usuario']) ?>">

            <div>
                <label for="nome_completo">Nome Completo:</label>
                <input type="text" id="nome_completo" name="nome_completo" required value="<?= htmlspecialchars($usuario['nome_completo']) ?>">
            </div>
            <br>
            <div>
                <label for="login">Login (Usuário):</label>
                <input type="text" id="login" name="login" required value="<?= htmlspecialchars($usuario['login']) ?>">
            </div>
            <br>
            <div>
                <label for="senha">Nova Senha (deixe em branco para não alterar):</label>
                <input type="password" id="senha" name="senha">
            </div>
            <br>
            <div>
                <label for="nivel_acesso">Nível de Acesso:</label>
                <select id="nivel_acesso" name="nivel_acesso" required>
                    <option value="">Selecione o nível</option>
                    <?php
                    foreach ($niveisAcesso as $valor => $nome) {
                        $selected = ($valor == $usuario['nivel_acesso']) ? 'selected' : '';
                        echo "<option value='" . htmlspecialchars($valor) . "' " . $selected . ">" . htmlspecialchars($nome) . "</option>";
                    }
                    ?>
                </select>
            </div>
            <br>
            <div>
                <button type="submit">Salvar Alterações</button>
                <a href="?page=usuarios" class="btn" style="background: linear-gradient(to bottom, #ccc, #999);">Voltar para a Lista</a>
            </div>
        </form>
    </div>
</body>
</html>