<?php
require_once(__DIR__ . "/../include/header.php");
require_once(__DIR__ . "/../include/menu.php");
?>

<!-- link de CSS da listagem de usuarios -->
<link href="https://fonts.googleapis.com/css2?family=MedievalSharp&family=Caudex&family=Almendra&family=Almendra+SC&family=Fondamento&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?= BASEURL ?>/view/css/list.css">

<div class="container">

    <div class="row">
        <div class="col-3">
            <a class="btn"
               href="<?= BASEURL ?>/controller/UsuarioController.php?action=create">
               Novo usuário</a>
        </div>

        <div class="col-9">
            <?php require_once(__DIR__ . "/../include/msg.php"); ?>
        </div>
    </div>

    <div class="row" style="margin-top: 20px;">
        <div class="col-12">
            <table id="tabUsuarios">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Papel</th>
                        <th>Editar</th>
                        <th>Excluir</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($dados['lista'] as $usu): ?>
                        <tr>
                            <td><?= $usu->getId(); ?></td>
                            <td><?= $usu->getNome(); ?></td>
                            <td><?= $usu->getEmail(); ?></td>
                            <td><?= $usu->getPapel(); ?></td>
                            <td>
                                <a class="btn"
                                   href="<?= BASEURL ?>/controller/UsuarioController.php?action=edit&id=<?= $usu->getId() ?>">
                                   Editar</a>
                            </td>
                            <td>
                                <a class="btn"
                                   onclick="return confirm('Confirma a exclusão do usuário?');"
                                   href="<?= BASEURL ?>/controller/UsuarioController.php?action=delete&id=<?= $usu->getId() ?>">
                                   Excluir</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

    <div style="margin-top:30px;">
        <?php require_once(__DIR__ . "/../include/msg.php"); ?>
    </div>

<?php
require_once(__DIR__ . "/../include/footer.php");
?>
