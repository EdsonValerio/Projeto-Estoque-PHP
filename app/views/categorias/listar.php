<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Gerenciar Categorias</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h1>Gerenciar Categorias de Produtos</h1>

        <a href="?page=categorias_novo" class="btn">Adicionar Nova Categoria</a>
        <br><br>

        <table>
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
        <a href="?page=dashboard" class="btn">Voltar ao Painel</a>
    </div>
</body>
</html>