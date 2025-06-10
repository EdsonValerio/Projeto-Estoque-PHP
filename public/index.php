<?php

// Arquivo: public/index.php

// Inicia a sessão. Essencial para o sistema de login.
session_start();

// Inclui o arquivo de conexão com o banco de dados.
require_once '../config/database.php';

// --- Roteamento Simples ---
define('BASE_PATH', dirname(__DIR__));
define('CONTROLLER_PATH', BASE_PATH . '/app/controllers/');
define('VIEW_PATH', BASE_PATH . '/app/views/');

$page = $_GET['page'] ?? 'login';

// Estrutura de controle para carregar a página correta.
// ... (dentro de public/index.php)

switch ($page) {

    case 'login':
        include VIEW_PATH . 'login/form.php';
        break;

    case 'login_action':
        require_once CONTROLLER_PATH . 'UsuarioController.php';
        handleLogin($pdo);
        break;

    case 'dashboard':
        if (!isset($_SESSION['user_id'])) {
            header('Location: ?page=login&error=auth');
            exit;
        }
        include VIEW_PATH . 'dashboard/index.php';
        break;
        
    case 'logout':
        $_SESSION = [];
        session_destroy();
        header('Location: ?page=login');
        exit;
        break;

    case 'produtos':
        if (!isset($_SESSION['user_id'])) {
            header('Location: ?page=login&error=auth');
            exit;
        }
        require_once CONTROLLER_PATH . 'ProdutoController.php';
        listarProdutos($pdo);
        break;

    case 'produtos_novo':
        if (!isset($_SESSION['user_id'])) {
            header('Location: ?page=login&error=auth');
            exit;
        }
        require_once CONTROLLER_PATH . 'ProdutoController.php';
        exibirFormularioCadastro($pdo);
        break;

    case 'produtos_salvar':
        if (!isset($_SESSION['user_id'])) {
            header('Location: ?page=login&error=auth');
            exit;
        }
        require_once CONTROLLER_PATH . 'ProdutoController.php';
        salvarNovoProduto($pdo);
        break;

    case 'produtos_editar':
        if (!isset($_SESSION['user_id'])) { header('Location: ?page=login&error=auth'); exit; }
        require_once CONTROLLER_PATH . 'ProdutoController.php';
        exibirFormularioEdicao($pdo);
        break;

    case 'produtos_atualizar':
        if (!isset($_SESSION['user_id'])) { header('Location: ?page=login&error=auth'); exit; }
        require_once CONTROLLER_PATH . 'ProdutoController.php';
        atualizarProdutos($pdo);
        break;

    case 'produtos_excluir':
        if (!isset($_SESSION['user_id'])) { header('Location: ?page=login&error=auth'); exit; }
        require_once CONTROLLER_PATH . 'ProdutoController.php';
        excluirProdutoController($pdo);
        break;

    default:
        include VIEW_PATH . '404.php';
        break;
}