<?php
#Nome do arquivo: usuario/list.php
#Objetivo: interface para listagem dos usuários do sistema

require_once(__DIR__ . "/../include/header.php");
require_once(__DIR__ . "/../include/menu.php");
?>

<h3 class="text-center">
    <?php if($dados['id'] == 0) echo "Inserir"; else echo "Alterar"; ?> 
    Usuário
</h3>

<div class="container">
    
    <div class="row" style="margin-top: 10px;">
        
        <div class="col-6">
            <form id="frmUsuario" method="POST" 
                action="<?= BASEURL ?>/controller/UsuarioController.php?action=saveAutoCadastro" >
                <div class="mb-3">
                    <label class="form-label" for="txtNome">Nome:</label>
                    <input class="form-control" type="text" id="txtNome" name="nome" 
                        maxlength="100" placeholder="Informe o nome"
                        value="<?php echo (isset($dados["usuario"]) ? $dados["usuario"]->getNome() : ''); ?>" />
                </div>

                <div class="mb-3">
                    <label class="form-label" for="txtApelido">Apelido:</label>
                    <input class="form-control" type="text" id="txtApelido" name="apelido" 
                        maxlength="50" placeholder="Informe o seu apelido"
                        value="<?php echo (isset($dados["usuario"]) ? $dados["usuario"]->getApelido() : ''); ?>" />
                </div>

                <div class="mb-3">
                    <label class="form-label" for="txtLogin">Email:</label>
                    <input class="form-control" type="text" id="txtLogin" name="email" 
                        maxlength="100" placeholder="Informe o email"
                        value="<?php echo (isset($dados["usuario"]) ? $dados["usuario"]->getEmail() : ''); ?>"/>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="txtTelefone">Celular:</label>
                    <input class="form-control" type="text" id="txtTelefone" name="telefone" 
                        maxlength="20" placeholder="Informe o seu celular"
                        value="<?php echo (isset($dados["usuario"]) ? $dados["usuario"]->getTelefone() : ''); ?>"/>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="txtDataNascimento">Data de Nascimento:</label>
                    <input class="form-control" type="date" id="txtDataNascimento" name="data_nascimento" 
                        maxlength="50" placeholder="Informe a sua data de nascimento"
                        value="<?php echo (isset($dados["usuario"]) ? $dados["usuario"]->getDataNascimento() : ''); ?>"/>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="txtSenha">Senha:</label>
                    <input class="form-control" type="password" id="txtPassword" name="senha" 
                        maxlength="50" placeholder="Informe a senha"
                        value="<?php echo (isset($dados["usuario"]) ? $dados["usuario"]->getSenha() : ''); ?>"/>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="txtConfSenha">Confirmação da senha:</label>
                    <input class="form-control" type="password" id="txtConfSenha" name="conf_senha" 
                        maxlength="50" placeholder="Informe a confirmação da senha"
                        value="<?php echo isset($dados['confSenha']) ? $dados['confSenha'] : '';?>"/>
                </div>

                <input type="hidden" id="hddId" name="id" 
                    value="<?= $dados['id']; ?>" />

                <div class="mt-3">
                    <button type="submit" class="btn btn-success">Continuar</button>
                </div>
            </form>            
        </div>

        <div class="col-6">
            <?php require_once(__DIR__ . "/../include/msg.php"); ?>
        </div>
    </div>

    <div class="row" style="margin-top: 30px;">
        <div class="col-12">
        <a class="btn btn-secondary" 
                href="<?= BASEURL ?>/controller/UsuarioController.php?action=list">Voltar</a>
        </div>
    </div>
</div>

<?php  
require_once(__DIR__ . "/../include/footer.php");
?>