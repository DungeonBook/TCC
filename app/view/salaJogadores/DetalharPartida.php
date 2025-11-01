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

    <div class="participar-container mt-5" style="width: 100%;">

        <h1 class="participar-titulo">Detalhes da Partida</h1>
        <h3 class=""><?= $dados['sala']->getNomeSala() ?></h3>


        <?php if (!empty($dados['msg'])): ?>
            <div class="participar-msg">

                <?= $dados['msg'] ?></p>

            </div>
        <?php endif; ?>

        <p>Data da partida:</p>

        <p>Número de jogadores: <?= $dados['numeroJogadores'] ?></p>


        <p>Jogadores:</p>
        <ul>
        <?php foreach ($dados['jogadores'] as $jogador): ?>
             <li><?php print_r($jogador['apelido']); ?></li>
        <?php endforeach; ?>
        </ul>

    </div>

    <?php
    print_r($dados);
    ?>

    <?php
    require_once(__DIR__ . "/../include/Footer.php");
    ?>