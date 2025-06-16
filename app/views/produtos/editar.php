<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Produto</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h1>Editar Produto</h1>

        <form action="?page=produtos_atualizar" method="POST">
            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token'] ?? '') ?>">
            <input type="hidden" name="id_produto" value="<?= $produto['id_produto'] ?>">

            <div>
                <label for="nome">Nome do Produto:</label>
                <input type="text" id="nome" name="nome_produto" required value="<?= htmlspecialchars($produto['nome_produto']) ?>">
            </div>
            <br>
            <div>
                <label for="qtd">Quantidade em Estoque:</label>
                <input type="number" id="qtd" name="quantidade_estoque" required min="0" value="<?= $produto['quantidade_estoque'] ?>">
            </div>
            <br>
            <div>
                <label for="preco">Preço (R$):</label>
                <input type="text" id="preco" name="preco_unidade" required placeholder="Ex: 123,45" value="<?= number_format($produto['preco_unidade'], 2, ',', '.') ?>">
            </div>
            <br>
            <div>
                <label for="categoria">Categoria:</label>
                <select id="categoria" name="id_categoria" required>
                    <option value="">Selecione uma categoria</option>
                    <?php
                    foreach ($categorias as $categoria) {
                        $selected = ($categoria['id_categoria'] == $produto['id_categoria']) ? 'selected' : '';
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
                <a href="?page=produtos" class="btn" style="background: linear-gradient(to bottom, #ccc, #999);">Voltar para a Lista</a>
            </div>
        </form>
    </div>
</body>
</html>