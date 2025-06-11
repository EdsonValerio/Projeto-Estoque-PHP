<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Listagem de Produtos</title>
    </head>
<body>
    <h1>Estoque de Produtos</h1>

    <a href="?page=produtos_novo">Adicionar Novo Produto</a>
    <hr>

    <table border="1" style="width:100%; border-collapse: collapse;">
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
            // Verifica se a lista de produtos não está vazia
            if (!empty($listaDeProdutos)) {
                // Itera sobre cada produto na lista
                foreach ($listaDeProdutos as $produto) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($produto['id_produto']) . "</td>";
                    echo "<td>" . htmlspecialchars($produto['nome_produto']) . "</td>";
                    echo "<td>" . htmlspecialchars($produto['quantidade_estoque']) . "</td>";
                    // Formata o preço para o padrão brasileiro (ex: 1.234,56)
                    echo "<td>" . number_format($produto['preco_unidade'], 2, ',', '.') . "</td>";
                    echo "<td>" . htmlspecialchars($produto['nome_categoria']) . "</td>";
                    // Links para as ações de Editar e Excluir
                    echo "<td>";
                    echo "<a href='?page=produtos_editar&id=" . $produto['id_produto'] . "'>Editar</a> | ";
                    echo "<a href='?page=produtos_excluir&id=" . $produto['id_produto'] . "' onclick=\"return confirm('Tem certeza que deseja excluir este produto?');\">Excluir</a>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                // Se a lista estiver vazia, exibe uma mensagem
                echo "<tr><td colspan='6'>Nenhum produto cadastrado.</td></tr>";
            }
            ?>
        </tbody>
    </table>
    <br>
    <a href="?page=dashboard">Voltar ao Painel</a>
</body>
</html>