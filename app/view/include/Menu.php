<?php

$nome = "(Sessão expirada)";
if (isset($_SESSION[SESSAO_USUARIO_NOME]))
    $nome = $_SESSION[SESSAO_USUARIO_NOME];

include_once(__DIR__ . "/../../model/enum/UsuarioPapel.php");

require_once(__DIR__ . "/../../dao/ModalidadeDAO.php");
$modalidadeDAO = new ModalidadeDAO();
$modalidades = $modalidadeDAO->list();

?>

<!-- link de CSS do menu -->
<link rel="stylesheet" href="<?= BASEURL ?>/view/css/bootstrap.min.css">
<link rel="stylesheet" href="<?= BASEURL ?>/view/css/Menu.css">

<nav class="menu">
    <div class="menu-logo">
        <img src="<?= BASEURL ?>/view/img/logo_dungeonbook.png" class="logo-img">
        <span class="titulo">DungeonBook</span>
    </div>

    <ul class="menu-links">
        <li><a href="<?= BASEURL ?>/controller/SalaController.php?action=list">Página inicial</a></li>
        <li><a href="<?= BASEURL ?>/controller/SalaController.php?action=listMinhasSalas">Minhas Salas</a></li>
        <li><a href="<?= BASEURL ?>/controller/SalaController.php?action=listMeusJogos">Meus Jogos</a></li>
        <li><a href="<?= BASEURL ?>/controller/SalaController.php?action=create">Nova Sala</a></li>


        <?php if (isset($_SESSION[SESSAO_USUARIO_PAPEL]) && $_SESSION[SESSAO_USUARIO_PAPEL] ===  UsuarioPapel::ADMINISTRADOR): ?>
            <li><a href="<?= BASEURL ?>/controller/UsuarioController.php?action=list">Usuários</a></li>
        <?php endif; ?>

        <?php
        $current_url = $_SERVER['REQUEST_URI'];
        if (
            str_contains($current_url, 'SalaController.php?action=list') &&
            (! str_contains($current_url, 'SalaController.php?action=listM'))
        ):
        ?>
            <form method="get">
                <input type="hidden" name="action" value="list">

                <select name="modalidade_id" class="filtro-select" onchange="this.form.submit()">
                    <option value="">Buscar por modalidade</option>
                    <?php if (isset($modalidades) && is_array($modalidades)): ?>
                        <?php foreach ($modalidades as $mod): ?>
                            <option value="<?= $mod->getId() ?>">
                                <?= htmlspecialchars($mod->getDescricao()) ?>
                            </option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
            </form>
        <?php endif; ?>
    </ul>

    <div class="menu-perfil">
        <div class="dropdown"> <button class="perfil-btn"><?= $nome ?></button>
            <div class="dropdown-content"> <a href="<?= BASEURL . '/controller/PerfilController.php?action=view' ?>">Perfil</a> <a href="<?= LOGOUT_PAGE ?>">Sair</a> </div>
        </div>
    </div>
</nav>