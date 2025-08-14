<?php
#Nome do arquivo: login/login.php
#Objetivo: interface para logar no sistema

require_once(__DIR__ . "/../include/header.php");
?>
<!-- link rel="stylesheet" href="<?= BASEURL ?>/view/css/login.css" -->

<div class="container">
    <div class="row" style="margin-top: 20px;">
        <div class="col-6">
            <div class="alert alert-info">
                <h4>Informe os dados para logar:</h4>
                
                <br>

                <!-- Formulário de login -->
                <form id="frmLogin" action="./LoginController.php?action=logon" method="POST">
                    <div class="mb-3">
                        <label class="form-label" for="txtLogin">E-mail:</label>
                        <input type="text" class="form-control" name="email" id="txtLogin"
                            maxlength="50" placeholder="Informe o email"
                            value="<?php echo isset($dados['email']) ? $dados['email'] : '' ?>" />
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="txtSenha">Senha:</label>
                        <input type="password" class="form-control" name="senha" id="txtSenha"
                            maxlength="50" placeholder="Informe a senha"
                            value="<?php echo isset($dados['senha']) ? $dados['senha'] : '' ?>" />
                    </div>

                    <button type="submit" class="btn btn-success mt-3">Logar</button>
                </form>
            </div>

            <div>
                <a href="./UsuarioController.php?action=autoCadastro">Não possui conta? Clique aqui</a>

            </div>
        </div>

        <div class="col-6">
            <?php include_once(__DIR__ . "/../include/msg.php") ?>
        </div>
    </div>
</div>

<?php
require_once(__DIR__ . "/../include/footer.php");
?>