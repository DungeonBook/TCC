<?php
require_once(__DIR__ . "/../include/Header.php");
require_once(__DIR__ . "/../include/Menu.php");
?>

<!-- link de CSS -->
<link rel="stylesheet" href="<?= BASEURL ?>/view/css/bootstrap.min.css">
<link rel="stylesheet" href="<?= BASEURL ?>/view/css/Participar.css">

<div class="container">
    <div class="participar-container">
        <h3 class="participar-titulo">Participar da Sala</h3>

        <div class="participar-msg">
            <?php require_once(__DIR__ . "/../include/Msg.php"); ?>
        </div>

        <?php if (!empty($msg)): ?>
            <p class="mensagem"><?= htmlspecialchars($msg) ?></p>
        <?php endif; ?>

        <div class="botao-container">
            <a class="btn" href="<?= BASEURL ?>/controller/SalaController.php?action=list">Voltar</a>
        </div>
    </div>
</div>

<?php
require_once(__DIR__ . "/../include/Footer.php");
?>
