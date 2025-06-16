<?php

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

function buscarUsuarioPorLogin($pdo, $login)
{
    $sql = "SELECT id_usuario, login, nome_completo, nivel_acesso, cpf, data_nascimento FROM usuarios WHERE login = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$login]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
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

    if (empty($setParts)) {
        return false;
    }

    $sql = "UPDATE usuarios SET " . implode(', ', $setParts) . " WHERE id_usuario = ?";
    $params[] = $id;

    $stmt = $pdo->prepare($sql);
    return $stmt->execute($params);
}

function excluirUsuario($pdo, $id)
{
    $sql = "DELETE FROM usuarios WHERE id_usuario = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
}

function listarTodosUsuarios($pdo)
{
    $sql = "SELECT id_usuario, nome_completo, login, nivel_acesso, cpf, data_nascimento FROM usuarios ORDER BY nome_completo ASC";
    $stmt = $pdo->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function buscarUsuarioPorCpfDataNascimento($pdo, $cpf, $dataNascimento)
{
    $sql = "SELECT id_usuario, login, nome_completo FROM usuarios WHERE cpf = ? AND data_nascimento = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$cpf, $dataNascimento]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function redefinirSenhaUsuario($pdo, $idUsuario, $novaSenha)
{
    $senhaHash = password_hash($novaSenha, PASSWORD_DEFAULT);
    $sql = "UPDATE usuarios SET senha_hash = ? WHERE id_usuario = ?";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([$senhaHash, $idUsuario]);
}