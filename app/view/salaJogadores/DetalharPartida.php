<?php
require_once(__DIR__ . "/../include/Header.php");
require_once(__DIR__ . "/../include/Menu.php");
?>

<!-- link de CSS -->
<link href="https://fonts.googleapis.com/css2?family=MedievalSharp&family=Caudex&family=Almendra&family=Almendra+SC&family=Fondamento&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?= BASEURL ?>/view/css/Participar.css">

<div class="container">
    <div class="participar-container mt-5">
        <h3><?= htmlspecialchars($dados['sala']->getNomeSala()) ?></h3>

        <?php if (!empty($dados['msg'])): ?>
            <div class="participar-msg">
                <p><?= $dados['msg'] ?></p>
            </div>
        <?php endif; ?>

        <table id="tabUsuarios">
            <thead>
                <tr>
                    <th></th>
                    <th>Jogadores</th>
                    <th></th>
                    <?php if ($dados['usuarioLogadoisCriador']): ?>
                        <th></th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>

                <tr>
                    <td>
                        <img src="<?= $dados["sala"]->getCriador()->getFoto()
                            ? BASEURL_ARQUIVOS . "/" . $dados["sala"]->getCriador()->getFoto()
                            : BASEURL . "/view/img/fotoPadrao.png" ?>"
                            alt="Foto do mestre" class="foto-jogador">
                    </td>
                    <td><?= htmlspecialchars($dados["sala"]->getCriador()->getApelido()) ?></td>
                    <td>Mestre de mesa</td>
                    <?php if ($dados['usuarioLogadoisCriador']): ?>
                        <td></td>
                    <?php endif; ?>
                </tr>

                <?php foreach ($dados['jogadores'] as $jog): ?>
                    <tr>
                        <td>
                            <img src="<?= $jog->getJogador()->getFoto()
                                ? BASEURL_ARQUIVOS . "/" . $jog->getJogador()->getFoto()
                                : BASEURL . "/view/img/fotoPadrao.png" ?>"
                                alt="Foto do jogador" class="foto-jogador">
                        </td>

                        <td><?= htmlspecialchars($jog->getJogador()->getApelido()) ?></td>
                        <td></td>

                        <?php if ($dados['usuarioLogadoisCriador']): ?>
                            <td>
                                <a class="btn"
                                   onclick="return confirm('Confirma a exclusão do jogador?');"
                                   href="<?= BASEURL ?>/controller/SalaJogadoresController.php?action=deleteJogador&id=<?= $jog->getId() ?>&idSala=<?= $jog->getSala()->getId() ?>">
                                    Excluir
                                </a>
                            </td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>

            </tbody>
        </table>
    </div>

    <div class="botao-container">
        <a class="btn" href="<?= BASEURL ?>/controller/SalaController.php?action=list">Voltar</a>
    </div>

    <div style="margin-top:30px;">
        <?php require_once(__DIR__ . "/../include/Msg.php"); ?>
    </div>
</div>

<?php
require_once(__DIR__ . "/../include/Footer.php");
?>
