<?php

// Arquivo: app/models/ProdutoModel.php

/**
 * Busca todos os produtos cadastrados no banco de dados.
 */
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

/**
 * Cadastra um novo produto no banco de dados.
 *
 * @param PDO $pdo A instância da conexão PDO.
 * @param array $dadosProduto Um array associativo com os dados do produto.
 * Ex: ['nome_produto' => '...', 'quantidade_estoque' => ..., ...]
 */
function cadastrarProduto($pdo, $dadosProduto)
{
    // O comando SQL INSERT com placeholders (?) para segurança.
    $sql = "
        INSERT INTO produtos (nome_produto, quantidade_estoque, preco_unidade, id_categoria) 
        VALUES (?, ?, ?, ?)
    ";

    // O banco de dados DECIMAL espera um ponto como separador decimal,
    // mas o usuário pode digitar uma vírgula. Vamos converter.
    $precoFormatado = str_replace(',', '.', $dadosProduto['preco_unidade']);

    // Prepara o comando
    $stmt = $pdo->prepare($sql);

    // Executa o comando, passando os valores para os placeholders
    $stmt->execute([
        $dadosProduto['nome_produto'],
        $dadosProduto['quantidade_estoque'],
        $precoFormatado,
        $dadosProduto['id_categoria']
    ]);
}

/**
 * Busca um único produto pelo seu ID.
 *
 * @param PDO $pdo A instância da conexão PDO.
 * @param int $id O ID do produto a ser buscado.
 * @return array|false Retorna um array com os dados do produto ou false se não encontrar.
 */
function buscarProdutoPorId($pdo, $id)
{
    // Comando SQL para selecionar um produto específico pelo seu ID.
    $sql = "SELECT * FROM produtos WHERE id_produto = ?";
    
    // Prepara e executa a consulta de forma segura
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    
    // Retorna apenas um resultado, pois o ID é único.
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

/**
 * Atualiza um produto existente no banco de dados.
 *
 * @param PDO $pdo A instância da conexão PDO.
 * @param int $id O ID do produto a ser atualizado.
 * @param array $dadosProduto Um array com os novos dados do produto.
 */
function atualizarProduto($pdo, $id, $dadosProduto)
{
    // Comando SQL UPDATE com placeholders para segurança
    $sql = "
        UPDATE produtos SET 
            nome_produto = ?, 
            quantidade_estoque = ?, 
            preco_unidade = ?, 
            id_categoria = ? 
        WHERE 
            id_produto = ?
    ";

    // Converte a vírgula do preço para ponto
    $precoFormatado = str_replace(',', '.', $dadosProduto['preco_unidade']);

    // Prepara e executa o comando, passando os novos dados e o ID para o WHERE
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $dadosProduto['nome_produto'],
        $dadosProduto['quantidade_estoque'],
        $precoFormatado,
        $dadosProduto['id_categoria'],
        $id // Este é o último '?' na query, o da cláusula WHERE
    ]);
}

/**
 * Exclui um produto do banco de dados pelo seu ID.
 *
 * @param PDO $pdo A instância da conexão PDO.
 * @param int $id O ID do produto a ser excluído.
 */
function excluirProduto($pdo, $id)
{
    // Comando SQL DELETE para remover uma linha específica
    $sql = "DELETE FROM produtos WHERE id_produto = ?";
    
    // Prepara e executa a consulta de forma segura
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
}