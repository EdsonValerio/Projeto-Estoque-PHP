<?php

require_once BASE_PATH . '/app/models/UsuarioModel.php';

function processarRegistroPublico($pdo)
{
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header('Location: ?page=register');
        exit;
    }

    if (!validarTokenCSRF($_POST['csrf_token'] ?? '')) {
        die('Falha na verificação de segurança (CSRF).');
    }

    $nome_completo = trim($_POST['nome_completo']);
    $login = trim($_POST['login']);
    $senha = $_POST['senha'];
    $cpf = trim($_POST['cpf'] ?? '');
    $data_nascimento = trim($_POST['data_nascimento'] ?? '');

    if (empty($nome_completo) || empty($login) || empty($senha) || empty($cpf) || empty($data_nascimento)) {
        header('Location: ?page=register&error=empty');
        exit;
    }

    $usuarioExistente = buscarUsuarioPorLogin($pdo, $login);
    if ($usuarioExistente) {
        header('Location: ?page=register&error=login_exists');
        exit;
    }

    $dadosUsuario = [
        'nome_completo' => $nome_completo,
        'login' => $login,
        'senha' => $senha,
        'nivel_acesso' => 1,
        'cpf' => $cpf,
        'data_nascimento' => $data_nascimento
    ];

    cadastrarUsuario($pdo, $dadosUsuario);

    header('Location: ?page=login&success=register');
    exit;
}

function handleLogin($pdo)
{
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header('Location: ?page=login');
        exit;
    }

    $login = trim($_POST['login']);
    $senha = trim($_POST['senha']);

    if (empty($login) || empty($senha)) {
        header('Location: ?page=login&error=empty');
        exit;
    }

    try {
        $sql = "SELECT id_usuario, login, senha_hash, nivel_acesso FROM usuarios WHERE login = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$login]);

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($senha, $user['senha_hash'])) {
            $_SESSION['user_id'] = $user['id_usuario'];
            $_SESSION['user_login'] = $user['login'];
            $_SESSION['user_level'] = $user['nivel_acesso'];

            setcookie('bem_vindo', 'true', 0, '/');

            header('Location: ?page=dashboard');
            exit;
        } else {
            header('Location: ?page=login&error=invalid');
            exit;
        }
    } catch (PDOException $e) {
        header('Location: ?page=login&error=db');
        exit;
    }
}

function listarUsuarios($pdo)
{
    $listaDeUsuarios = listarTodosUsuarios($pdo);
    require_once VIEW_PATH . 'usuarios/listar.php';
}

function exibirFormularioCadastroUsuario($pdo)
{
    $niveisAcesso = [
        1 => 'Funcionário',
        2 => 'Dono',
        3 => 'Admin'
    ];
    require_once VIEW_PATH . 'usuarios/novo.php';
}

function salvarNovoUsuario($pdo)
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (!validarTokenCSRF($_POST['csrf_token'] ?? '')) {
            die('Falha na verificação de segurança (CSRF).');
        }
        $dadosUsuario = [
            'nome_completo' => trim($_POST['nome_completo']),
            'login' => trim($_POST['login']),
            'senha' => $_POST['senha'],
            'nivel_acesso' => (int)$_POST['nivel_acesso'],
            'cpf' => trim($_POST['cpf'] ?? ''),
            'data_nascimento' => trim($_POST['data_nascimento'] ?? '')
        ];

        if (empty($dadosUsuario['nome_completo']) || empty($dadosUsuario['login']) || empty($dadosUsuario['senha']) || empty($dadosUsuario['nivel_acesso']) || empty($dadosUsuario['cpf']) || empty($dadosUsuario['data_nascimento'])) {
            header('Location: ?page=usuarios_novo&error=empty_fields');
            exit;
        }

        cadastrarUsuario($pdo, $dadosUsuario);
        header('Location: ?page=usuarios');
        exit;
    }
}

function exibirFormularioEdicaoUsuario($pdo)
{
    $id = $_GET['id'];
    $usuario = buscarUsuarioPorId($pdo, $id);

    $niveisAcesso = [
        1 => 'Funcionário',
        2 => 'Dono',
        3 => 'Admin'
    ];

    if (!$usuario) {
        header('Location: ?page=usuarios&error=not_found');
        exit;
    }
    require_once VIEW_PATH . 'usuarios/editar.php';
}

function atualizarUsuarioController($pdo)
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (!validarTokenCSRF($_POST['csrf_token'] ?? '')) {
            die('Falha na verificação de segurança (CSRF).');
        }
        $id = $_POST['id_usuario'];
        $dadosParaAtualizar = [
            'nome_completo' => trim($_POST['nome_completo']),
            'login' => trim($_POST['login']),
            'nivel_acesso' => (int)$_POST['nivel_acesso'],
            'cpf' => trim($_POST['cpf'] ?? ''),
            'data_nascimento' => trim($_POST['data_nascimento'] ?? '')
        ];

        if (!empty($_POST['senha'])) {
            $dadosParaAtualizar['senha'] = $_POST['senha'];
        }

        atualizarUsuario($pdo, $id, $dadosParaAtualizar);
        header('Location: ?page=usuarios');
        exit;
    }
}

function excluirUsuarioController($pdo)
{
    $id = $_GET['id'];
    if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $id) {
        header('Location: ?page=usuarios&error=self_delete');
        exit;
    }

    excluirUsuario($pdo, $id);
    header('Location: ?page=usuarios');
    exit;
}

function exibirFormularioRecuperarSenha()
{
    require_once VIEW_PATH . 'login/recuperar_senha.php';
}

function handleRedefinirSenha($pdo)
{
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header('Location: ?page=recuperar_senha');
        exit;
    }

    if (!validarTokenCSRF($_POST['csrf_token'] ?? '')) {
        die('Falha na verificação de segurança (CSRF).');
    }

    $cpf = trim($_POST['cpf']);
    $dataNascimento = trim($_POST['data_nascimento']);
    $novaSenha = $_POST['nova_senha'];
    $confirmaSenha = $_POST['confirma_senha'];

    if (empty($cpf) || empty($dataNascimento) || empty($novaSenha) || empty($confirmaSenha)) {
        header('Location: ?page=recuperar_senha&error=empty');
        exit;
    }

    if ($novaSenha !== $confirmaSenha) {
        header('Location: ?page=recuperar_senha&error=mismatch');
        exit;
    }

    try {
        $usuario = buscarUsuarioPorCpfDataNascimento($pdo, $cpf, $dataNascimento);

        if (!$usuario) {
            header('Location: ?page=recuperar_senha&error=user_not_found');
            exit;
        }

        $sucesso = redefinirSenhaUsuario($pdo, $usuario['id_usuario'], $novaSenha);

        if ($sucesso) {
            header('Location: ?page=login&status=success');
            exit;
        } else {
            header('Location: ?page=recuperar_senha&error=reset_failed');
            exit;
        }

    } catch (PDOException $e) {
        error_log("Erro ao redefinir senha: " . $e->getMessage());
        header('Location: ?page=recuperar_senha&error=db_error');
        exit;
    }
}