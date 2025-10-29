<?php

require_once(__DIR__ . "/Controller.php");
require_once(__DIR__ . "/../dao/UsuarioDAO.php");

class HomeController extends Controller {

    private UsuarioDAO $usuarioDAO;

    public function __construct() {
        if(! $this->usuarioEstaLogado())
            return;

        $this->usuarioDAO = new UsuarioDAO();

        $this->handleAction();
    }

    protected function home() {

        $dados["qtdUsuarios"] = $this->usuarioDAO->quantidadeUsuarios(); 

        $this->loadView("home/home.php", $dados);
    }
    
}

new HomeController();