<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Usuário</title>
</head>
<body>
    <h1>Editar Usuário</h1>
    <a href="?page=usuarios">Voltar para a Lista</a>
    <hr>

    <form action="?page=usuarios_atualizar" method="POST">
        <input type="hidden" name="id_usuario" value="<?= htmlspecialchars($usuario['id_usuario']) ?>">

        <div>
            <label for="nome_completo">Nome Completo:</label><br>
            <input type="text" id="nome_completo" name="nome_completo" required style="width: 300px;" 
                    value="<?= htmlspecialchars($usuario['nome_completo']) ?>">
        </div>
        <br>
        <div>
            <label for="login">Login (Usuário):</label><br>
            <input type="text" id="login" name="login" required style="width: 300px;"
                    value="<?= htmlspecialchars($usuario['login']) ?>">
        </div>
        <br>
        <div>
            <label for="senha">Nova Senha (deixe em branco para não alterar):</label><br>
            <input type="password" id="senha" name="senha" style="width: 300px;">
            <small>Preencha apenas se deseja alterar a senha.</small>
        </div>
        <br>
        <div>
            <label for="nivel_acesso">Nível de Acesso:</label><br>
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
        </div>
    </form>
</body>
</html>