<?php
#Classe controller para Usuário
require_once(__DIR__ . "/Controller.php");
require_once(__DIR__ . "/../dao/SalaDAO.php");
//require_once(__DIR__ . "/../service/SalaService.php");
require_once(__DIR__ . "/../model/Sala.php");


class SalaController extends Controller
{

    private SalaDAO $salaDAO;
    //private UsuarioService $usuarioService;

    //Método construtor do controller - será executado a cada requisição a está classe
    public function __construct()
    {
        if (! $this->usuarioEstaLogado())
            return;
        
        $this->salaDAO = new SalaDAO();
        //$this->usuarioService = new UsuarioService();

        $this->handleAction();
    }

    protected function list(string $msgErro = "", string $msgSucesso = "")
    {
        $dados["lista"] = $this->salaDAO->listByUsuario($this->getIdUsuarioLogado());

        $this->loadView("sala/list.php", $dados,  $msgErro, $msgSucesso);
    }

    protected function create()
    {
        if (! $this->usuarioEstaLogado())
            return;

        $dados['id'] = 0;
        $dados['papeis'] = UsuarioPapel::getAllAsArray();

        $this->loadView("sala/form.php", $dados);
    }

    
}


#Criar objeto da classe para assim executar o construtor
new SalaController();
