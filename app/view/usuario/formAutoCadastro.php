<?php 
require_once(__DIR__ . "/../include/header.php");

?>
<!-- Fonte medieval + CSS -->
<link href="https://fonts.googleapis.com/css2?family=MedievalSharp&family=Caudex&family=Almendra&family=Almendra+SC&family=Fondamento&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?= BASEURL ?>/view/css/login.css">

<div class="container">
    <h1>Cadastro</h1>

    <form id="frmCadastro" action="./UsuarioController.php?action=salvarAutoCadastro" method="POST">
        <div class="mb-3">
            <input type="text" name="nome" id="txtNome" maxlength="100"
                placeholder="Nome completo" 
                value="<?php echo isset($dados['nome']) ? $dados['nome'] : '' ?>" required />
        </div>

        <div class="mb-3">
            <input type="email" name="email" id="txtEmail" maxlength="50"
                placeholder="E-mail"
                value="<?php echo isset($dados['email']) ? $dados['email'] : '' ?>" required />
        </div>

        <div class="mb-3">
            <input type="text" name="telefone" id="txtTelefone" maxlength="15"
                placeholder="Telefone"
                value="<?php echo isset($dados['telefone']) ? $dados['telefone'] : '' ?>" required />
        </div>

        <div class="mb-3">
            <input type="date" name="dataNascimento" id="txtDataNascimento"
                value="<?php echo isset($dados['dataNascimento']) ? $dados['dataNascimento'] : '' ?>" required />
        </div>

        <div class="mb-3">
            <input type="password" name="senha" id="txtSenha" maxlength="50"
                placeholder="Senha" required />
        </div>

        <button type="submit">Cadastrar</button>
    </form>

    <a href="./LoginController.php?action=login">Já possui conta? Faça login</a>

    <!-- Mensagens do sistema -->
    <div style="margin-top:20px;">
        <?php include_once(__DIR__ . "/../include/msg.php") ?>
    </div>
</div>

<?php
require_once(__DIR__ . "/../include/footer.php");
?>
