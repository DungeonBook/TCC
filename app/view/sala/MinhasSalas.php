<?php
require_once(__DIR__ . "/../include/Header.php");
require_once(__DIR__ . "/../include/Menu.php");
?>

<!-- link de CSS das salas que criei -->
<link rel="stylesheet" href="<?= BASEURL ?>/view/css/bootstrap.min.css">
<link rel="stylesheet" href="<?= BASEURL ?>/view/css/Salas.css">

<div class="container">

    <h3>Minhas Salas</h3>

    <?php if (isset($msgSucesso) && $msgSucesso != null) : ?>
        <div class="alert alert-success" role="alert">
            <?= $msgSucesso ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($dados['minhasSalas'])): ?>
        <div class="grid-salas">
            <?php foreach ($dados['minhasSalas'] as $sala): ?>
                <div class="card-sala">
                    <img src="<?= BASEURL ?>/view/img/<?= $sala->getImagemModalidade() ?>" alt="Sala RPG">
                    <h3><?= htmlspecialchars($sala->getNomeSala()) ?></h3>
                    <p><strong>Modalidade:</strong> <?= htmlspecialchars($sala->getModalidade()->getDescricao()) ?></p>
                    <p><strong>Data:</strong> <?= htmlspecialchars($sala->getDataFormatada()) ?> às <?= htmlspecialchars($sala->getHoraInicio()) ?></p>
                    <p><strong>Status:</strong> <?= htmlspecialchars($sala->getStatusDescricao()) ?></p>
                    <a href="./SalaController.php?action=detalhar&id=<?= $sala->getId() ?>" class="btn-detalhes">Ver Detalhes</a>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="no-salas-container">
            <p class="no-salas">Você ainda não criou nenhuma sala.</p>
        </div>
    <?php endif; ?>

<?php
require_once(__DIR__ . "/../include/Footer.php");

?>