<?php

function listarTodosUsuarios($pdo)
{
    $sql = "SELECT id_usuario, nome_completo, login, nivel_acesso FROM usuarios ORDER BY nome_completo ASC";
    $stmt = $pdo->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function cadastrarUsuario($pdo, $dadosUsuario)
{
    $sql = "INSERT INTO usuarios (nome_completo, login, senha_hash, nivel_acesso) VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);

    $senhaHash = password_hash($dadosUsuario['senha'], PASSWORD_DEFAULT);

    $stmt->execute([
        $dadosUsuario['nome_completo'],
        $dadosUsuario['login'],
        $senhaHash,
        $dadosUsuario['nivel_acesso']
    ]);
}

function buscarUsuarioPorId($pdo, $id)
{
    $sql = "SELECT id_usuario, nome_completo, login, nivel_acesso FROM usuarios WHERE id_usuario = ?";
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