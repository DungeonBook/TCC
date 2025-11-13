<?php $nome = "(Sessão expirada)";
if (isset($_SESSION[SESSAO_USUARIO_NOME])) $nome = $_SESSION[SESSAO_USUARIO_NOME]; ?>

<!-- link de CSS do menu -->
<link href="https://fonts.googleapis.com/css2?family=MedievalSharp&family=Caudex&family=Almendra&family=Almendra+SC&family=Fondamento&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?= BASEURL ?>/view/css/Menu.css">

<nav class="menu">
    <div class="menu-logo"> <span class="titulo">DungeonBook</span> </div>
    <ul class="menu-links">
        <li><a href="<?= BASEURL ?>/controller/SalaController.php?action=list">Página inicial</a></li>
        <li><a href="<?= BASEURL ?>/controller/SalaController.php?action=listMinhasSalas">Minhas Salas</a></li>
        <li><a href="<?= BASEURL ?>/controller/SalaController.php?action=listMeusJogos">Meus Jogos</a></li>
        <li><a href="<?= BASEURL ?>/controller/SalaController.php?action=create">Nova Sala</a></li>

        <?php if (isset($_SESSION['getIdUsuarioLogado']) && $_SESSION['getIdUsuarioLogado']->getPapel() === 'Administrador'): ?>
            <li><a href="<?= BASEURL ?>/view/usuario/List.php">Usuários</a></li>
        <?php endif; ?>

        <?php
        $current_url = $_SERVER['REQUEST_URI'];
        $show_filter = (
            strpos($current_url, 'action=list') !== false ||
            strpos($current_url, 'action=listMinhasSalas') !== false ||
            strpos($current_url, 'action=listMeusJogos') !== false
        );

        if ($show_filter):
        ?>
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

        <?php endif; ?>
    </ul>

    <div class="menu-perfil">
        <div class="dropdown"> <button class="perfil-btn"><?= $nome ?></button>
            <div class="dropdown-content"> <a href="<?= BASEURL . '/controller/PerfilController.php?action=view' ?>">Perfil</a> <a href="<?= LOGOUT_PAGE ?>">Sair</a> </div>
        </div>
    </div>
</nav>