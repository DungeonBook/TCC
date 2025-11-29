<?php

require_once(__DIR__ . "/Controller.php");
require_once(__DIR__ . "/../dao/UsuarioDAO.php");
require_once(__DIR__ . "/../service/UsuarioService.php");
require_once(__DIR__ . "/../service/ArquivoService.php");

class PerfilController extends Controller
{

    private UsuarioDAO $usuarioDao;
    private UsuarioService $usuarioService;
    private ArquivoService $arquivoService;

    public function __construct()
    {
        if (! $this->usuarioEstaLogado())
            return;

        $this->usuarioDao = new UsuarioDAO();
        $this->usuarioService = new UsuarioService();
        $this->arquivoService = new ArquivoService();

        $this->handleAction();
    }

    protected function view()
    {
        $idUsuarioLogado = $this->getIdUsuarioLogado();
        $usuario = $this->usuarioDao->findById($idUsuarioLogado);
        $dados['usuario'] = $usuario;

        $this->loadView("perfil/Perfil.php", $dados);
    }

    protected function edit()
    {

        $idUsuarioLogado = $this->getIdUsuarioLogado();
        $usuario = $this->usuarioDao->findById($idUsuarioLogado);

        if ($usuario) {
            $dados['id'] = $usuario->getId();
            $usuario->setSenha("");
            $dados["usuario"] = $usuario;

            $this->loadView("perfil/FormPerfil.php", $dados);
        } else
            echo "Usuário não encontrado!";
    }

    public function deleteSelf(string $msgErro = "", string $msgSucesso = "")
    {
        if (! $this->usuarioEstaLogado())
            return;

        $id = $_SESSION[SESSAO_USUARIO_ID];

        require_once(__DIR__ . "/../dao/UsuarioDAO.php");
        $dao = new UsuarioDAO();

        $dao->deleteById($id);

        session_unset();
        session_destroy();

        $msgSucesso = "Conta excluída!";

        $this->loadView("login/Login.php", [], $msgErro, $msgSucesso);
    }


    protected function saveEditPerfil()
    {

        $nome = trim($_POST['nome']) != "" ? trim($_POST['nome']) : NULL;
        $apelido = trim($_POST['apelido']) != "" ? trim($_POST['apelido']) : NULL;
        $email = trim($_POST['email']) != "" ? trim($_POST['email']) : NULL;
        $telefone = trim($_POST['telefone']) != "" ? trim($_POST['telefone']) : NULL;
        $data_nascimento = trim($_POST['data_nascimento']) != "" ? trim($_POST['data_nascimento']) : NULL;
        $senha = trim($_POST['senha']) != "" ? trim($_POST['senha']) : NULL;
        $confSenha = trim($_POST['conf_senha']) != "" ? trim($_POST['conf_senha']) : NULL;
        $fotoAtual = trim($_POST['foto_atual']) != "" ? trim($_POST['foto_atual']) : NULL;

        $usuario = new Usuario();
        $usuario->setId($this->getIdUsuarioLogado());
        $usuario->setNome($nome);
        $usuario->setApelido($apelido);
        $usuario->setEmail($email);
        $usuario->setTelefone($telefone);
        $usuario->setDataNascimento($data_nascimento);
        $usuario->setSenha($senha);
        $usuario->setFoto(null);


        $erros = $this->usuarioService->validarDados($usuario, $confSenha, false);

        if (! $erros) {
            try {
                $foto = $_FILES["foto"];
                if ($foto["size"] > 0) {
                    $arquivoFoto = $this->arquivoService->salvarArquivo($foto);

                    $usuario->setFoto($arquivoFoto);
                } else if ($fotoAtual)
                    $usuario->setFoto($fotoAtual);

                $this->usuarioDao->updatePerfil($usuario);

                header("location: " . BASEURL . "/controller/PerfilController.php?action=view");
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

        $this->loadView("perfil/FormPerfil.php", $dados, $msgErro);
    }
}

new PerfilController();
