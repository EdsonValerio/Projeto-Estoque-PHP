<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Novo Produto</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h1>Cadastrar Novo Produto</h1>

        <form action="?page=produtos_salvar" method="POST">
            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token'] ?? '') ?>">
            
            <div>
                <label for="nome">Nome do Produto:</label>
                <input type="text" id="nome" name="nome_produto" required>
            </div>
            <br>
            <div>
                <label for="qtd">Quantidade em Estoque:</label>
                <input type="number" id="qtd" name="quantidade_estoque" required min="0">
            </div>
            <br>
            <div>
                <label for="preco">Preço (R$):</label>
                <input type="text" id="preco" name="preco_unidade" required placeholder="Ex: 123,45">
            </div>
            <br>
            <div>
                <label for="categoria">Categoria:</label>
                <select id="categoria" name="id_categoria" required>
                    <option value="">Selecione uma categoria</option>
                    <?php
                    foreach ($categorias as $categoria) {
                        echo "<option value='" . $categoria['id_categoria'] . "'>"
                           . htmlspecialchars($categoria['nome_categoria'])
                           . "</option>";
                    }
                    ?>
                </select>
            </div>
            <br>
            <div>
                <button type="submit">Salvar Produto</button>
                <a href="?page=produtos" class="btn" style="background: linear-gradient(to bottom, #ccc, #999);">Voltar para a Lista</a>
            </div>
        </form>
    </div>
</body>
</html>