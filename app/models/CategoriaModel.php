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

/**
 * Cadastra uma nova categoria no banco de dados.
 *
 * @param PDO $pdo A instância da conexão PDO.
 * @param string $nomeCategoria O nome da categoria a ser cadastrada.
 */
function cadastrarCategoria($pdo, $nomeCategoria)
{
    $sql = "INSERT INTO categorias (nome_categoria) VALUES (?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nomeCategoria]);
}

/**
 * Busca uma única categoria pelo seu ID.
 *
 * @param PDO $pdo A instância da conexão PDO.
 * @param int $id O ID da categoria a ser buscada.
 * @return array|false Retorna um array com os dados da categoria ou false se não encontrar.
 */
function buscarCategoriaPorId($pdo, $id)
{
    $sql = "SELECT * FROM categorias WHERE id_categoria = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

/**
 * Atualiza uma categoria existente no banco de dados.
 *
 * @param PDO $pdo A instância da conexão PDO.
 * @param int $id O ID da categoria a ser atualizada.
 * @param string $nomeCategoria O novo nome da categoria.
 */
function atualizarCategoria($pdo, $id, $nomeCategoria)
{
    $sql = "UPDATE categorias SET nome_categoria = ? WHERE id_categoria = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nomeCategoria, $id]);
}

/**
 * Exclui uma categoria do banco de dados pelo seu ID.
 *
 * @param PDO $pdo A instância da conexão PDO.
 * @param int $id O ID da categoria a ser excluída.
 */
function excluirCategoria($pdo, $id)
{
    $sql = "DELETE FROM categorias WHERE id_categoria = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
}