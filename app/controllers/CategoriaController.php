<?php

require_once BASE_PATH . '/app/models/CategoriaModel.php';

function listarCategorias($pdo)
{
    $listaDeCategorias = listarTodasCategorias($pdo);
    require_once VIEW_PATH . 'categorias/listar.php';
}

function exibirFormularioCadastroCategoria($pdo)
{
    require_once VIEW_PATH . 'categorias/novo.php';
}

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

function exibirFormularioEdicaoCategoria($pdo)
{
    $id = $_GET['id'];
    $categoria = buscarCategoriaPorId($pdo, $id);
    require_once VIEW_PATH . 'categorias/editar.php';
}

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

function excluirCategoriaController($pdo)
{
    $id = $_GET['id'];
    excluirCategoria($pdo, $id);
    header('Location: ?page=categorias');
    exit;
}