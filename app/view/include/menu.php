<?php
$nome = "(Sessão expirada)";
if (isset($_SESSION[SESSAO_USUARIO_NOME]))
    $nome = $_SESSION[SESSAO_USUARIO_NOME];
?>

<!-- Fontes + CSS -->
<link href="https://fonts.googleapis.com/css2?family=MedievalSharp&family=Caudex&family=Almendra&family=Almendra+SC&family=Fondamento&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?= BASEURL ?>/view/css/menu.css">

<nav class="menu">
    <div class="menu-logo">
        <span class="titulo">DungeonBook</span>
    </div>

    <ul class="menu-links">
        <li><a href="<?= BASEURL ?>/controller/UsuarioController.php?action=list">Usuários</a></li>
        <li><a href="<?= BASEURL ?>/controller/SalaController.php?action=list">Página inicial</a></li>
        <li><a href="<?= BASEURL ?>/controller/SalaController.php?action=listMinhasSalas">Minhas Salas</a></li>
        <li><a href="<?= BASEURL ?>/controller/JogoController.php?action=listMeusJogos">Meus Jogos</a></li>
        <li><a href="<?= BASEURL ?>/controller/SalaController.php?action=create">Nova Sala</a></li>
    </ul>

    <div class="menu-perfil">
        <div class="dropdown">
            <button class="perfil-btn"><?= $nome ?></button>
            <div class="dropdown-content">
                <a href="<?= BASEURL . '/controller/PerfilController.php?action=view' ?>">Perfil</a>
                <a href="<?= LOGOUT_PAGE ?>">Sair</a>
            </div>
        </div>
    </div>
</nav>