<?php

// Arquivo: app/controllers/UsuarioController.php

/**
 * Função para lidar com a submissão do formulário de login.
 */
function handleLogin($pdo)
{
    // 1. Verificar se o método de requisição é POST
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        // Se não for POST, redireciona para a página de login
        header('Location: ?page=login');
        exit;
    }

    // 2. Obter os dados do formulário
    $login = trim($_POST['login']);
    $senha = trim($_POST['senha']);

    // Validação básica
    if (empty($login) || empty($senha)) {
        // Redireciona de volta com erro se campos estiverem vazios
        header('Location: ?page=login&error=empty');
        exit;
    }

    try {
        // 3. Buscar o usuário no banco de dados pelo login
        $sql = "SELECT id_usuario, login, senha_hash, nivel_acesso FROM usuarios WHERE login = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$login]);

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // 4. Verificar se o usuário existe e se a senha está correta
        if ($user && password_verify($senha, $user['senha_hash'])) {
            // Senha correta! Iniciar a sessão.
            $_SESSION['user_id'] = $user['id_usuario'];
            $_SESSION['user_login'] = $user['login'];
            $_SESSION['user_level'] = $user['nivel_acesso'];

            // 5. Redirecionar para o painel (dashboard)
            header('Location: ?page=dashboard');
            exit;
        } else {
            // Usuário não encontrado ou senha incorreta
            header('Location: ?page=login&error=invalid');
            exit;
        }
    } catch (PDOException $e) {
        // Em caso de erro no banco, redireciona com um erro genérico
        // Idealmente, registrar o erro em um log.
        header('Location: ?page=login&error=db');
        exit;
    }
}