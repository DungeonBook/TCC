<?php

require_once(__DIR__ . "/../model/Usuario.php");

class UsuarioService
{
    /**
     * Valida e cria uma Sala a partir dos dados recebidos do formulário ou de uma requisição
     * @param array $dados
     * @return UsuarioService
     * @throws Exception se algum dado estiver inválido
     */
    /* Método para validar os dados do usuário que vem do formulário */
    public function validarDados(Usuario $usuario, ?string $confSenha)
    {
        $erros = array();

        //Validar campos vazios

        if (! $usuario->getNome())
            array_push($erros, "O campo [Nome] é obrigatório.");

        if (! $usuario->getApelido())
            array_push($erros, "O campo [Apelido] é obrigatório.");

        if (! $usuario->getEmail())
            array_push($erros, "O campo [Email] é obrigatório.");

        if (! $usuario->getTelefone())
            array_push($erros, "O campo [Celular] é obrigatório.");

        if (! $usuario->getDataNascimento())
            array_push($erros, "O campo [Data de Nascimento] é obrigatório.");

        if (! $usuario->getSenha())
            array_push($erros, "O campo [Senha] é obrigatório.");

        if (! $usuario->getSenha() !== null && $usuario->getSenha() <= 6)
            array_push($erros, "A quantidade mínima de caracteres da senha é 6.");

        if (! $confSenha)
            array_push($erros, "O campo [Confirmação da Senha] é obrigatório.");

        if (! $usuario->getPapel())
            array_push($erros, "O campo [Papel] é obrigatório");

        //Validar se a senha é igual a contra senha
        if ($usuario->getSenha() && $confSenha && $usuario->getSenha() != $confSenha)
            array_push($erros, "O campo Senha deve ser igual ao Confirmação da senha.");

        return $erros;
    }

    /* Método para validar os dados do usuário que vem do formulário */
    public function validarAutoCadastro(Usuario $usuario, ?string $confSenha)
    {
        $erros = array();

        //Validar campos vazios

        if (! $usuario->getNome())
            array_push($erros, "O campo [Nome] é obrigatório.");

        if (! $usuario->getApelido())
            array_push($erros, "O campo [Apelido] é obrigatório.");

        if (! $usuario->getEmail())
            array_push($erros, "O campo [Email] é obrigatório.");

        if (! $usuario->getTelefone())
            array_push($erros, "O campo [Celular] é obrigatório.");

        if (! $usuario->getDataNascimento())
            array_push($erros, "O campo [Data de Nascimento] é obrigatório.");

        if (! $usuario->getSenha())
            array_push($erros, "O campo [Senha] é obrigatório.");
       
        if (! $usuario->getSenha() !== null && $usuario->getSenha() <= 6)
            array_push($erros, "A quantidade mínima de caracteres da senha é 6.");
       
        if (! $confSenha)
            array_push($erros, "O campo [Confirmação da Senha] é obrigatório.");

        //Validar se a senha é igual a contra senha
        if ($usuario->getSenha() && $confSenha && $usuario->getSenha() != $confSenha)
            array_push($erros, "O campo Senha deve ser igual ao Confirmação da senha.");

        return $erros;
    }


    /* Método para validar se o usuário selecionou uma foto de perfil */
    public function validarFotoPerfil(array $foto)
    {
        $erros = array();

        if ($foto['size'] <= 0)
            array_push($erros, "Informe a foto para o perfil!");

        return $erros;
    }
}
