<?php
require_once(__DIR__ . "/../util/Config.php");

class Controller
{

    protected function handleAction()
    {

        $action = NULL;

        if (isset($_GET['action']))
            $action = $_GET['action'];

        $this->callAction($action);
    }

    protected function callAction($methodName)
    {

        if ($methodName && method_exists($this, $methodName))
            $this->$methodName();

        else {
            echo "Ação não encontrada no controller.<br>";
            echo "Verifique com o administrador do sistema.";
        }
    }

    protected function loadView(string $path, array $dados, string $msgErro = "", string $msgSucesso = "")
{
    foreach ($dados as $chave => $valor) {
        $$chave = $valor;
    }

    $msgErro = $msgErro;
    $msgSucesso = $msgSucesso;

    $caminho = __DIR__ . "/../view/" . $path;

    if (file_exists($caminho)) {
        require $caminho;
    } else {
        echo "Erro ao carregar a view solicitada<br>";
        echo "Caminho: " . $caminho;
    }
}

    protected function usuarioEstaLogado()
    {
        if (session_status() != PHP_SESSION_ACTIVE)
            session_start();

        if (! isset($_SESSION[SESSAO_USUARIO_ID])) {
            header("location: " . LOGIN_PAGE);
            return false;
        }

        return true;
    }

    protected function getIdUsuarioLogado()
    {
        if (session_status() != PHP_SESSION_ACTIVE)
            session_start();

        if (isset($_SESSION[SESSAO_USUARIO_ID]))
            return $_SESSION[SESSAO_USUARIO_ID];

        return 0;
    }

    protected function isUsuarioAdmin()
    {
        if (session_status() != PHP_SESSION_ACTIVE)
            session_start();

        if (isset($_SESSION[SESSAO_USUARIO_PAPEL]))
            return $_SESSION[SESSAO_USUARIO_PAPEL] == UsuarioPapel::ADMINISTRADOR;

        return false;
    }
}
