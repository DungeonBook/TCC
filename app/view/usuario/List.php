<?php
require_once(__DIR__ . "/../include/Header.php");
require_once(__DIR__ . "/../include/Menu.php");
?>

<!-- link de CSS da listagem de usuarios -->
<link href="https://fonts.googleapis.com/css2?family=MedievalSharp&family=Caudex&family=Almendra&family=Almendra+SC&family=Fondamento&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?= BASEURL ?>/view/css/List.css">

<div class="container">
    <h3>Usuários Cadastrados no Sistema</h3>

    <div class="row">

        <div class="col-9">
            <?php require_once(__DIR__ . "/../include/Msg.php"); ?>
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
            <div class="botao-container">
                <a class="btn"
                    href="<?= BASEURL ?>/controller/UsuarioController.php?action=create">
                    Novo Usuário</a>
            </div>

        </div>
    </div>
</div>

<div style="margin-top:30px;">
    <?php require_once(__DIR__ . "/../include/Msg.php"); ?>
</div>

<?php
require_once(__DIR__ . "/../include/Footer.php");
?>