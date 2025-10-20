<?php

require_once(__DIR__ . "/Controller.php");
require_once(__DIR__ . "/../dao/SalaDAO.php");
require_once(__DIR__ . "/../dao/SalaJogadoresDAO.php");

class SalaJogadoresController extends Controller {

    private SalaDAO $salaDAO;
    private SalaJogadoresDAO $salaJogadoresDAO;

    public function __construct()
    {
        if (! $this->usuarioEstaLogado())
            return;

        $this->salaDAO = new SalaDAO();
        $this->salaJogadoresDAO = new SalaJogadoresDAO();

        //$this->usuarioDAO = new UsuarioDAO();
        
        $this->handleAction();
    }

    protected function participar() {
        //1- Receber os dados da sala
        $sala = $this->findSalaById();
        if($sala == null) {
            echo "Sala inválida!";
            exit;
        }

        //Consultar no banco
        $quatidadeJogadoresNaSala = 0;

        $msgErro = "";
        if($sala->getStatus() == false) {
            $msgErro = "A sala escolhida está inativa!";
        } else if($quatidadeJogadoresNaSala >= $sala->getQuantMaxJogadores()) { //Validar se tem vaga na sala
            $msgErro = "A sala escolhida já está lotada!";
        } else {
            //Verificar se o usuário logado já está na sala
        }

        if($msgErro) {
            //Chamar o load view para exibir a mensagem de erro
            $this->loadView("sala_jogadores/participar.php", [],  $msgErro);
        } else {
            //Inserir o jogador na sala
            try {
                $this->salaJogadoresDAO->insert($sala->getId(), $this->getIdUsuarioLogado());

                header("location: " . BASEURL . 
                    "/controller/SalaJogadoresController.php?action=detalharPartida&idSala=" . $sala->getId());
            } catch(PDOException $e) {
                $this->loadView("sala_jogadores/participar.php", [],
                    "Erro ao participar da sala.");
            }
        }

    }


    protected function detalharPartida() {
        //1- Receber os dados da sala
        $sala = $this->findSalaById();
        if($sala == null) {
            echo "Sala inválida!";
            exit;
        }

        //2- Buscar os dados dos jogadores da sala (mestre de mesa já deve estar cadastrado automaticamente)
        echo "View com os detalhes da partida";
    }


    private function findSalaById()
    {
        if (!isset($_GET['idSala']) || !is_numeric($_GET['idSala'])) {
            return null;
        }

        return $this->salaDAO->findSalaById($_GET['idSala']); // Buscar no banco
    }




}

new SalaJogadoresController();
