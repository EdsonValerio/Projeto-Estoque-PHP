<?php

// Arquivo: app/controllers/CategoriaController.php

// Inclui o Model de Categoria
require_once BASE_PATH . '/app/models/CategoriaModel.php';

/**
 * Exibe a página de listagem de categorias.
 */
function listarCategorias($pdo)
{
    $listaDeCategorias = listarTodasCategorias($pdo);
    require_once VIEW_PATH . 'categorias/listar.php';
}

/**
 * Exibe o formulário para cadastrar uma nova categoria.
 */
function exibirFormularioCadastroCategoria($pdo)
{
    require_once VIEW_PATH . 'categorias/novo.php';
}

/**
 * Recebe os dados do formulário e salva a nova categoria.
 */
function salvarNovaCategoria($pdo)
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (!validarTokenCSRF($_POST['csrf_token'] ?? '')) {
            die('Falha na verificação de segurança (CSRF).');
        }

        $nomeCategoria = $_POST['nome_categoria'];
        cadastrarCategoria($pdo, $nomeCategoria);
        header('Location: ?page=categorias');
        exit;
    }
}

/**
 * Exibe o formulário para editar uma categoria existente.
 */
function exibirFormularioEdicaoCategoria($pdo)
{
    $id = $_GET['id'];
    $categoria = buscarCategoriaPorId($pdo, $id);
    require_once VIEW_PATH . 'categorias/editar.php';
}

/**
 * Recebe os dados do formulário de edição e atualiza a categoria.
 */
function atualizarCategoriaController($pdo)
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!validarTokenCSRF($_POST['csrf_token'] ?? '')) {
        die('Falha na verificação de segurança (CSRF).');
    }
    
        $id = $_POST['id_categoria'];
        $nomeCategoria = $_POST['nome_categoria'];
        atualizarCategoria($pdo, $id, $nomeCategoria);
        header('Location: ?page=categorias');
        exit;
    }
}

/**
 * Processa a requisição de exclusão de uma categoria.
 */
function excluirCategoriaController($pdo)
{
    $id = $_GET['id'];
    excluirCategoria($pdo, $id);
    header('Location: ?page=categorias');
    exit;
}