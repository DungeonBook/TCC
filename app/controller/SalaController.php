<?php
#Classe controller para Usuário
require_once(__DIR__ . "/Controller.php");
require_once(__DIR__ . "/../dao/SalaDAO.php");
require_once(__DIR__ . "/../dao/UsuarioDAO.php");
require_once(__DIR__ . "/../dao/ModalidadeDAO.php");
require_once(__DIR__ . "/../service/SalaService.php");
require_once(__DIR__ . "/../model/Sala.php");
require_once(__DIR__ . "/../model/Modalidade.php");


class SalaController extends Controller
{

    private SalaDAO $salaDAO;
    private UsuarioDAO $usuarioDAO;
    private ModalidadeDAO $modalidadeDAO;
    private SalaService $salaService;

    //Método construtor do controller - será executado a cada requisição a está classe
    public function __construct()
    {
        if (! $this->usuarioEstaLogado())
            return;

        $this->salaDAO = new SalaDAO();
        $this->usuarioDAO = new UsuarioDAO();
        $this->modalidadeDAO = new ModalidadeDAO();

        $this->salaService = new SalaService();

        $this->handleAction();
    }

    protected function list(string $msgErro = "", string $msgSucesso = "")
    {

        $dados["salasDisp"] = $this->salaDAO->listAtivas();
        $dados["minhasSalas"] = $this->salaDAO->listByUsuario($this->getIdUsuarioLogado());
        $dados["meusJogos"] = array(); //TODO - Trazer as salas que o usuário já se cadastrou


        $this->loadView("sala/sala-list.php", $dados,  $msgErro, $msgSucesso);
    }

    protected function create()
    {
        $dados['id'] = 0;
        $dados['modalidades'] = $this->modalidadeDAO->list();

        $this->loadView("sala/sala-cadastro.php", $dados);
    }

    protected function edit()
    {
        //Busca a sala na base pelo ID    
        $sala = $this->findSalaById();
        if ($sala) {
            $dados['id'] = $sala->getId();
            $dados["sala"] = $sala;

            $dados['modalidades'] = $this->modalidadeDAO->list();

            $this->loadView("sala/sala-cadastro.php", $dados);
        } else
            $this->list("Sala não encontrada!");
    }

    protected function save()
    {
        //Capturar os dados do formulário
        $id = trim($_POST['id'] ?? '') ?: NULL;
        $nomeSala = trim($_POST['nomeSala'] ?? '');
        $quant_min_jogadores = trim($_POST['quantMinJogadores'] ?? '') !== '' ? (int) $_POST['quantMinJogadores'] : NULL;
        $quant_max_jogadores = trim($_POST['quantMaxJogadores'] ?? '') !== '' ? (int) $_POST['quantMaxJogadores'] : NULL;
        $data = trim($_POST['data'] ?? '') ?: NULL;
        $hora_inicio = trim($_POST['horaInicio'] ?? '');
        $hora_fim = trim($_POST['horaFim'] ?? '') ?: NULL;
        $localizacao = trim($_POST['localizacao'] ?? '') ?: NULL;
        $descricao = trim($_POST['descricao'] ?? '') ?: NULL;
        $modalidadeId = trim($_POST['modalidadeId'] ?? '') !== '' ? (int) $_POST['modalidadeId'] : NULL;

        //Criar o objeto Sala
        $sala = new Sala();
        $sala->setId($id);
        $sala->setNomeSala($nomeSala);
        $sala->setQuantMinJogadores($quant_min_jogadores);
        $sala->setQuantMaxJogadores($quant_max_jogadores);
        $sala->setData($data);
        $sala->setHoraInicio($hora_inicio);
        $sala->setHoraFim($hora_fim);
        $sala->setLocalizacao($localizacao);
        $sala->setDescricao($descricao);

        if ($modalidadeId) {
            $sala->setModalidade(new Modalidade());
            $sala->getModalidade()->setId($modalidadeId);
        } else
            $sala->setModalidade(null);


        //Validar os dados (camada service)
        $erros = (array) $this->salaService->validarDados($sala);

        if (sizeof($erros) == 0) {
            //Inserir no Base de Dados
            try {
                if ($sala->getId() == 0) {
                    $sala->setCriador(new Usuario());
                    $sala->getCriador()->setId($this->getIdUsuarioLogado());

                    $this->salaDAO->insert($sala);
                } else
                    $this->salaDAO->update($sala);

                header("location: " . BASEURL . "/controller/SalaController.php?action=list");
                exit;
            } catch (PDOException $e) {
                //Iserir erro no array
                array_push($erros, "Erro ao gravar no banco de dados!");
                array_push($erros, $e->getMessage());
            }
        }

        //Mostrar os erros
        $dados['id'] = $sala->getId();
        $dados["sala"] = $sala;
        $dados['modalidades'] = $this->modalidadeDAO->list();

        $msgErro = implode("<br>", $erros);

        $this->loadView("sala/sala-cadastro.php", $dados, $msgErro);
    }

    private function findSalaById()
    {
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            return null;
        }

        return $this->salaDAO->findSalaById($_GET['id']); // Buscar no banco
    }

    protected function delete()
    {
        if (! $this->usuarioEstaLogado())
            return;

        //Busca o usuário na base pelo ID    
        $sala = $this->findSalaById();

        if ($sala) {
            //Excluir
            $this->salaDAO->deleteById($sala->getId());

            header("location: " . BASEURL . "/controller/SalaController.php?action=list");
            exit;
        } else {
            $this->list("Sala não encontrado!");
        }
    }


    public function detalhar()
    {
        if (isset($_GET['id'])) {

            $id = intval($_GET['id']);
            $salaDAO = new SalaDAO();
            $dados['sala'] = $salaDAO->findSalaById($id);
            $dados['idUsuarioLogado'] = $this->getIdUsuarioLogado();

            if ($dados['sala']) {

                $this->loadView("sala/sala-detalhes.php", $dados);
            } else {
                // Sala não encontrada → redireciona para lista com mensagem
                $_SESSION['msg'] = "Sala não encontrada.";
                header("Location: ./SalaController.php?action=list");
                exit;
            }
        } else {
            // Se não tiver ID → volta para lista
            header("Location: ./SalaController.php?action=list");
            exit;
        }
    }
}

#Criar objeto da classe para assim executar o construtor
new SalaController();
