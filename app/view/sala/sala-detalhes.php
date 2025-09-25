<?php
require_once(__DIR__ . "/../include/header.php");
?>

<!-- link de CSS do detalhamento de salas -->
<link href="https://fonts.googleapis.com/css2?family=MedievalSharp&family=Caudex&family=Almendra&family=Almendra+SC&family=Fondamento&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?= BASEURL ?>/view/css/salas.css">

<div class="container">

    <?php

    $sala = $dados['sala'];
    $idUsuarioLogado = $dados['idUsuarioLogado'];

    if (!empty($sala)): ?>
        <div class="card-sala-detalhe">

            <h1><?= htmlspecialchars($sala->getNomeSala()) ?></h1>

            <p><strong>Mestre de mesa:</strong> <?= htmlspecialchars($sala->getCriador()->getApelido()) ?></p>
            <p><strong>Quantidade miníma de jogadores:</strong> <?= htmlspecialchars($sala->getQuantMinJogadores()) ?></p>
            <p><strong>Quantidade máxima de jogadores:</strong> <?= htmlspecialchars($sala->getQuantMaxJogadores()) ?></p>
            <p><strong>Data da partida:</strong> <?= htmlspecialchars($sala->getDataFormatada()) ?></p>
            <p><strong>Horário de início da partida:</strong> <?= htmlspecialchars($sala->getHoraInicio()) ?></p>
            <p><strong>Horário de fim da partida:</strong> <?= htmlspecialchars($sala->getHoraFim()) ?></p>
            <p><strong>Localização:</strong> <?= htmlspecialchars($sala->getLocalizacao()) ?></p>
            <p><strong>Descrição:</strong> <?= htmlspecialchars($sala->getDescricao()) ?></p>
            <p><strong>Modalidade:</strong> <?= htmlspecialchars($sala->getModalidade()->getDescricao()) ?></p>
            <p><strong>Status:</strong> <?= htmlspecialchars($sala->getStatusDescricao()) ?></p>

            <?php if ($idUsuarioLogado == $sala->getCriador()->getId()): ?>
                <div class="acoes-sala">
                    <a href="./SalaController.php?action=edit&id=<?= $sala->getId() ?>" class="btn-acao">Editar</a>
                    <a href="./SalaController.php?action=delete&id=<?= $sala->getId() ?>" class="btn-acao btn-excluir" onclick="return confirm('Tem certeza que deseja excluir esta sala?')">Excluir</a>
                </div>
            <?php endif; ?>

            <?php if ($sala->getStatus() == true): ?>
                <a href="./SalaJogadoresController.php?action=inserir&idSala=<?= $sala->getId() ?>" class="btn-detalhes"
                    onclick="return confirm('Deseja participar da sala?');">Participar</a>
            <?php endif; ?>

            <a href="./SalaController.php?action=list" class="btn-detalhes">Voltar às salas</a>
        </div>
    <?php else: ?>
        <p>Sala não encontrada.</p>
        <a href="./SalaController.php?action=list" class="btn-detalhes">Voltar</a>
    <?php endif; ?>
</div>

<?php
require_once(__DIR__ . "/../include/footer.php");
?>