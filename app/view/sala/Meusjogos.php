<?php
require_once(__DIR__ . "/../include/Header.php");
require_once(__DIR__ . "/../include/Menu.php");
?>

<!-- link de CSS das salas que participei -->
<link href="https://fonts.googleapis.com/css2?family=MedievalSharp&family=Caudex&family=Almendra&family=Almendra+SC&family=Fondamento&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?= BASEURL ?>/view/css/Salas.css">

<div class="container">
    
    <?php if (isset($msgSucesso) && $msgSucesso != null) : ?>
        <div class="alert alert-success" role="alert">
            <?= $msgSucesso ?>
        </div>
    <?php endif; ?>
        
    <div class="grid-salas">
        <?php if (!empty($dados["meusJogos"])): ?>
            <?php foreach ($dados["meusJogos"] as $sala): ?>
                <div class="card-sala">
                    <img src="<?= BASEURL ?>/view/img/<?= $sala->getImagemModalidade() ?>" alt="Sala RPG">
                    <h3><?= htmlspecialchars($sala->getNomeSala()) ?></h3>
                    <p><strong>Tema:</strong> <?= htmlspecialchars($sala->getModalidade()->getDescricao()) ?></p>
                    <p><strong>Data:</strong> <?= htmlspecialchars($sala->getDataFormatada()) ?> às <?= htmlspecialchars($sala->getHoraInicio()) ?></p>
                    <a href="./SalaController.php?action=detalhar&id=<?= $sala->getId() ?>" class="btn-detalhes">Ver Detalhes</a>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Ainda não participou de nenhum jogo.</p>
        <?php endif; ?>
    </div>

</div>


<?php
require_once(__DIR__ . "/../include/Footer.php");

?>
