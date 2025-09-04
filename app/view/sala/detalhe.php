<?php 
require_once(__DIR__ . "/../include/header.php");
?>
<!-- Fonte medieval + CSS -->
<link href="https://fonts.googleapis.com/css2?family=MedievalSharp&family=Caudex&family=Almendra&family=Almendra+SC&family=Fondamento&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?= BASEURL ?>/view/css/salas.css">

<div class="container">
    <?php if (!empty($sala)): ?>
        <div class="card-sala-detalhe">
            <h1><?= htmlspecialchars($sala['nome']) ?></h1>
            <p><strong>Tema:</strong> <?= htmlspecialchars($sala['tema']) ?></p>
            <p><strong>Localização:</strong> <?= htmlspecialchars($sala['localizacao']) ?></p>
            <p><strong>Data:</strong> <?= htmlspecialchars($sala['data']) ?> às <?= htmlspecialchars($sala['horario']) ?></p>
            <p><strong>Capacidade:</strong> <?= htmlspecialchars($sala['capacidade']) ?> jogadores</p>
            <p><strong>Descrição:</strong> <?= htmlspecialchars($sala['introducao']) ?></p>

            <a href="./SalaController.php?action=listar" class="btn-detalhes">← Voltar às salas</a>
        </div>
    <?php else: ?>
        <p>⚠️ Sala não encontrada.</p>
        <a href="./SalaController.php?action=listar" class="btn-detalhes">Voltar</a>
    <?php endif; ?>
</div>

<?php
require_once(__DIR__ . "/../include/footer.php");
?>
