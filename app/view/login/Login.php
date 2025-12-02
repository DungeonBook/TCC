<?php
require_once(__DIR__ . "/../include/Header.php");
?>

<!-- link de CSS do login -->
<link rel="stylesheet" href="<?= BASEURL ?>/view/css/bootstrap.min.css">
<link rel="stylesheet" href="<?= BASEURL ?>/view/css/Login.css">

<div class="container">

    <h3>Login</h3>

    <!-- Formulário de login -->
    <form id="frmLogin" action="./LoginController.php?action=logon" method="POST">
        <div class="mb-3">
            <input type="text" name="email" id="txtLogin" maxlength="50"
                placeholder="E-mail ou Usuário"
                value="<?php echo isset($dados['email']) ? $dados['email'] : '' ?>" />
        </div>

        <div class="mb-3" style="position: relative;">
            <input type="password"
                name="senha"
                id="txtSenha"
                maxlength="50"
                placeholder="Senha"
                value="<?php echo isset($dados['senha']) ? $dados['senha'] : '' ?>"
                style="padding-right: 40px;" />

            <img id="toggleSenha"
                src="<?= BASEURL ?>/view/img/Visualizar.png"
                alt="Mostrar senha"
                style="
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            width: 20px;
            height: 20px;
            cursor: pointer;
            user-select: none;
         ">
        </div>

        <script>
            const inputSenha = document.getElementById('txtSenha');
            const toggle = document.getElementById('toggleSenha');

            toggle.addEventListener('click', function() {
                const passwordVisible = inputSenha.type === "text";

                if (passwordVisible) {
                    inputSenha.type = "password";
                    toggle.src = "<?= BASEURL ?>/view/img/Visualizar.png";
                } else {
                    inputSenha.type = "text";
                    toggle.src = "<?= BASEURL ?>/view/img/NaoVisualizar.png";
                }
            });
        </script>

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