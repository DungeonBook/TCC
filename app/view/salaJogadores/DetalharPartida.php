<?php
require_once(__DIR__ . "/../include/Header.php");
require_once(__DIR__ . "/../include/Menu.php");
//require_once(__DIR__ . "/../../dao/SalaJogadoresDAO.php");
//require_once(__DIR__ . "/../../dao/SalaDAO.php");
//require_once(__DIR__ . "/../../model/Usuario.php");
?>

<!-- link de CSS da participação de um usuário na sala-->
<link href="https://fonts.googleapis.com/css2?family=MedievalSharp&family=Caudex&family=Almendra&family=Almendra+SC&family=Fondamento&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?= BASEURL ?>/view/css/Participar.css">

<div class="container">


    <!-- mensagens de erro, se houverem -->

    <div class="participar-container mt-5">
        <h3 class=""><?= $dados['sala']->getNomeSala() ?></h3>


        <?php if (!empty($dados['msg'])): ?>
            <div class="participar-msg">

                <?= $dados['msg'] ?></p>

            </div>
        <?php endif; ?>
        <table id="tabUsuarios">
            <thead>
                <tr>
                    <th></th>
                    <th>Jogador</th>
                    <th>Papel</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>

                <tr>
                    <td>
                        <?php if ($dados["sala"]->getCriador()->getFoto()): ?>
                            <img src="<?= BASEURL_ARQUIVOS . "/" . $dados["sala"]->getCriador()->getFoto(); ?>"
                                width="100px" height="auto">
                        <?php else: ?>
                            <img src="<?= BASEURL . "/view/img/fotoPadrao.png" ?>"
                                width="100px" height="auto">
                        <?php endif; ?>
                    </td>
                    <td><?= $dados["sala"]->getCriador()->getApelido(); ?></td>
                    <td>Mestre de mesa</td>
                    <td></td>
                </tr>

                <?php foreach ($dados['jogadores'] as $jog): ?>

                    <tr>
                        <td>
                            <?php if ($jog->getJogador()->getFoto()): ?>
                                <img src="<?= BASEURL_ARQUIVOS . "/" . $jog->getJogador()->getFoto(); ?>"
                                    width="100px" height="auto">
                            <?php else: ?>
                                <img src="<?= BASEURL . "/view/img/fotoPadrao.png" ?>"
                                    width="100px" height="auto">
                            <?php endif; ?>
                        </td>

                        <td><?= $jog->getJogador()->getApelido(); ?></td>
                        <td>Participante</td>

                        <td>
                            <?php if ($dados['usuarioLogadoisCriador']): ?>
                                <a class="btn"
                                    onclick="return confirm('Confirma a exclusão do jogador?');"
                                    href="<?= BASEURL ?>/controller/SalaJogadoresController.php?action=deleteJogador&id=<?= $jog->getId() ?>">
                                    Excluir</a>
                            <?php endif; ?>
                        </td>
                    </tr>

                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="actions">
            <a class="btn" href="<?= BASEURL ?>/controller/SalaController.php?action=list">Voltar</a>
        </div>
    </div>

    <div style="margin-top:30px;">
        <?php require_once(__DIR__ . "/../include/Msg.php"); ?>
    </div>

    <?php
    require_once(__DIR__ . "/../include/Footer.php");
    ?>