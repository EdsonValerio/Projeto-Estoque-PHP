<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Gerenciar Categorias</title>
</head>
<body>
    <h1>Gerenciar Categorias de Produtos</h1>

    <a href="?page=categorias_novo">Adicionar Nova Categoria</a>
    <hr>

    <table border="1" style="width:100%; border-collapse: collapse;">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome da Categoria</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (!empty($listaDeCategorias)) {
                foreach ($listaDeCategorias as $categoria) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($categoria['id_categoria']) . "</td>";
                    echo "<td>" . htmlspecialchars($categoria['nome_categoria']) . "</td>";
                    echo "<td>";
                    echo "<a href='?page=categorias_editar&id=" . $categoria['id_categoria'] . "'>Editar</a> | ";
                    echo "<a href='?page=categorias_excluir&id=" . $categoria['id_categoria'] . "' onclick=\"return confirm('Atenção! Excluir uma categoria também removerá todos os produtos associados a ela. Deseja continuar?');\">Excluir</a>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3'>Nenhuma categoria cadastrada.</td></tr>";
            }
            ?>
        </tbody>
    </table>
    <br>
    <a href="?page=dashboard">Voltar ao Painel</a>
</body>
</html>