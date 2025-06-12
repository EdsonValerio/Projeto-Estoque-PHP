<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Nova Categoria</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h1>Cadastrar Nova Categoria</h1>
        
        <form action="?page=categorias_salvar" method="POST">
            <div>
                <label for="nome">Nome da Categoria:</label>
                <input type="text" id="nome" name="nome_categoria" required>
            </div>
            <br>
            <div>
                <button type="submit">Salvar Categoria</button>
                <a href="?page=categorias" class="btn" style="background: linear-gradient(to bottom, #ccc, #999);">Voltar para a Lista</a>
            </div>
        </form>
    </div>
</body>
</html>