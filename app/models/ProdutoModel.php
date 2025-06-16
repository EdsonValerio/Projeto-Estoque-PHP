<?php

function listarTodosProdutos($pdo)
{
    $sql = "
        SELECT 
            p.id_produto, 
            p.nome_produto, 
            p.quantidade_estoque, 
            p.preco_unidade, 
            c.nome_categoria
        FROM 
            produtos AS p
        JOIN 
            categorias AS c ON p.id_categoria = c.id_categoria
        ORDER BY 
            p.nome_produto ASC
    ";
    $stmt = $pdo->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function cadastrarProduto($pdo, $dadosProduto)
{
    $sql = "
        INSERT INTO produtos (nome_produto, quantidade_estoque, preco_unidade, id_categoria) 
        VALUES (?, ?, ?, ?)
    ";

    $precoFormatado = str_replace(',', '.', $dadosProduto['preco_unidade']);

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        $dadosProduto['nome_produto'],
        $dadosProduto['quantidade_estoque'],
        $precoFormatado,
        $dadosProduto['id_categoria']
    ]);
}

function buscarProdutoPorId($pdo, $id)
{
    $sql = "SELECT * FROM produtos WHERE id_produto = ?";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function atualizarProduto($pdo, $id, $dadosProduto)
{
    $sql = "
        UPDATE produtos SET 
            nome_produto = ?, 
            quantidade_estoque = ?, 
            preco_unidade = ?, 
            id_categoria = ? 
        WHERE 
            id_produto = ?
    ";

    $precoFormatado = str_replace(',', '.', $dadosProduto['preco_unidade']);

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $dadosProduto['nome_produto'],
        $dadosProduto['quantidade_estoque'],
        $precoFormatado,
        $dadosProduto['id_categoria'],
        $id
    ]);
}

function excluirProduto($pdo, $id)
{
    $sql = "DELETE FROM produtos WHERE id_produto = ?";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
}