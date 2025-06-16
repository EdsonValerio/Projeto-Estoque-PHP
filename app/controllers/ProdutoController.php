<?php

require_once BASE_PATH . '/app/models/ProdutoModel.php';

function listarProdutos($pdo)
{
    $listaDeProdutos = listarTodosProdutos($pdo);
    require_once VIEW_PATH . 'produtos/listar.php';
}

function exibirFormularioCadastro($pdo)
{
    require_once BASE_PATH . '/app/models/CategoriaModel.php';
    $categorias = listarTodasCategorias($pdo);
    require_once VIEW_PATH . 'produtos/novo.php';
}

function salvarNovoProduto($pdo)
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (!validarTokenCSRF($_POST['csrf_token'] ?? '')) {
            die('Falha na verificação de segurança (CSRF).');
        }

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

function exibirFormularioEdicao($pdo)
{
    $id = $_GET['id'];

    $produto = buscarProdutoPorId($pdo, $id);

    require_once BASE_PATH . '/app/models/CategoriaModel.php';
    $categorias = listarTodasCategorias($pdo);

    require_once VIEW_PATH . 'produtos/editar.php';
}

function atualizarProdutos($pdo)
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (!validarTokenCSRF($_POST['csrf_token'] ?? '')) {
            die('Falha na verificação de segurança (CSRF).');
    }
        $id = $_POST['id_produto'];
        $dadosProduto = [
            'nome_produto' => $_POST['nome_produto'],
            'quantidade_estoque' => $_POST['quantidade_estoque'],
            'preco_unidade' => $_POST['preco_unidade'],
            'id_categoria' => $_POST['id_categoria']
        ];

        atualizarProduto($pdo, $id, $dadosProduto);

        header('Location: ?page=produtos');
        exit;
    }
}

function excluirProdutoController($pdo)
{
    $id = $_GET['id'];

    excluirProduto($pdo, $id);

    header('Location: ?page=produtos');
    exit;
}