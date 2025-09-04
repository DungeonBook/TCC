
<?php 
require_once(__DIR__ . "/../include/header.php");
?>
<!-- Fonte medieval + CSS -->
<link href="https://fonts.googleapis.com/css2?family=MedievalSharp&family=Caudex&family=Almendra&family=Almendra+SC&family=Fondamento&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?= BASEURL ?>/view/css/salas.css">

<div class="container">
    <h1>Salas Disponíveis</h1>

    <div class="grid-salas">
        <?php if (!empty($salas)): ?>
            <?php foreach ($salas as $sala): ?>
                <div class="card-sala">
                    <img src="<?= BASEURL ?>/view/img/dice-d20-playing-dnd-dungeon-600nw-2235210241.webp" alt="Sala RPG">
                    <h3><?= htmlspecialchars($sala['nome']) ?></h3>
                    <p><strong>Tema:</strong> <?= htmlspecialchars($sala['tema']) ?></p>
                    <p><strong>Data:</strong> <?= htmlspecialchars($sala['data']) ?> às <?= htmlspecialchars($sala['horario']) ?></p>
                    <a href="./SalaController.php?action=detalhar&id=<?= $sala['id'] ?>" class="btn-detalhes">Ver Detalhes</a>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Nenhuma sala disponível no momento.</p>
        <?php endif; ?>
    </div>
</div>

<?php
require_once(__DIR__ . "/../include/footer.php");
?>
