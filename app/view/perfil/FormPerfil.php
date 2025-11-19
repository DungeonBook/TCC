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