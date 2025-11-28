<?php
require_once(__DIR__ . "/../include/Header.php");
require_once(__DIR__ . "/../include/Menu.php");
?>

<link rel="stylesheet" href="<?= BASEURL ?>/view/css/bootstrap.min.css">
<link rel="stylesheet" href="<?= BASEURL ?>/view/css/Salas.css">

<div class="container">

    <?php

    $sala = $dados['sala'];
    $isCriador = $dados['usuarioLogadoisCriador'];

    if (!empty($sala)): ?>
        <div class="card-sala-detalhe">

            <h1><?= htmlspecialchars($sala->getNomeSala()) ?></h1>

            <div class="info-grid">

                <div class="info-box">
                    <span class="info-label">Mestre de mesa:</span>
                    <span class="info-value"><?= htmlspecialchars($sala->getCriador()->getApelido()) ?></span>
                </div>
                <div class="info-box">
                    <span class="info-label">Status:</span>
                    <span class="info-value"><?= htmlspecialchars($sala->getStatusDescricao()) ?></span>
                </div>

                <div class="info-box">
                    <span class="info-label">Mín. Jogadores:</span>
                    <span class="info-value"><?= htmlspecialchars($sala->getQuantMinJogadores()) ?></span>
                </div>
                <div class="info-box">
                    <span class="info-label">Máx. Jogadores:</span>
                    <span class="info-value"><?= htmlspecialchars($sala->getQuantMaxJogadores()) ?></span>
                </div>

                <div class="info-box">
                    <span class="info-label">Data da partida:</span>
                    <span class="info-value"><?= htmlspecialchars($sala->getDataFormatada()) ?></span>
                </div>
                <div class="info-box">
                    <span class="info-label">Modalidade:</span>
                    <span class="info-value"><?= htmlspecialchars($sala->getModalidade()->getDescricao()) ?></span>
                </div>

                <div class="info-box">
                    <span class="info-label">Início:</span>
                    <span class="info-value"><?= htmlspecialchars($sala->getHoraInicio()) ?></span>
                </div>
                <div class="info-box">
                    <span class="info-label">Fim:</span>
                    <span class="info-value"><?= htmlspecialchars($sala->getHoraFim()) ?></span>
                </div>

                <div class="info-box info-full-row">
                    <span class="info-label">Localização:</span>
                    <span class="info-value"><?= htmlspecialchars($sala->getLocalizacao()) ?></span>
                </div>

            </div>
            <hr class="separator-line" />

            <div class="description-box">
                <p class="description-title">Descrição:</p>
                <p class="description-text"><?= htmlspecialchars($sala->getDescricao()) ?></p>
            </div>

            <hr class="separator-line" />

            <div class="actions">
                <?php if ($isCriador): ?>
                    <a href="./SalaController.php?action=edit&id=<?= $sala->getId() ?>" class="btn">Editar</a>
                    <a href="./SalaController.php?action=delete&id=<?= $sala->getId() ?>" class="btn"
                        onclick="return confirm('Tem certeza que deseja excluir esta sala?');">Excluir</a>
                <?php endif; ?>
            </div>

            <div class="actions actions-inline">
                <?php if ($sala->getStatus() == true and ($isCriador == false)) : ?>
                    <a href="./SalaJogadoresController.php?action=participar&idSala=<?= $sala->getId() ?>"
                        class="btn"
                        onclick="return confirm('Deseja participar da sala?');">Participar</a>
                <?php endif; ?>
                <a href="./SalaJogadoresController.php?action=detalharPartida&idSala=<?= $sala->getId() ?>" class="btn">Participantes</a>
            </div>

            <div class="actions">
                <a href="./SalaController.php?action=list" class="btn">Voltar</a>
            </div>

            <div class="participar-msg">
                <?php require_once(__DIR__ . "/../include/Msg.php"); ?>
            </div>

        <?php endif; ?>
        </div>

        <?php
        require_once(__DIR__ . "/../include/Footer.php");
        ?>