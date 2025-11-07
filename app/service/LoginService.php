<?php

require_once(__DIR__ . "/../model/Usuario.php");

class LoginService {

    public function validarCampos(?string $login, ?string $senha) {
        $arrayMsg = array();

        if(! $login)
            array_push($arrayMsg, "O campo [Email] é obrigatório.");

        if(! $senha)
            array_push($arrayMsg, "O campo [Senha] é obrigatório.");

        return $arrayMsg;
    }

    public function salvarUsuarioSessao(Usuario $usuario) {
        session_start();

        $_SESSION[SESSAO_USUARIO_ID]   = $usuario->getId();
        $_SESSION[SESSAO_USUARIO_NOME] = $usuario->getNome();
        $_SESSION[SESSAO_USUARIO_PAPEL] = $usuario->getPapel();
    }

    public function removerUsuarioSessao() {
        session_start();

        session_destroy();
    }

}