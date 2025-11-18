<?php

require_once(__DIR__ . "/../model/Usuario.php");
require_once(__DIR__ . "/../dao/UsuarioDAO.php");

class UsuarioService
{

    private UsuarioDAO $usuarioDAO;

    public function __construct() {
        $this->usuarioDAO = new UsuarioDAO();
    }

    /**
     * Valida e cria uma Sala a partir dos dados recebidos do formulário ou de uma requisição
     * @param array $dados
     * @return UsuarioService
     * @throws Exception se algum dado estiver inválido
     */
    /* Método para validar os dados do usuário que vem do formulário */
    public function validarDados(Usuario $usuario, ?string $confSenha, bool $validarPapel = true)
    {
        $erros = array();

        if (! $usuario->getNome())
            array_push($erros, "O campo [Nome] é obrigatório.");

        if (! $usuario->getApelido())
            array_push($erros, "O campo [Apelido] é obrigatório.");

        if (! $usuario->getEmail())
            array_push($erros, "O campo [Email] é obrigatório.");
        else if(! filter_var($usuario->getEmail(), FILTER_VALIDATE_EMAIL))
            array_push($erros, "O campo [Email] deve possuir o formato [jogador@dungeonbook.com].");

        if (! $usuario->getTelefone())
            array_push($erros, "O campo [Celular] é obrigatório.");

        if (! $usuario->getDataNascimento())
            array_push($erros, "O campo [Data de Nascimento] é obrigatório.");

        if (! $usuario->getSenha())
            array_push($erros, "O campo [Senha] é obrigatório.");

        if ($usuario->getSenha() !== null && strlen($usuario->getSenha()) < 6)
            array_push($erros, "A quantidade mínima de caracteres da senha é 6.");

        if (! $confSenha)
            array_push($erros, "O campo [Confirmação da Senha] é obrigatório.");

        if ($validarPapel && (! $usuario->getPapel()))
            array_push($erros, "O campo [Papel] é obrigatório");

        if ($usuario->getSenha() && $confSenha && $usuario->getSenha() != $confSenha)
            array_push($erros, "O campo [Confirmação da senha] deve ser igual ao campo [Senha].");

        return $erros;
    }

    public function validarAutoCadastro(Usuario $usuario, ?string $confSenha)
    {
        $erros = array();

        if (! $usuario->getNome())
            array_push($erros, "O campo [Nome] é obrigatório.");

        if (! $usuario->getApelido())
            array_push($erros, "O campo [Apelido] é obrigatório.");

        if (! $usuario->getEmail())
            array_push($erros, "O campo [Email] é obrigatório.");
        else if(! filter_var($usuario->getEmail(), FILTER_VALIDATE_EMAIL))
            array_push($erros, "O campo [Email] deve possuir o formato [jogador@dungeonbook.com].");
        else {
            $usuarioTeste = $this->usuarioDAO->findByEmail($usuario->getEmail());
            if($usuarioTeste != null)
                array_push($erros, "O [Email] informado já está sendo utilizado.");
        }

        if (! $usuario->getTelefone())
            array_push($erros, "O campo [Celular] é obrigatório.");

        if (! $usuario->getDataNascimento())
            array_push($erros, "O campo [Data de Nascimento] é obrigatório.");

        if (! $usuario->getSenha())
            array_push($erros, "O campo [Senha] é obrigatório.");
       
        if ($usuario->getSenha() !== null && strlen($usuario->getSenha()) < 6)
            array_push($erros, "A quantidade mínima de caracteres da senha é 6.");
       
        if (! $confSenha)
            array_push($erros, "O campo [Confirmação da Senha] é obrigatório.");

        if ($usuario->getSenha() && $confSenha && $usuario->getSenha() != $confSenha)
            array_push($erros, "O campo [Confirmação da senha] deve ser igual ao campo [Senha].");

        return $erros;
    }

    public function validarFotoPerfil(array $foto)
    {
        $erros = array();

        if ($foto['size'] <= 0)
            array_push($erros, "Informe a foto do perfil!");

        return $erros;
    }
}
