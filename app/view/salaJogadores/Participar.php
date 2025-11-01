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

    <?php


    //$usuarioLogado = $_SESSION["usuario"] ?? null;
    //$salaId = $_GET["id"] ?? null;

    /*
    $msg = "";

    if (!$usuarioLogado) {
        $msg = "Você precisa estar logado para participar de uma sala.";
    } elseif (!$salaId) {
        $msg = "Sala não encontrada.";
    } else {
        try {
            $salaJogadoresDAO = new SalaJogadoresDAO();

            $conn = Connection::getConn();
            $checkSql = "SELECT COUNT(*) AS total FROM salas_jogadores WHERE usuario_id = ? AND sala_id = ?";
            $stm = $conn->prepare($checkSql);
            $stm->execute([$usuarioLogado->getId(), $salaId]);
            $exists = $stm->fetch(PDO::FETCH_ASSOC)['total'] ?? 0;

            if ($exists > 0) {
                $msg = "Você já está participando desta sala.";
            } else {
                $salaJogadoresDAO->insert($salaId, $usuarioLogado->getId());
                $msg = "Participação confirmada!";
            }
        } catch (Exception $e) {
            $msg = "Erro ao participar da sala: " . $e->getMessage();
        }
    }*/
    ?>

    <div class="participar-container">
        <h1 class="participar-titulo">Participar da Sala</h1>

        <div class="participar-msg">
            <?php require_once(__DIR__ . "/../include/Msg.php"); ?>

            <div class="participar-botoes">
                <a href="<?= BASEURL ?>/controller/SalaController.php?action=list">Página inicial</a>
            </div>
        </div>

        <?php if (!empty($msg)): ?>
            <p class="mensagem"><?= htmlspecialchars($msg) ?></p>
        <?php endif; ?>
    </div>

    <?php
    require_once(__DIR__ . "/../include/Footer.php");
    ?>