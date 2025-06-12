<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Categoria</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h1>Editar Categoria</h1>
        
        <form action="?page=categorias_atualizar" method="POST">
            <input type="hidden" name="id_categoria" value="<?= $categoria['id_categoria'] ?>">

            <div>
                <label for="nome">Nome da Categoria:</label>
                <input type="text" id="nome" name="nome_categoria" required value="<?= htmlspecialchars($categoria['nome_categoria']) ?>">
            </div>
            <br>
            <div>
                <button type="submit">Salvar Alterações</button>
                <a href="?page=categorias" class="btn" style="background: linear-gradient(to bottom, #ccc, #999);">Voltar para a Lista</a>
            </div>
        </form>
    </div>
</body>
</html>