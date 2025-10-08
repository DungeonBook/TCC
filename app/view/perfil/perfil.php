<?php
#Nome do arquivo: perfil/perfil.php
#Objetivo: interface para perfil dos usuários do sistema

require_once(__DIR__ . "/../include/header.php");
require_once(__DIR__ . "/../include/menu.php");
?>

<!-- link de CSS do perfil -->
<link href="https://fonts.googleapis.com/css2?family=MedievalSharp&family=Caudex&family=Almendra&family=Almendra+SC&family=Fondamento&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?= BASEURL ?>/view/css/perfil.css">


<h3 class="text-center">
    Perfil
</h3>

<div class="container">

    <div class="row mt-2">
        <div class="col-12 mb-2">
            <span class="fw-bold">Nome:</span>
            <span><?= $dados['usuario']->getNome() ?></span>
        </div>

        <div class="col-12 mb-2">
            <span class="fw-bold">Email:</span>
            <span><?= $dados['usuario']->getEmail() ?></span>
        </div>

        <div class="col-12 mb-2">
            <span class="fw-bold">Papel:</span>
            <span><?= $dados['usuario']->getPapel() ?></span>
        </div>

        <div class="col-12 mb-2">
            <div class="fw-bold">Foto:</div>
            <?php if ($dados['usuario']->getFoto()): ?>
                <img src="<?= BASEURL_ARQUIVOS . '/' . $dados['usuario']->getFoto() ?>"
                    height="300">
            <?php endif; ?>
        </div>

    </div>

    <div class="row mt-5">

        <div class="col-6">
            <form id="frmUsuario" method="POST"
                action="<?= BASEURL ?>/controller/PerfilController.php?action=save"
                enctype="multipart/form-data">
                <div class="mb-3">
                    <label class="form-label" for="txtFoto">Foto de perfil: </label>
                    <input class="form-control" type="file"
                        id="txtFoto" name="foto" />
                </div>

                <input type="hidden" name="fotoAnterior" value="<?= $dados['usuario']->getFoto() ?>">

                <div class="mt-3">
                    <button type="submit" class="btn btn-success">Salvar</button>
                </div>
            </form>
        </div>

        <div class="col-6">
            <?php require_once(__DIR__ . "/../include/msg.php"); ?>
        </div>
    </div>

    <div class="row" style="margin-top: 30px;">
        <div class="col-12">
            <a class="btn btn-secondary"
                href="<?= BASEURL ?>/controller/SalaController.php?action=list">Voltar</a>
        </div>
    </div>
</div>

<?php
require_once(__DIR__ . "/../include/footer.php");
?>