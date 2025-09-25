<?php
require_once(__DIR__ . "/../include/header.php");
?>
<!-- link de CSS do autocadastro -->
<link href="https://fonts.googleapis.com/css2?family=MedievalSharp&family=Caudex&family=Almendra&family=Almendra+SC&family=Fondamento&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?= BASEURL ?>/view/css/usu-autocadastro.css">

<div class="container">
    <h3>Cadastro</h3>

    <form id="frmCadastro" action="./UsuarioController.php?action=saveAutoCadastro" method="POST">
        <div class="form-grid">
            <div class="form-group">
                <label for="txtNome">Nome:</label>
                <input type="text" name="nome" id="txtNome" maxlength="50" placeholder="Nome"
                       value="<?php echo isset($dados['nome']) ? htmlspecialchars($dados['nome']) : ''; ?>"  />
            </div>

            <div class="form-group">
                <label for="txtApelido">Apelido:</label>
                <input type="text" name="apelido" id="txtApelido" maxlength="50" placeholder="Apelido"
                       value="<?php echo isset($dados['apelido']) ? htmlspecialchars($dados['apelido']) : ''; ?>"  />
            </div>

            <div class="form-group">
                <label for="txtEmail">E-mail:</label>
                <input type="email" name="email" id="txtEmail" maxlength="50" placeholder="E-mail"
                       value="<?php echo isset($dados['email']) ? htmlspecialchars($dados['email']) : ''; ?>"  />
            </div>

            <div class="form-group">
                <label for="txtTelefone">Celular:</label>
                <input type="text" name="telefone" id="txtTelefone" maxlength="15" placeholder="Celular"
                       value="<?php echo isset($dados['telefone']) ? htmlspecialchars($dados['telefone']) : ''; ?>"  />
            </div>

            <div class="form-group">
                <label for="txtDataNascimento">Data de Nascimento:</label>
                <input type="date" name="data_nascimento" id="txtDataNascimento"
                       value="<?php
                           echo isset($dados['data_nascimento']) ? htmlspecialchars($dados['data_nascimento'])
                                : (isset($dados['dataNascimento']) ? htmlspecialchars($dados['dataNascimento']) : '');
                       ?>"  />
            </div>

            <div class="form-group">
                <label for="txtSenha">Senha:</label>
                <input type="password" name="senha" id="txtSenha" maxlength="50" placeholder="Senha"  />
            </div>

            <div class="form-group" >
                <label for="txtConfSenha">Confirme a Senha:</label>
                <input type="password" name="conf_senha" id="txtConfSenha" maxlength="50" placeholder="Confirme a Senha"  />
            </div>
        </div>

        <div class="actions" style="margin-top: 24px;">
            <button type="submit" class="btn">Cadastrar</button>
            <a href="./LoginController.php?action=login" style="align-self:center; margin-left:12px;">Já possui conta? Faça login</a>
        </div>
    </form>

    <!-- Mensagens do sistema -->
    <div style="margin-top:20px;">
        <?php include_once(__DIR__ . "/../include/msg.php"); ?>
    </div>
</div>

<?php
require_once(__DIR__ . "/../include/footer.php");
?>
