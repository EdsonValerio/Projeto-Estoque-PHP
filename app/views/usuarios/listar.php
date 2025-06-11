<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Gerenciar Usuários</title>
</head>
<body>
    <h1>Gerenciar Usuários do Sistema</h1>

    <a href="?page=usuarios_novo">Adicionar Novo Usuário</a>
    <hr>

    <?php
    if (isset($_GET['error'])) {
        if ($_GET['error'] == 'self_delete') {
            echo '<p style="color:red;">Você não pode excluir o seu próprio usuário enquanto estiver logado.</p>';
        }
        if ($_GET['error'] == 'not_found') {
            echo '<p style="color:red;">Usuário não encontrado.</p>';
        }
    }
    ?>

    <table border="1" style="width:100%; border-collapse: collapse;">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome Completo</th>
                <th>Login</th>
                <th>Nível de Acesso</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (!empty($listaDeUsuarios)) {
                foreach ($listaDeUsuarios as $usuario) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($usuario['id_usuario']) . "</td>";
                    echo "<td>" . htmlspecialchars($usuario['nome_completo']) . "</td>";
                    echo "<td>" . htmlspecialchars($usuario['login']) . "</td>";
                    $nivelAcesso = '';
                    switch ($usuario['nivel_acesso']) {
                        case 1: $nivelAcesso = 'Funcionário'; break;
                        case 2: $nivelAcesso = 'Dono'; break;
                        case 3: $nivelAcesso = 'Admin'; break;
                        default: $nivelAcesso = 'Desconhecido'; break;
                    }
                    echo "<td>" . htmlspecialchars($nivelAcesso) . "</td>";
                    echo "<td>";
                    echo "<a href='?page=usuarios_editar&id=" . $usuario['id_usuario'] . "'>Editar</a> | ";
                    echo "<a href='?page=usuarios_excluir&id=" . $usuario['id_usuario'] . "' onclick=\"return confirm('Tem certeza que deseja excluir este usuário?');\">Excluir</a>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>Nenhum usuário cadastrado.</td></tr>";
            }
            ?>
        </tbody>
    </table>
    <br>
    <a href="?page=dashboard">Voltar ao Painel</a>
</body>
</html>