<?php

function listarTodasCategorias($pdo)
{
    $sql = "SELECT id_categoria, nome_categoria FROM categorias ORDER BY nome_categoria ASC";

    $stmt = $pdo->query($sql);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function cadastrarCategoria($pdo, $nomeCategoria)
{
    $sql = "INSERT INTO categorias (nome_categoria) VALUES (?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nomeCategoria]);
}

function buscarCategoriaPorId($pdo, $id)
{
    $sql = "SELECT * FROM categorias WHERE id_categoria = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function atualizarCategoria($pdo, $id, $nomeCategoria)
{
    $sql = "UPDATE categorias SET nome_categoria = ? WHERE id_categoria = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nomeCategoria, $id]);
}

function excluirCategoria($pdo, $id)
{
    $sql = "DELETE FROM categorias WHERE id_categoria = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
}