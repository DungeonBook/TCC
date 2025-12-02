<?php
require_once(__DIR__ . "/../include/Header.php");
require_once(__DIR__ . "/../include/Menu.php");
?>
<!-- link de CSS da edição do perfil -->
<link rel="stylesheet" href="<?= BASEURL ?>/view/css/bootstrap.min.css">
<link rel="stylesheet" href="<?= BASEURL ?>/view/css/UsuForm.css">

<div class="container">

    <h3>
        <?php if ($dados['id'] == 0) echo "";
        else echo "Editar Perfil"; ?>
    </h3>

    <form id="frmUsuario" method="POST"
        action="<?= BASEURL ?>/controller/PerfilController.php?action=saveEditPerfil"
        enctype="multipart/form-data">

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


            <div class="form-group">
                <label for="fileFoto">Foto:</label>

                <input type="file" id="fileFoto" name="foto" accept="image/*" hidden>
                <label for="fileFoto" class="file-input-simples">Nova Foto</label>

                <input type="hidden" name="foto_atual" value="<?= isset($dados["usuario"]) ? $dados["usuario"]->getFoto() : '' ?>">
            </div>

        </div>

        <div class="actions">
            <a class="btn" href="<?= BASEURL ?>/controller/PerfilController.php?action=view">Voltar</a>
            <button type="submit" class="btn">Salvar</button>
        </div>

        <script>
            (function() {
                const input = document.getElementById('fileFoto');
                const fileNameSpan = document.getElementById('file-name');
                const preview = document.getElementById('preview');

                input.addEventListener('change', function(e) {
                    const file = e.target.files[0];
                    if (file) {
                        fileNameSpan.textContent = file.name;

                        // preview
                        const reader = new FileReader();
                        reader.onload = function(evt) {
                            preview.src = evt.target.result;
                            preview.style.display = 'inline-block';
                        }
                        reader.readAsDataURL(file);
                    } else {
                        fileNameSpan.textContent = 'Nenhum arquivo escolhido';
                        preview.src = '';
                        preview.style.display = 'none';
                    }
                });
            })();
        </script>

        <script>
            document.getElementById('fileFoto').addEventListener('change', function(e) {
                const file = e.target.files[0];
                const fileNameSpan = document.getElementById('file-name');
                const preview = document.getElementById('preview');

                if (file) {
                    fileNameSpan.textContent = file.name;

                    const reader = new FileReader();
                    reader.onload = function(evt) {
                        preview.src = evt.target.result;
                        preview.style.display = 'inline-block';
                    };
                    reader.readAsDataURL(file);
                } else {
                    fileNameSpan.textContent = 'Nenhum arquivo escolhido';
                    preview.src = '';
                    preview.style.display = 'none';
                }
            });
        </script>


    </form>

    <!-- Mensagens do sistema -->
    <div style="margin-top:20px;">
        <?php include_once(__DIR__ . "/../include/Msg.php"); ?>
    </div>
</div>

<?php
require_once(__DIR__ . "/../include/Footer.php");
?>