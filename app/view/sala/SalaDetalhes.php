<?php
require_once(__DIR__ . "/../include/Header.php");
require_once(__DIR__ . "/../include/Menu.php");
?>

<!-- link de CSS do detalhamento de salas -->
<link href="https://fonts.googleapis.com/css2?family=MedievalSharp&family=Caudex&family=Almendra&family=Almendra+SC&family=Fondamento&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?= BASEURL ?>/view/css/Salas.css">

<div class="container">

    <?php

    $sala = $dados['sala'];
    $isCriador = $dados['usuarioLogadoisCriador'];

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

            <div class="actions">
                <?php if ($isCriador): ?>
                    <a href="./SalaController.php?action=edit&id=<?= $sala->getId() ?>" class="btn">Editar</a>
                    <a href="./SalaController.php?action=delete&id=<?= $sala->getId() ?>" class="btn"
                        onclick="return confirm('Tem certeza que deseja excluir esta sala?');">Excluir</a>
                <?php endif; ?>
            </div>

            <div class="actions">
                <?php if ($sala->getStatus() == true and ($isCriador == false)) : ?>
                    <a href="./SalaJogadoresController.php?action=participar&idSala=<?= $sala->getId() ?>"
                        class="btn"
                        onclick="return confirm('Deseja participar da sala?');">Participar</a>
                <?php endif; ?>
            </div>

            <div class="actions">
                <a href="./SalaJogadoresController.php?action=detalharPartida&idSala=<?= $sala->getId() ?>" class="btn-detalhes">Participantes</a>
            </div>

            <div class="actions">
                <a href="./SalaController.php?action=list" class="btn-detalhes">Voltar</a>
            </div>

            <div class="participar-msg">
                <?php require_once(__DIR__ . "/../include/Msg.php"); ?>
            </div>

        <?php endif; ?>
        </div>

        <?php
        require_once(__DIR__ . "/../include/Footer.php");
        ?>