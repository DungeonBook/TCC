<?php
require_once(__DIR__ . "/../include/Header.php");
require_once(__DIR__ . "/../include/Menu.php");
?>

<!-- link de CSS da incerção de um novo usuário -->
<link href="https://fonts.googleapis.com/css2?family=MedievalSharp&family=Caudex&family=Almendra&family=Almendra+SC&family=Fondamento&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?= BASEURL ?>/view/css/UsuForm.css">

<div class="container">
    <h3>Editar Usuário</h3>
    
        <?php if ($dados['id'] == 0) echo ""?>


    <form id="frmUsuario" method="POST"
        action="<?= BASEURL ?>/controller/UsuarioController.php?action=save">

        <div class="form-grid">

            <div class="form-group">
                <label for="txtNome">Nome:</label>
                <input type="text" id="txtNome" name="nome" maxlength="100"
                    placeholder="Informe o nome"
                    value="<?= isset($dados["usuario"]) ? $dados["usuario"]->getNome() : '' ?>" />
            </div>

            <div class="form-group">
                <label for="txtApelido">Apelido:</label>
                <input type="text" id="txtApelido" name="apelido" maxlength="50"
                    placeholder="Informe o seu apelido"
                    value="<?= isset($dados["usuario"]) ? $dados["usuario"]->getApelido() : '' ?>" />
            </div>

            <div class="form-group">
                <label for="txtLogin">Email:</label>
                <input type="text" id="txtLogin" name="email" maxlength="100"
                    placeholder="Informe o email"
                    value="<?= isset($dados["usuario"]) ? $dados["usuario"]->getEmail() : '' ?>" />
            </div>

            <div class="form-group">
                <label for="txtTelefone">Celular:</label>
                <input type="text" id="txtTelefone" name="telefone" maxlength="20"
                    placeholder="Informe o seu celular"
                    value="<?= isset($dados["usuario"]) ? $dados["usuario"]->getTelefone() : '' ?>" />
            </div>

            <div class="form-group">
                <label for="txtDataNascimento">Data de Nascimento:</label>
                <input type="date" id="txtDataNascimento" name="data_nascimento"
                    value="<?= isset($dados["usuario"]) ? $dados["usuario"]->getDataNascimento() : '' ?>" />
            </div>

            <div class="form-group">
                <label for="txtSenha">Senha:</label>
                <input type="password" id="txtPassword" name="senha" maxlength="50"
                    placeholder="Informe a senha"
                    value="<?= isset($dados["usuario"]) ? $dados["usuario"]->getSenha() : '' ?>" />
            </div>

            <div class="form-group">
                <label for="txtConfSenha">Confirmação da senha:</label>
                <input type="password" id="txtConfSenha" name="conf_senha" maxlength="50"
                    placeholder="Informe a confirmação da senha"
                    value="<?= isset($dados['confSenha']) ? $dados['confSenha'] : '' ?>" />
            </div>

            <div class="form-group">
                <label for="selPapel">Papel:</label>
                <select name="papel" id="selPapel">
                    <option value="">Selecione o papel</option>
                    <?php foreach ($dados["papeis"] as $papel): ?>
                        <option value="<?= $papel ?>"
                            <?= (isset($dados["usuario"]) && $dados["usuario"]->getPapel() == $papel) ? "selected" : "" ?>>
                            <?= $papel ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

        </div>

        <input type="hidden" id="hddId" name="id" value="<?= $dados['id']; ?>" />

        <div class="actions">
            <a class="btn" href="<?= BASEURL ?>/controller/UsuarioController.php?action=list">Voltar</a>
            <button type="submit" class="btn">Salvar</button>
        </div>

    </form>

    <!-- Mensagens do sistema -->
    <div style="margin-top:20px;">
        <?php include_once(__DIR__ . "/../include/Msg.php"); ?>
    </div>
</div>

<?php
require_once(__DIR__ . "/../include/Footer.php");
?>