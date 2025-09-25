<?php
require_once(__DIR__ . "/../include/header.php");
require_once(__DIR__ . "/../include/menu.php");
?>

<!-- link de CSS da listagem de salas -->
<link href="https://fonts.googleapis.com/css2?family=MedievalSharp&family=Caudex&family=Almendra&family=Almendra+SC&family=Fondamento&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?= BASEURL ?>/view/css/salas.css">

<div class="container">
    
    <?php if (isset($msgSucesso) && $msgSucesso != null) : ?>
        <div class="alert alert-success" role="alert">
            <?= $msgSucesso ?>
        </div>
    <?php endif; ?>
        
    <h1>Salas Disponíveis</h1>
    <div class="grid-salas">
        <?php if (!empty($dados['salasDisp'])): ?>
            <?php foreach ($dados['salasDisp'] as $sala): ?>
                <div class="card-sala">
                    <img src="<?= BASEURL ?>/view/img/<?= $sala->getImagemModalidade() ?>" alt="Sala RPG">
                    <h3><?= htmlspecialchars($sala->getNomeSala()) ?></h3>
                    <p><strong>Tema:</strong> <?= htmlspecialchars($sala->getModalidade()->getDescricao()) ?></p>
                    <p><strong>Data:</strong> <?= htmlspecialchars($sala->getDataFormatada()) ?> às <?= htmlspecialchars($sala->getHoraInicio()) ?></p>
                    <a href="./SalaController.php?action=detalhar&id=<?= $sala->getId() ?>" class="btn-detalhes">Ver Detalhes</a>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Nenhuma sala disponível.</p>
        <?php endif; ?>
    </div>


    <h1>Minhas salas</h1>
    <div class="grid-salas">
        <?php if (!empty($dados['minhasSalas'])): ?>
            <?php foreach ($dados['minhasSalas'] as $sala): ?>
                <div class="card-sala">
                    <img src="<?= BASEURL ?>/view/img/<?= $sala->getImagemModalidade() ?>" alt="Sala RPG">
                    <h3><?= htmlspecialchars($sala->getNomeSala()) ?></h3>
                    <p><strong>Tema:</strong> <?= htmlspecialchars($sala->getModalidade()->getDescricao()) ?></p>
                    <p><strong>Data:</strong> <?= htmlspecialchars($sala->getDataFormatada()) ?> às <?= htmlspecialchars($sala->getHoraInicio()) ?></p>
                    <a href="./SalaController.php?action=detalhar&id=<?= $sala->getId() ?>" class="btn-detalhes">Ver Detalhes</a>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Nenhuma sala disponível.</p>
        <?php endif; ?>
    </div>

    <h1>Meus jogos</h1>

</div>


<?php
require_once(__DIR__ . "/../include/footer.php");

?>