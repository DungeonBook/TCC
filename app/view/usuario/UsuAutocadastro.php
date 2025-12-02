<?php
require_once(__DIR__ . "/../include/Header.php");
?>
<!-- link de CSS do autocadastro -->
<link rel="stylesheet" href="<?= BASEURL ?>/view/css/bootstrap.min.css">
<link rel="stylesheet" href="<?= BASEURL ?>/view/css/UsuAutocadastro.css">

<div class="container">
    <h3>Cadastro</h3>

    <form id="frmCadastro" action="./UsuarioController.php?action=saveAutoCadastro" method="POST">
        <div class="form-grid">
            <div class="form-group">
                <label for="txtNome">Nome:</label>
                <input type="text" name="nome" id="txtNome" maxlength="50" placeholder="Nome"
                    value="<?php echo isset($dados['usuario']) ? $dados['usuario']->getNome() : ''; ?>" />
            </div>

            <div class="form-group">
                <label for="txtApelido">Apelido:</label>
                <input type="text" name="apelido" id="txtApelido" maxlength="50" placeholder="Apelido"
                    value="<?php echo isset($dados['usuario']) ? $dados['usuario']->getApelido() : ''; ?>" />
            </div>

            <div class="form-group">
                <label for="txtEmail">E-mail:</label>
                <input type="text" name="email" id="txtEmail" maxlength="50" placeholder="E-mail"
                    value="<?php echo isset($dados['usuario']) ? $dados['usuario']->getEmail() : ''; ?>" />
            </div>

            <div class="form-group">
                <label for="txtTelefone">Celular:</label>
                <input type="text" name="telefone" id="txtTelefone" maxlength="15" placeholder="Celular"
                    value="<?php echo isset($dados['usuario']) ? $dados['usuario']->getTelefone() : ''; ?>" />
            </div>
            <div class="form-group">
                <label for="txtDataNascimento">Data de Nascimento:</label>
                <input type="date"
                    name="data_nascimento"
                    id="txtDataNascimento"
                    value="<?= isset($dados['usuario']) ? $dados['usuario']->getDataNascimento() : '' ?>" />
            </div>

            <div class="form-group">
                <label for="txtPassword">Senha:</label>

                <div style="position: relative;">
                    <input type="password"
                        id="txtPassword"
                        name="senha"
                        maxlength="50"
                        placeholder="Informe a senha"
                        value="<?= isset($dados["usuario"]) ? $dados["usuario"]->getSenha() : '' ?>"
                        style="padding-right: 40px;" />

                    <img id="toggleSenha1"
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
            </div>



            <div class="form-group">
                <label for="txtConfSenha">Confirmação da senha:</label>

                <div style="position: relative;">
                    <input type="password"
                        id="txtConfSenha"
                        name="conf_senha"
                        maxlength="50"
                        placeholder="Informe a confirmação da senha"
                        value="<?= isset($dados['confSenha']) ? $dados['confSenha'] : '' ?>"
                        style="padding-right: 40px;" />

                    <img id="toggleSenha2"
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
            </div>

            <script>
                function configurarToggle(idInput, idIcone) {
                    const input = document.getElementById(idInput);
                    const icone = document.getElementById(idIcone);

                    icone.addEventListener('click', function() {
                        const isPassword = input.type === "password";

                        input.type = isPassword ? "text" : "password";
                        icone.src = isPassword ?
                            "<?= BASEURL ?>/view/img/NaoVisualizar.png" :
                            "<?= BASEURL ?>/view/img/Visualizar.png";
                    });
                }

                configurarToggle("txtPassword", "toggleSenha1");
                configurarToggle("txtConfSenha", "toggleSenha2");
            </script>
        </div>

        <div class="actions" style="margin-top: 24px;">
            <a href="./LoginController.php?action=login" style="align-self:center; margin-left:12px;">Já possui conta? Faça login</a>
            <button type="submit" class="btn">Cadastre-se</button>
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