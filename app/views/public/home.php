<?php
$pageTitle = 'Início - Sistema de Estoque';
require_once VIEW_PATH . 'partials/header.php';
?>

<div class="container" style="text-align: center;">
    <h1>Bem-vindo ao Sistema de Controle de Estoque</h1>
    <p style="font-size: 18px;">
        Gerencie seus produtos, categorias e usuários de forma simples e eficiente.
    </p>
    <br>
    <p>
        Acesse o painel para começar a usar o sistema ou saiba mais sobre este projeto.
    </p>
    <br>
    <div>
        <a href="?page=login" class="btn">Acessar Sistema</a>
        <a href="?page=sobre" class="btn" style="background: linear-gradient(to bottom, #ccc, #999);">Saiba Mais</a>
    </div>
</div>

<?php require_once VIEW_PATH . 'partials/footer.php'; ?>