<?php
require_once(__DIR__ . "/../include/Header.php");
require_once(__DIR__ . "/../include/Menu.php");
?>
<link rel="stylesheet" href="<?= BASEURL ?>/view/css/home.css">

<h3 class="text-center">Página inicial do sistema</h3>

<div class="container">
    <span>Usuários cadastrados no sistema: </span>
    <span class="fonteBonita">
        <?php echo $dados["qtdUsuarios"] ?>
    </span>
    <button class="btn btn-info" 
        onclick="carregarUsuarios('<?= BASEURL ?>')">Ajax</button>

    <div>
        <ul id="listaUsuarios">
            
        </ul>
    </div>
</div>

<script src="<?= BASEURL ?>/view/js/home_ajax.js"></script>

<?php  
require_once(__DIR__ . "/../include/Footer.php");
?>