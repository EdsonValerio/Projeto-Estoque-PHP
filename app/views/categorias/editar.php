<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Categoria</title>
</head>
<body>
    <h1>Editar Categoria</h1>
    <a href="?page=categorias">Voltar para a Lista</a>
    <hr>

    <form action="?page=categorias_atualizar" method="POST">
        <input type="hidden" name="csrf_token" value="<?= gerarTokenCSRF(); ?>">
        <input type="hidden" name="id_categoria" value="<?= $categoria['id_categoria'] ?>">

        <div>
            <label for="nome">Nome da Categoria:</label><br>
            <input type="text" id="nome" name="nome_categoria" required style="width: 300px;" 
                   value="<?= htmlspecialchars($categoria['nome_categoria']) ?>">
        </div>
        <br>
        <div>
            <button type="submit">Salvar Alterações</button>
        </div>
    </form>

</body>
</html>