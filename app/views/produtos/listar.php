<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Listagem de Produtos</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h1>Estoque de Produtos</h1>

        <a href="?page=produtos_novo" class="btn">Adicionar Novo Produto</a>
        <br><br>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome do Produto</th>
                    <th>Estoque</th>
                    <th>Preço (R$)</th>
                    <th>Categoria</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($listaDeProdutos)) {
                    foreach ($listaDeProdutos as $produto) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($produto['id_produto']) . "</td>";
                        echo "<td>" . htmlspecialchars($produto['nome_produto']) . "</td>";
                        echo "<td>" . htmlspecialchars($produto['quantidade_estoque']) . "</td>";
                        echo "<td>" . number_format($produto['preco_unidade'], 2, ',', '.') . "</td>";
                        echo "<td>" . htmlspecialchars($produto['nome_categoria']) . "</td>";
                        echo "<td>";
                        echo "<a href='?page=produtos_editar&id=" . $produto['id_produto'] . "'>Editar</a> | ";
                        echo "<a href='?page=produtos_excluir&id=" . $produto['id_produto'] . "' onclick=\"return confirm('Tem certeza que deseja excluir este produto?');\">Excluir</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>Nenhum produto cadastrado.</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <br>
        <a href="?page=dashboard" class="btn">Voltar ao Painel</a>
    </div>
</body>
</html>