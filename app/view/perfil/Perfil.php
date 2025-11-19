<?php
require_once(__DIR__ . "/../include/Header.php");
require_once(__DIR__ . "/../include/Menu.php");
?>

<!-- link de CSS do perfil do usuario -->
<link rel="stylesheet" href="<?= BASEURL ?>/view/css/bootstrap.min.css">
<link rel="stylesheet" href="<?= BASEURL ?>/view/css/Perfil.css">

<div class="container">
    <h3>Perfil</h3>

    <div class="foto-perfil">
        <?php if ($dados['usuario']->getFoto()): ?>
            <img src="<?= BASEURL_ARQUIVOS . '/' . $dados['usuario']->getFoto() ?>" alt="Foto de Perfil">
        <?php else: ?>
            <img src="<?= BASEURL ?>/view/img/fotoPadrao.png" alt="Foto padrão">
        <?php endif; ?>
    </div>

    <div class="dados-usuario">
        <p><strong>Nome:</strong> <?= htmlspecialchars($dados['usuario']->getNome()) ?></p>
        <p><strong>Apelido:</strong> <?= htmlspecialchars($dados['usuario']->getApelido()) ?></p>
        <p><strong>Email:</strong> <?= htmlspecialchars($dados['usuario']->getEmail()) ?></p>
        <p><strong>Celular:</strong> <?= htmlspecialchars($dados['usuario']->getTelefone()) ?></p>
        <p><strong>Aniversário:</strong>
            <?= htmlspecialchars($dados['usuario']->getUsuDataFormatada()) ?></p>
        <p><strong>Usuário:</strong> <?= htmlspecialchars($dados['usuario']->getPapel()) ?></p>
    </div>

    <form id="frmUsuario" method="POST"
        action="<?= BASEURL ?>/controller/PerfilController.php?action=save"
        enctype="multipart/form-data">

        <input type="hidden" name="fotoAnterior" value="<?= $dados['usuario']->getFoto() ?>">

        <div class="botoes-perfil">
            <a class="btn btn-secondary"
                href="<?= BASEURL ?>/controller/SalaController.php?action=list">
                Voltar
            </a>

            <a class="btn-success"
                href="<?= BASEURL ?>/controller/PerfilController.php?action=edit">
                Editar Perfil
            </a>
        </div>

<!---
        TODO - Excluir próprio perfil

        <div>
            <a class="btn"
                onclick="return confirm('Confirma a exclusão do usuário?');"
                href="<?= BASEURL ?>/controller/SalaController.php?action=delete&id=<?= $usu->getId() ?>">
                Excluir</a>
        </div>

--->

        <div class="msg-retorno">
            <?php require_once(__DIR__ . "/../include/Msg.php"); ?>
        </div>
    </form>
</div>

<?php
require_once(__DIR__ . "/../include/Footer.php");
?>