<?php

require_once(__DIR__ . "/../include/header.php");
require_once(__DIR__ . "/../include/menu.php");
?>

<h3 class="text-center">Salas</h3>

<div class="container">
    <div class="row">
        <div class="col-3">
            <a class="btn btn-success" 
                href="<?= BASEURL ?>/controller/SalaController.php?action=create">
                Criar</a>
        </div>

        <div class="col-9">
            <?php require_once(__DIR__ . "/../include/msg.php"); ?>
        </div>
    </div>

    <div class="row" style="margin-top: 10px;">
        <div class="col-12">
            <table id="Salas" class='table table-striped table-bordered'>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>quantidade miníma de jogadores</th>
                        <th>quantidade máxima de jogadores</th>
                        <th>horarios</th>
                        <th>identificador</th>
                        <th>modalidade</th>
                        <th>descrição</th>
                        <th>Alterar</th>
                        <th>Excluir</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($dados['lista'] as $sala): ?>
                        <tr>
                            <td><?php echo $sala->getId(); ?></td>
                            <td><?= $sala->getQuantMinJogadores(); ?></td>
                            <td><?= $sala->getQuantMaxJogadores(); ?></td>
                            <td><?= $sala->getHorariosDisponiveis(); ?></td>
                            <td><?= $sala->getIndentificador(); ?></td>
                            <td><?= $sala->getModalidade(); ?></td>
                            <td><?= $sala->getDescricao(); ?></td>
                            <td><a class="btn btn-primary" 
                                href="<?= BASEURL ?>/controller/SalaController.php?action=edit&id=<?= $sala->getId() ?>">
                                Alterar</a> 
                            </td>
                            <td><a class="btn btn-danger" 
                                onclick="return confirm('Confirma a exclusão da Sala?');"
                                href="<?= BASEURL ?>/controller/SalaController.php?action=delete&id=<?= $sala->getId() ?>">
                                Excluir</a> 
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php  
require_once(__DIR__ . "/../include/footer.php");
?>
