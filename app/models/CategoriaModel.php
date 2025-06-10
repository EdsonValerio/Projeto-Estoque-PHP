<?php

// Arquivo: app/models/CategoriaModel.php

/**
 * Busca todas as categorias cadastradas no banco de dados.
 *
 * @param PDO $pdo A instância da conexão PDO.
 * @return array Um array com todas as categorias.
 */
function listarTodasCategorias($pdo)
{
    // Comando SQL para selecionar todas as categorias, ordenadas por nome.
    $sql = "SELECT id_categoria, nome_categoria FROM categorias ORDER BY nome_categoria ASC";

    // Prepara e executa a consulta
    $stmt = $pdo->query($sql);

    // Retorna todos os resultados
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Futuramente, outras funções de CRUD de categoria virão aqui.