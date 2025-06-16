<?php
$pageTitle = 'Contato - Sistema de Estoque';
require_once VIEW_PATH . 'partials/header.php';
?>

<div class="container">
    <h1>Entre em Contato</h1>
    <p>
        Tem alguma dúvida ou sugestão? Preencha o formulário abaixo para nos enviar uma mensagem.
    </p>
    <br>
    <form action="#" method="POST">
        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token'] ?? '') ?>">
        <div>
            <label for="nome">Seu Nome:</label>
            <input type="text" id="nome" name="nome" required>
        </div>
        <br>
        <div>
            <label for="email">Seu E-mail:</label>
            <input type="text" id="email" name="email" required>
        </div>
        <br>
        <div>
            <label for="mensagem">Mensagem:</label>
            <textarea name="mensagem" id="mensagem" rows="5" style="width: 100%; resize: vertical;" required></textarea>
        </div>
        <br>
        <div>
            <button type="submit">Enviar Mensagem</button>
        </div>
    </form>
</div>

<?php require_once VIEW_PATH . 'partials/footer.php'; ?>