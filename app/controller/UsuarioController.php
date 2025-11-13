<?php
require_once(__DIR__ . "/Controller.php");
require_once(__DIR__ . "/../dao/UsuarioDAO.php");
require_once(__DIR__ . "/../service/UsuarioService.php");
require_once(__DIR__ . "/../model/Usuario.php");
require_once(__DIR__ . "/../model/enum/UsuarioPapel.php");

class UsuarioController extends Controller
{

    private UsuarioDAO $usuarioDao;
    private UsuarioService $usuarioService;

    public function __construct()
    {
        $this->usuarioDao = new UsuarioDAO();
        $this->usuarioService = new UsuarioService();

        $this->handleAction();
    }

    protected function list(string $msgErro = "", string $msgSucesso = "")
    {

        if (! $this->usuarioEstaLogado())
            return;

        $dados["lista"] = $this->usuarioDao->list();

        $this->loadView("usuario/List.php", $dados,  $msgErro, $msgSucesso);
    }

    protected function create()
    {
        if (! $this->usuarioEstaLogado())
            return;

        $dados['id'] = 0;
        $dados['papeis'] = UsuarioPapel::getAllAsArray();

        $this->loadView("usuario/UsuForm.php", $dados);
    }

    protected function edit()
    {
        if (! $this->usuarioEstaLogado())
            return;


        $usuario = $this->findUsuarioById();

        if ($usuario) {
            $dados['id'] = $usuario->getId();
            $usuario->setSenha("");
            $dados["usuario"] = $usuario;

            $dados['papeis'] = UsuarioPapel::getAllAsArray();

            $this->loadView("usuario/UsuFormEdit.php", $dados);
        } else
            $this->list("Usuário não encontrado!");
    }

    protected function save()
    {

        if (! $this->usuarioEstaLogado())
            return;

        $id = $_POST['id'];
        $nome = trim($_POST['nome']) != "" ? trim($_POST['nome']) : NULL;
        $apelido = trim($_POST['apelido']) != "" ? trim($_POST['apelido']) : NULL;
        $email = trim($_POST['email']) != "" ? trim($_POST['email']) : NULL;
        $telefone = trim($_POST['telefone']) != "" ? trim($_POST['telefone']) : NULL;
        $data_nascimento = trim($_POST['data_nascimento']) != "" ? trim($_POST['data_nascimento']) : NULL;
        $senha = trim($_POST['senha']) != "" ? trim($_POST['senha']) : NULL;
        $confSenha = trim($_POST['conf_senha']) != "" ? trim($_POST['conf_senha']) : NULL;

        $papel = $_POST['papel'];

        $usuario = new Usuario();
        $usuario->setId($id);
        $usuario->setNome($nome);
        $usuario->setApelido($apelido);
        $usuario->setEmail($email);
        $usuario->setTelefone($telefone);
        $usuario->setDataNascimento($data_nascimento);
        $usuario->setSenha($senha);
        $usuario->setFoto(null);
        $usuario->setPapel($papel);

        $erros = $this->usuarioService->validarDados($usuario, $confSenha);
        if (! $erros) {
            try {
                if ($usuario->getId() == 0)
                    $this->usuarioDao->insert($usuario);
                else
                    $this->usuarioDao->update($usuario);

                header("location: " . BASEURL . "/controller/UsuarioController.php?action=list");
                exit;
            } catch (PDOException $e) {
                array_push($erros, "Erro ao gravar no banco de dados!");
            }
        }

        $dados['id'] = $usuario->getId();
        $dados['papeis'] = UsuarioPapel::getAllAsArray();
        $dados["usuario"] = $usuario;
        $dados['confSenha'] = $confSenha;

        $msgErro = implode("<br>", $erros);

        $this->loadView("usuario/UsuForm.php", $dados, $msgErro);
    }



    protected function delete()
    {
        if (! $this->usuarioEstaLogado())
            return;


        $usuario = $this->findUsuarioById();

        if ($usuario) {
            $this->usuarioDao->deleteById($usuario->getId());

            header("location: " . BASEURL . "/controller/UsuarioController.php?action=list");
            exit;
        } else {
            $this->list("Usuário não encontrado!");
        }
    }

    protected function autoCadastro()
    {
        $dados['id'] = 0;

        $this->loadView("usuario/UsuAutocadastro.php", $dados);
    }

    protected function saveAutoCadastro()
    {

        $nome = trim($_POST['nome']) != "" ? trim($_POST['nome']) : NULL;
        $apelido = trim($_POST['apelido']) != "" ? trim($_POST['apelido']) : NULL;
        $email = trim($_POST['email']) != "" ? trim($_POST['email']) : NULL;
        $telefone = trim($_POST['telefone']) != "" ? trim($_POST['telefone']) : NULL;
        $data_nascimento = trim($_POST['data_nascimento']) != "" ? trim($_POST['data_nascimento']) : NULL;
        $senha = trim($_POST['senha']) != "" ? trim($_POST['senha']) : NULL;
        $confSenha = trim($_POST['conf_senha']) != "" ? trim($_POST['conf_senha']) : NULL;

        $usuario = new Usuario();
        $usuario->setNome($nome);
        $usuario->setApelido($apelido);
        $usuario->setEmail($email);
        $usuario->setTelefone($telefone);
        $usuario->setDataNascimento($data_nascimento);
        $usuario->setSenha($senha);
        $usuario->setFoto(null);
        $usuario->setPapel(UsuarioPapel::JOGADOR);

        $erros = $this->usuarioService->validarAutoCadastro($usuario, $confSenha);
        if (! $erros) {
            try {
                $this->usuarioDao->insert($usuario);

                header("location: " . BASEURL . "/controller/LoginController.php?action=login");
                exit;
            } catch (PDOException $exception) {

                array_push($erros, "Erro ao gravar no banco de dados:; " . $exception);
            }
        }

        $dados['id'] = 0;
        $dados["usuario"] = $usuario;

        $msgErro = implode("<br>", $erros);

        $this->loadView("usuario/UsuAutocadastro.php", $dados, $msgErro);
    }


    private function findUsuarioById()
    {
        $id = 0;
        if (isset($_GET["id"]))
            $id = $_GET["id"];

        return $this->usuarioDao->findById($id);
    }
}

new UsuarioController();
