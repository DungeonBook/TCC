<?php
require_once(__DIR__ . "/../include/header.php");
require_once(__DIR__ . "/../include/menu.php");
?>

<!-- link de CSS do perfil do usuario -->
<link href="https://fonts.googleapis.com/css2?family=MedievalSharp&family=Caudex&family=Almendra&family=Almendra+SC&family=Fondamento&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?= BASEURL ?>/view/css/perfil.css">

<div class="container">

    <div class="foto-perfil">
        <?php if ($dados['usuario']->getFoto()): ?>
            <img src="<?= BASEURL_ARQUIVOS . '/' . $dados['usuario']->getFoto() ?>" alt="Foto de Perfil">
        <?php else: ?>
            <img src="<?= BASEURL ?>/view/img/fotoPadrao.png" alt="Foto padrão">
        <?php endif; ?>
    </div>

    <div class="dados-usuario">
        <p><strong>Nome:</strong> <?= htmlspecialchars($dados['usuario']->getNome()) ?></p>
        <p><strong>Email:</strong> <?= htmlspecialchars($dados['usuario']->getEmail()) ?></p>
        <p><strong>Papel:</strong> <?= htmlspecialchars($dados['usuario']->getPapel()) ?></p>
    </div>

    <form id="frmUsuario" method="POST"
        action="<?= BASEURL ?>/controller/PerfilController.php?action=save"
        enctype="multipart/form-data">

        <input type="hidden" name="fotoAnterior" value="<?= $dados['usuario']->getFoto() ?>">

        <div class="botoes-perfil">
            <a class="btn-success"
                href="<?= BASEURL ?>/controller/PerfilController.php?action=edit">
                Editar Perfil
            </a>

            <a class="btn btn-secondary"
                href="<?= BASEURL ?>/controller/SalaController.php?action=list">
                Voltar
            </a>
        </div>

        <div class="msg-retorno">
            <?php require_once(__DIR__ . "/../include/msg.php"); ?>
        </div>
    </form>
</div>

<?php
require_once(__DIR__ . "/../include/footer.php");
?>