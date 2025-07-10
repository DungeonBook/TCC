<?php require_once(__DIR__ . "/../include/header.php"); ?>

<div class="container mt-4">
    <h2>Minhas Salas</h2>

    <?php if (!empty($msgErro)): ?>
        <div class="alert alert-danger"><?= $msgErro ?></div>
    <?php endif; ?>

    <?php if (!empty($msgSucesso)): ?>
        <div class="alert alert-success"><?= $msgSucesso ?></div>
    <?php endif; ?>

    <a href="index.php?controller=sala&action=create" class="btn btn-primary mb-3">Nova Sala</a>

    <?php if (empty($dados['lista'])): ?>
        <p>Nenhuma sala encontrada.</p>
    <?php else: ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($dados['lista'] as $sala): ?>
                    <tr>
                        <td><?= htmlspecialchars($sala->getId()) ?></td>
                        <td><?= htmlspecialchars($sala->getNome()) ?></td>
                        <td><?= htmlspecialchars($sala->getDescricao()) ?></td>
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
