<?php

// Arquivo: app/controllers/ProdutoController.php

// Inclui o Model de Produto, pois este controller sempre vai precisar dele.
require_once BASE_PATH . '/app/models/ProdutoModel.php';

/**
 * Exibe a página de listagem de produtos.
 */
function listarProdutos($pdo)
{
    $listaDeProdutos = listarTodosProdutos($pdo);
    require_once VIEW_PATH . 'produtos/listar.php';
}

/**
 * Exibe o formulário para cadastrar um novo produto.
 */
function exibirFormularioCadastro($pdo)
{
    require_once BASE_PATH . '/app/models/CategoriaModel.php';
    $categorias = listarTodasCategorias($pdo);
    require_once VIEW_PATH . 'produtos/novo.php';
}

/**
 * Recebe os dados do formulário e salva o novo produto no banco.
 */
// Dentro de app/controllers/ProdutoController.php
function salvarNovoProduto($pdo)
{
    // Verifica se a requisição foi feita via POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Valida o token CSRF
        if (!validarTokenCSRF($_POST['csrf_token'] ?? '')) {
            die('Falha na verificação de segurança (CSRF).');
        }

        // Pega os dados do formulário (lógica existente)
        $dadosProduto = [
            'nome_produto' => $_POST['nome_produto'],
            'quantidade_estoque' => $_POST['quantidade_estoque'],
            'preco_unidade' => $_POST['preco_unidade'],
            'id_categoria' => $_POST['id_categoria']
        ];

        cadastrarProduto($pdo, $dadosProduto);
        header('Location: ?page=produtos');
        exit;
    }
}

/**
 * Exibe o formulário para editar um produto existente.
 */
function exibirFormularioEdicao($pdo)
{
    // 1. Pega o ID do produto da URL (?page=produtos_editar&id=X)
    $id = $_GET['id'];

    // 2. Busca os dados do produto específico no banco
    $produto = buscarProdutoPorId($pdo, $id);

    // 3. Busca TODAS as categorias para popular o menu de seleção
    require_once BASE_PATH . '/app/models/CategoriaModel.php';
    $categorias = listarTodasCategorias($pdo);
    
    // 4. Carrega a view do formulário de edição, passando os dados do produto e das categorias
    require_once VIEW_PATH . 'produtos/editar.php';
}

/**
 * Recebe os dados do formulário de edição e atualiza o produto no banco.
 */
function atualizarProdutos($pdo)
{
    // Verifica se a requisição foi feita via POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (!validarTokenCSRF($_POST['csrf_token'] ?? '')) {
            die('Falha na verificação de segurança (CSRF).');
    }
        // Pega os dados do formulário, incluindo o ID do produto
        $id = $_POST['id_produto'];
        $dadosProduto = [
            'nome_produto' => $_POST['nome_produto'],
            'quantidade_estoque' => $_POST['quantidade_estoque'],
            'preco_unidade' => $_POST['preco_unidade'],
            'id_categoria' => $_POST['id_categoria']
        ];

        // Chama a função do model para atualizar o produto
        atualizarProduto($pdo, $id, $dadosProduto);

        // Redireciona o usuário para a lista de produtos após atualizar
        header('Location: ?page=produtos');
        exit;
    }
}

/**
 * Processa a requisição de exclusão de um produto.
 */
function excluirProdutoController($pdo)
{
    // Pega o ID do produto da URL
    $id = $_GET['id'];

    // Chama a função do model para excluir o produto
    excluirProduto($pdo, $id);

    // Redireciona de volta para a lista de produtos
    header('Location: ?page=produtos');
    exit;
}