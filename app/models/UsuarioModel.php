<?php

function listarTodosUsuarios($pdo)
{
    $sql = "SELECT id_usuario, nome_completo, login, nivel_acesso, cpf, data_nascimento FROM usuarios ORDER BY nome_completo ASC";
    $stmt = $pdo->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function cadastrarUsuario($pdo, $dadosUsuario)
{
    $sql = "INSERT INTO usuarios (nome_completo, login, senha_hash, nivel_acesso, cpf, data_nascimento) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);

    $senhaHash = password_hash($dadosUsuario['senha'], PASSWORD_DEFAULT);

    $stmt->execute([
        $dadosUsuario['nome_completo'],
        $dadosUsuario['login'],
        $senhaHash,
        $dadosUsuario['nivel_acesso'],
        $dadosUsuario['cpf'],
        $dadosUsuario['data_nascimento']
    ]);
}

function buscarUsuarioPorId($pdo, $id)
{
    $sql = "SELECT id_usuario, nome_completo, login, nivel_acesso, cpf, data_nascimento FROM usuarios WHERE id_usuario = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function atualizarUsuario($pdo, $id, $dadosUsuario)
{
    $setParts = [];
    $params = [];

    if (isset($dadosUsuario['nome_completo'])) {
        $setParts[] = "nome_completo = ?";
        $params[] = $dadosUsuario['nome_completo'];
    }
    if (isset($dadosUsuario['login'])) {
        $setParts[] = "login = ?";
        $params[] = $dadosUsuario['login'];
    }
    if (isset($dadosUsuario['nivel_acesso'])) {
        $setParts[] = "nivel_acesso = ?";
        $params[] = $dadosUsuario['nivel_acesso'];
    }
    if (isset($dadosUsuario['cpf']) && !empty($dadosUsuario['cpf'])) {
        $setParts[] = "cpf = ?";
        $params[] = $dadosUsuario['cpf'];
    }
    if (isset($dadosUsuario['data_nascimento']) && !empty($dadosUsuario['data_nascimento'])) {
        $setParts[] = "data_nascimento = ?";
        $params[] = $dadosUsuario['data_nascimento'];
    }
    if (isset($dadosUsuario['senha']) && !empty($dadosUsuario['senha'])) {
        $setParts[] = "senha_hash = ?";
        $params[] = password_hash($dadosUsuario['senha'], PASSWORD_DEFAULT);
    }

    $sql = "UPDATE usuarios SET " . implode(', ', $setParts) . " WHERE id_usuario = ?";
    $params[] = $id;

    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
}

function excluirUsuario($pdo, $id)
{
    $sql = "DELETE FROM usuarios WHERE id_usuario = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
}

// --- NOVA FUNÇÃO ADICIONADA AO FINAL DO ARQUIVO ---

/**
 * Busca um único usuário pelo seu nome de login.
 *
 * @param PDO $pdo A instância da conexão PDO.
 * @param string $login O login do usuário a ser buscado.
 * @return array|false Retorna um array com os dados do usuário ou false se não encontrar.
 */
function buscarUsuarioPorLogin($pdo, $login)
{
    $sql = "SELECT id_usuario, login, nome_completo, nivel_acesso, cpf, data_nascimento FROM usuarios WHERE login = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$login]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// --- NOVAS FUNÇÕES PARA RECUPERAÇÃO DE SENHA ---

/**
 * Busca um usuário pelo CPF e Data de Nascimento.
 *
 * @param PDO $pdo A instância da conexão PDO.
 * @param string $cpf O CPF do usuário.
 * @param string $dataNascimento A data de nascimento do usuário no formato 'YYYY-MM-DD'.
 * @return array|false Retorna um array com os dados do usuário (excluindo senha_hash) ou false se não encontrar.
 */
function buscarUsuarioPorCpfDataNascimento($pdo, $cpf, $dataNascimento)
{
    $sql = "SELECT id_usuario, login, nome_completo FROM usuarios WHERE cpf = ? AND data_nascimento = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$cpf, $dataNascimento]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

/**
 * Atualiza a senha de um usuário específico pelo ID.
 *
 * @param PDO $pdo A instância da conexão PDO.
 * @param int $idUsuario O ID do usuário cuja senha será atualizada.
 * @param string $novaSenha A nova senha em texto puro (será hashed dentro da função).
 * @return bool Retorna true em caso de sucesso, false caso contrário.
 */
function redefinirSenhaUsuario($pdo, $idUsuario, $novaSenha)
{
    $senhaHash = password_hash($novaSenha, PASSWORD_DEFAULT);
    $sql = "UPDATE usuarios SET senha_hash = ? WHERE id_usuario = ?";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([$senhaHash, $idUsuario]);
}