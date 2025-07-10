<?php require_once(__DIR__ . "/../include/header.php"); ?>

<div class="container mt-4">
    <h2><?= isset($dados['id']) && $dados['id'] > 0 ? 'Editar Sala' : 'Criar Nova Sala' ?></h2>

    <?php if (!empty($msgErro)): ?>
        <div class="alert alert-danger"><?= $msgErro ?></div>
    <?php endif; ?>

    <form action="index.php?controller=sala&action=save" method="POST">

        <input type="hidden" name="id" value="<?= $dados['id'] ?? 0 ?>">

        <div class="form-group mb-3">
            <label for="nome">Nome da sala</label>
            <input type="text" name="nome" id="nome" class="form-control" 
                   value="<?= htmlspecialchars($dados['nome'] ?? '') ?>" required>
        </div>

        <div class="form-group mb-3">
            <label for="descricao">Descrição</label>
            <textarea name="descricao" id="descricao" class="form-control" rows="3"><?= htmlspecialchars($dados['descricao'] ?? '') ?></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Salvar</button>
        <a href="index.php?controller=sala&action=list" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

<?php require_once(__DIR__ . "/../include/footer.php"); ?>
