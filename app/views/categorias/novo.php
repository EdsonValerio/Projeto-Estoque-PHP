<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Nova Categoria</title>
</head>
<body>
    <h1>Cadastrar Nova Categoria</h1>
    <a href="?page=categorias">Voltar para a Lista</a>
    <hr>

    <form action="?page=categorias_salvar" method="POST">
        <div>
            <input type="hidden" name="csrf_token" value="<?= gerarTokenCSRF(); ?>">
            <label for="nome">Nome da Categoria:</label><br>
            <input type="text" id="nome" name="nome_categoria" required style="width: 300px;">
        </div>
        <br>
        <div>
            <button type="submit">Salvar Categoria</button>
        </div>
    </form>
</body>
</html>