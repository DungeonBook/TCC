<?php require_once(__DIR__ . "/../include/header.php");
require_once(__DIR__ . "/../include/menu.php"); ?>

<div class="container mt-4">
    <h2>Minhas Salas</h2>

    <?php if (!empty($msgErro)): ?>
        <div class="alert alert-danger"><?= $msgErro ?></div>
    <?php endif; ?>

    <?php if (!empty($msgSucesso)): ?>
        <div class="alert alert-success"><?= $msgSucesso ?></div>
    <?php endif; ?>

    <a href="index.php?controller=sala&action=create" class="btn btn-primary mb-3">Nova Sala</a>

    <?php if (empty($dados['salas'])): ?>
        <p>Nenhuma sala encontrada.</p>
    <?php else: ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome da Sala</th>
                    <th>Mestre de mesa</th>
                    <th>Quantidade minima de jogadores</th>
                    <th>Quantidade maxima de jogadores</th>
                    <th>Data</th>
                    <th>Hora de inicio</th>
                    <th>Hora de fim</th>
                    <th>Modalidade</th>
                    <th>Descricao</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($dados['salas'] as $sala): ?>
                    <tr>
                        <td><?= htmlspecialchars($sala->getId()) ?></td>
                        <td><?= htmlspecialchars($sala->getNomeSala()) ?></td>
                        <td><?= htmlspecialchars($sala->getNomeSala()) ?></td>
                        <td><?= htmlspecialchars($sala->getQuantMinJogadores()) ?></td>
                        <td><?= htmlspecialchars($sala->getQuantMaxJogadores()) ?></td>
                        <td><?= htmlspecialchars($sala->getData()) ?></td>
                        <td><?= htmlspecialchars($sala->getHoraInicio()) ?></td>
                        <td><?= htmlspecialchars($sala->getHoraFim()) ?></td>
                        <td><?= htmlspecialchars($sala->getNomeSala()) ?></td>
                        <td><?= htmlspecialchars($sala->getDescricao()) ?></td>
                        <td><?= htmlspecialchars($sala->getStatus()) ?></td>
                        <td>
                            <a href="index.php?controller=sala&action=edit&id=<?= $sala->getId() ?>" class="btn btn-sm btn-warning">Editar</a>
                            <a href="index.php?controller=sala&action=delete&id=<?= $sala->getId() ?>" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja excluir esta sala?');">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<?php require_once(__DIR__ . "/../include/footer.php"); ?>