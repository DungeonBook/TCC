<?php
require_once(__DIR__ . "/Controller.php");
require_once(__DIR__ . "/../dao/SalaDAO.php");
require_once(__DIR__ . "/../dao/SalaJogadoresDAO.php");

class SalaJogadoresController extends Controller
{
    private SalaDAO $salaDAO;
    private SalaJogadoresDAO $salaJogadoresDAO;

    public function __construct()
    {
        if (!$this->usuarioEstaLogado())
            return;

        $this->salaDAO = new SalaDAO();
        $this->salaJogadoresDAO = new SalaJogadoresDAO();

        $this->handleAction();
    }

    protected function participar()
    {
        $sala = $this->findSalaById();
        
        if ($sala == null) {
            $this->loadView("salaJogadores/Participar.php", [], "Sala inválida!");
            return;
        }

        $quantidadeJogadoresNaSala = $this->salaJogadoresDAO->countJogadoresBySala($sala->getId());

        $msgErro = "";

        if ($sala->getStatus() == false) {
            $msgErro = "A sala escolhida está inativa!";
        } elseif ($quantidadeJogadoresNaSala >= $sala->getQuantMaxJogadores()) {
            $msgErro = "A sala escolhida já está lotada!";
        } elseif ($this->salaJogadoresDAO->usuarioEstaNaSala($sala->getId(), $this->getIdUsuarioLogado())) {
            $msgErro = "Você já está participando desta sala!";
        } else if($sala->getCriador()->getId() == $this->getIdUsuarioLogado()) { 
            $msgErro = "O mestre de mesa já está partipando da sala!";
        }

        if ($msgErro) {
            $this->loadView("salaJogadores/Participar.php", [], $msgErro);
            return;
        }

        try {
            $this->salaJogadoresDAO->insert($sala->getId(), $this->getIdUsuarioLogado());

            header("location: " . BASEURL ."/controller/SalaJogadoresController.php?action=detalharPartida&idSala=" . $sala->getId());
            exit;
        } catch (PDOException $e) {
            $this->loadView(
                "salaJogadores/Participar.php",
                [],
                "Erro ao participar da sala: " . $e->getMessage()
            );
        }
    }

    protected function deleteJogador() {
        //TODO 

        echo "A eduarda se comprometeu a implementar esta funcionalidade!";
    }

    protected function detalharPartida($msg = '')
    {
        $sala = $this->findSalaById();

        if ($sala == null) {
            $this->loadView("salaJogadores/Participar.php", [], "Sala inválida!");
            return;
        }

        $jogadores = $this->salaJogadoresDAO->listJogadoresBySala($sala->getId());

        $dados['msg'] = $msg;

        $dados["sala"] = $sala;
        $dados["jogadores"] = $jogadores;
        $dados["numeroJogadores"] = $this->salaJogadoresDAO->countJogadoresBySala($sala->getId());

        $dados['usuarioLogadoisCriador'] =
                $this->getIdUsuarioLogado() == $sala->getCriador()->getId();


        $this->loadView("salaJogadores/DetalharPartida.php", $dados);
    }

    private function findSalaById()
    {
        if (!isset($_GET['idSala']) || !is_numeric($_GET['idSala'])) {
            return null;
        }

        return $this->salaDAO->findSalaById($_GET['idSala']);
    }
}

new SalaJogadoresController();
