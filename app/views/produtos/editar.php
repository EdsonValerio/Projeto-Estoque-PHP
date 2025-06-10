<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Produto</title>
</head>
<body>
    <h1>Editar Produto</h1>
    <a href="?page=produtos">Voltar para a Lista</a>
    <hr>

    <form action="?page=produtos_atualizar" method="POST">
        <input type="hidden" name="id_produto" value="<?= $produto['id_produto'] ?>">

        <div>
            <label for="nome">Nome do Produto:</label><br>
            <input type="text" id="nome" name="nome_produto" required style="width: 300px;" 
                   value="<?= htmlspecialchars($produto['nome_produto']) ?>">
        </div>
        <br>
        <div>
            <label for="qtd">Quantidade em Estoque:</label><br>
            <input type="number" id="qtd" name="quantidade_estoque" required min="0"
                   value="<?= $produto['quantidade_estoque'] ?>">
        </div>
        <br>
        <div>
            <label for="preco">Preço (R$):</label><br>
            <input type="text" id="preco" name="preco_unidade" required placeholder="Ex: 123,45"
                   value="<?= number_format($produto['preco_unidade'], 2, ',', '.') ?>">
        </div>
        <br>
        <div>
            <label for="categoria">Categoria:</label><br>
            <select id="categoria" name="id_categoria" required>
                <option value="">Selecione uma categoria</option>
                <?php
                // Itera sobre a variável $categorias (lista completa)
                foreach ($categorias as $categoria) {
                    // Verifica se o ID da categoria atual é o mesmo do produto que estamos editando
                    $selected = ($categoria['id_categoria'] == $produto['id_categoria']) ? 'selected' : '';
                    
                    // Imprime a tag <option>, adicionando 'selected' se for a categoria correta
                    echo "<option value='" . $categoria['id_categoria'] . "' " . $selected . ">"
                       . htmlspecialchars($categoria['nome_categoria'])
                       . "</option>";
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