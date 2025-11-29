<?php
require_once(__DIR__ . "/Controller.php");
require_once(__DIR__ . "/../dao/UsuarioDAO.php");
require_once(__DIR__ . "/../service/LoginService.php");
require_once(__DIR__ . "/../model/Usuario.php");


class LoginController extends Controller
{

    private LoginService $loginService;
    private UsuarioDAO $usuarioDao;

    public function __construct()
    {
        $this->loginService = new LoginService();
        $this->usuarioDao = new UsuarioDAO();

        $this->handleAction();
    }

    protected function login()
    {
        $this->loadView("login/Login.php", []);
    }

    protected function logon()
    {
        $email = isset($_POST['email']) ? trim($_POST['email']) : null;
        $senha = isset($_POST['senha']) ? trim($_POST['senha']) : null;

        $erros = $this->loginService->validarCampos($email, $senha);
        if (empty($erros)) {
            $usuario = $this->usuarioDao->findByEmailSenha($email, $senha);
            if ($usuario) {
                $this->loginService->salvarUsuarioSessao($usuario);

                header("location: " . HOME_PAGE);
                exit;
            } else {
                $erros = ["Email ou senha informados são inválidos!"];
            }
        }

        $msg = implode("<br>", $erros);
        $dados["email"] = $email;
        $dados["senha"] = $senha;

        $this->loadView("login/Login.php", $dados, $msg);
    }

    protected function logout()
    {
        $this->loginService->removerUsuarioSessao();

        $this->loadView("login/Login.php", [], "", "Usuário deslogado com sucesso!");
    }

    public function deleteSelf()
{
    if (!isset($_SESSION[SESSAO_USUARIO_ID])) {
        $this->loadView("login/Login.php", [], "", "Sessão expirada!");
        return;
    }

    $id = $_SESSION[SESSAO_USUARIO_ID];

    require_once(__DIR__ . "/../dao/UsuarioDAO.php");
    $dao = new UsuarioDAO();
    $dao->deleteById($id);

    $this->loginService->removerUsuarioSessao();

    $this->loadView("login/Login.php", [], "", "Conta excluída!");
}

}

new LoginController();
