<?php
require_once(__DIR__ . "/../include/Header.php");
?>

<!-- link de CSS do login -->
<link href="https://fonts.googleapis.com/css2?family=MedievalSharp&family=Caudex&family=Almendra&family=Almendra+SC&family=Fondamento&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?= BASEURL ?>/view/css/Login.css">

<div class="container">

    <h3>Login</h3>

    <!-- Formulário de login -->
    <form id="frmLogin" action="./LoginController.php?action=logon" method="POST">
        <div class="mb-3">
            <input type="text" name="email" id="txtLogin" maxlength="50"
                placeholder="E-mail ou Usuário"
                value="<?php echo isset($dados['email']) ? $dados['email'] : '' ?>"  />
        </div>

        <div class="mb-3">
            <input type="password" name="senha" id="txtSenha" maxlength="50"
                placeholder="Senha"
                value="<?php echo isset($dados['senha']) ? $dados['senha'] : '' ?>"  />
        </div>

        <button type="submit">Entrar</button>
    </form>

    <a href="./UsuarioController.php?action=autoCadastro">Não tem conta? Cadastre-se</a>

    <!-- Mensagens do sistema -->
    <div style="margin-top:20px;">
        <?php include_once(__DIR__ . "/../include/Msg.php") ?>
    </div>
</div>

<?php
require_once(__DIR__ . "/../include/Footer.php");
?>