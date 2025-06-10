<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Novo Produto</title>
</head>
<body>
    <h1>Cadastrar Novo Produto</h1>
    <a href="?page=produtos">Voltar para a Lista</a>
    <hr>

    <form action="?page=produtos_salvar" method="POST">
        <div>
            <label for="nome">Nome do Produto:</label><br>
            <input type="text" id="nome" name="nome_produto" required style="width: 300px;">
        </div>
        <br>
        <div>
            <label for="qtd">Quantidade em Estoque:</label><br>
            <input type="number" id="qtd" name="quantidade_estoque" required min="0">
        </div>
        <br>
        <div>
            <label for="preco">Preço (R$):</label><br>
            <input type="text" id="preco" name="preco_unidade" required placeholder="Ex: 123,45">
        </div>
        <br>
        <div>
            <label for="categoria">Categoria:</label><br>
            <select id="categoria" name="id_categoria" required>
                <option value="">Selecione uma categoria</option>
                <?php
                // Itera sobre a variável $categorias, que veio do controller
                foreach ($categorias as $categoria) {
                    // O 'value' do option será o ID, e o texto será o nome
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
        </div>
    </form>

</body>
</html>