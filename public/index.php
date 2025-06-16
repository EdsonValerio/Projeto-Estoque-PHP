<?php

session_start();

require_once '../config/database.php';

define('BASE_PATH', dirname(__DIR__));
define('CONTROLLER_PATH', BASE_PATH . '/app/controllers/');
define('VIEW_PATH', BASE_PATH . '/app/views/');

require_once CONTROLLER_PATH . 'Crsf.php';

$page = $_GET['page'] ?? 'home';

switch ($page) {

    case 'home':
        include VIEW_PATH . 'public/home.php';
        break;

    case 'sobre':
        include VIEW_PATH . 'public/sobre.php';
        break;

    case 'contato':
        include VIEW_PATH . 'public/contato.php';
        break;

    case 'login':
        gerarTokenCSRF();
        include VIEW_PATH . 'login/form.php';
        break;

    case 'login_action':
        require_once CONTROLLER_PATH . 'UsuarioController.php';
        handleLogin($pdo);
        break;

    case 'logout':
        $_SESSION = [];
        session_destroy();
        header('Location: ?page=home');
        exit;

    case 'dashboard':
        if (!isset($_SESSION['user_id'])) {
            header('Location: ?page=login&error=auth');
            exit;
        }
        include VIEW_PATH . 'dashboard/index.php';
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
        gerarTokenCSRF();
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
        gerarTokenCSRF();
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

    case 'categorias':
        if (!isset($_SESSION['user_id'])) { header('Location: ?page=login&error=auth'); exit; }
        require_once CONTROLLER_PATH . 'CategoriaController.php';
        listarCategorias($pdo);
        break;
    
    case 'categorias_novo':
        if (!isset($_SESSION['user_id'])) { header('Location: ?page=login&error=auth'); exit; }
        gerarTokenCSRF();
        require_once CONTROLLER_PATH . 'CategoriaController.php';
        exibirFormularioCadastroCategoria($pdo);
        break;
    
    case 'categorias_salvar':
        if (!isset($_SESSION['user_id'])) { header('Location: ?page=login&error=auth'); exit; }
        require_once CONTROLLER_PATH . 'CategoriaController.php';
        salvarNovaCategoria($pdo);
        break;
    
    case 'categorias_editar':
        if (!isset($_SESSION['user_id'])) { header('Location: ?page=login&error=auth'); exit; }
        gerarTokenCSRF();
        require_once CONTROLLER_PATH . 'CategoriaController.php';
        exibirFormularioEdicaoCategoria($pdo);
        break;
        
    case 'categorias_atualizar':
        if (!isset($_SESSION['user_id'])) { header('Location: ?page=login&error=auth'); exit; }
        require_once CONTROLLER_PATH . 'CategoriaController.php';
        atualizarCategoriaController($pdo);
        break;

    case 'categorias_excluir':
        if (!isset($_SESSION['user_id'])) { header('Location: ?page=login&error=auth'); exit; }
        require_once CONTROLLER_PATH . 'CategoriaController.php';
        excluirCategoriaController($pdo);
        break;

    case 'usuarios':
        if (!isset($_SESSION['user_id'])) { header('Location: ?page=login&error=auth'); exit; }
        
        if ($_SESSION['user_level'] != 3) {
            header('Location: ?page=dashboard&error=permission');
            exit;
        }

        require_once CONTROLLER_PATH . 'UsuarioController.php';
        listarUsuarios($pdo);
        break;

    case 'usuarios_novo':
        if (!isset($_SESSION['user_id'])) { header('Location: ?page=login&error=auth'); exit; }

        if ($_SESSION['user_level'] != 3) {
            header('Location: ?page=dashboard&error=permission');
            exit;
        }
        gerarTokenCSRF();
        require_once CONTROLLER_PATH . 'UsuarioController.php';
        exibirFormularioCadastroUsuario($pdo);
        break;

    case 'usuarios_salvar':
        if (!isset($_SESSION['user_id'])) { header('Location: ?page=login&error=auth'); exit; }

        if ($_SESSION['user_level'] != 3) {
            header('Location: ?page=dashboard&error=permission');
            exit;
        }

        require_once CONTROLLER_PATH . 'UsuarioController.php';
        salvarNovoUsuario($pdo);
        break;

    case 'usuarios_editar':
        if (!isset($_SESSION['user_id'])) { header('Location: ?page=login&error=auth'); exit; }
    
        if ($_SESSION['user_level'] != 3) {
            header('Location: ?page=dashboard&error=permission');
            exit;
        }
        gerarTokenCSRF();
        require_once CONTROLLER_PATH . 'UsuarioController.php';
        exibirFormularioEdicaoUsuario($pdo);
        break;

    case 'usuarios_atualizar':
        if (!isset($_SESSION['user_id'])) { header('Location: ?page=login&error=auth'); exit; }

        if ($_SESSION['user_level'] != 3) {
            header('Location: ?page=dashboard&error=permission');
            exit;
        }

        require_once CONTROLLER_PATH . 'UsuarioController.php';
        atualizarUsuarioController($pdo);
        break;

    case 'usuarios_excluir':
        if (!isset($_SESSION['user_id'])) { header('Location: ?page=login&error=auth'); exit; }

        if ($_SESSION['user_level'] != 3) {
            header('Location: ?page=dashboard&error=permission');
            exit;
        }

        require_once CONTROLLER_PATH . 'UsuarioController.php';
        excluirUsuarioController($pdo);
        break;
    
    case 'register':
        gerarTokenCSRF();
        require_once CONTROLLER_PATH . 'UsuarioController.php';
        include VIEW_PATH . 'register/form.php';
        break;

    case 'register_action':
        require_once CONTROLLER_PATH . 'UsuarioController.php';
        processarRegistroPublico($pdo);
        break;

    case 'recuperar_senha':
        require_once CONTROLLER_PATH . 'UsuarioController.php';
        exibirFormularioRecuperarSenha();
        break;

    case 'recuperar_senha_action':
        require_once CONTROLLER_PATH . 'UsuarioController.php';
        handleRedefinirSenha($pdo);
        break;

    default:
        include VIEW_PATH . '404.php';
        break;
}

