<?php
require_once(__DIR__ . "/../include/header.php");
require_once(__DIR__ . "/../include/menu.php");
?>
<!-- Fonte medieval + CSS -->
<link href="https://fonts.googleapis.com/css2?family=MedievalSharp&family=Caudex&family=Almendra&family=Almendra+SC&family=Fondamento&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?= BASEURL ?>/view/css/salas.css">

<div class="container">
    <h1>Salas Disponíveis</h1>

    <?php if (isset($msgSucesso) && $msgSucesso != null) : ?>
        <div class="alert alert-success" role="alert">
            <?= $msgSucesso ?>
        </div>
    <?php endif; ?>

    <div class="grid-salas">
        <?php if (!empty($dados['salas'])): ?>
            <?php foreach ($dados['salas'] as $sala): ?>
                <div class="card-sala">
                    <img src="<?= BASEURL ?>/view/img/detalhe.jpeg" alt="Sala RPG">
                    <h3><?= htmlspecialchars($sala->getNomeSala()) ?></h3>
                    <p><strong>Tema:</strong> <?= htmlspecialchars($sala->getModalidade()->getDescricao()) ?></p>
                    <p><strong>Data:</strong> <?= htmlspecialchars($sala->getDataFormatada()) ?> às <?= htmlspecialchars($sala->getHoraInicio()) ?></p>
                    <a href="./SalaController.php?action=detalhar&id=<?= $sala->getId() ?>" class="btn-detalhes">Ver Detalhes</a>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p style="text-align: center;">Nenhuma sala disponível no momento.</p>
        <?php endif; ?>
    </div>
</div>


<?php
require_once(__DIR__ . "/../include/footer.php");

?>