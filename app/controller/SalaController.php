<?php
#Classe controller para Usuário
require_once(__DIR__ . "/Controller.php");
require_once(__DIR__ . "/../dao/SalaDAO.php");
require_once(__DIR__ . "/../dao/UsuarioDAO.php");
require_once(__DIR__ . "/../dao/ModalidadeDAO.php");
require_once(__DIR__ . "/../service/SalaService.php");
require_once(__DIR__ . "/../model/Sala.php");
require_once(__DIR__ . "/../model/enum/SalaStatus.php");

class SalaController extends Controller
{

    private SalaDAO $salaDAO;
    private UsuarioDAO $usuarioDAO;
    private ModalidadeDAO $modalidadeDAO;


    private SalaService $SalaService;

    //Método construtor do controller - será executado a cada requisição a está classe
    public function __construct()
    {
        if (! $this->usuarioEstaLogado())
            return;

        $this->salaDAO = new SalaDAO();
        $this->usuarioDAO = new UsuarioDAO();
        $this->modalidadeDAO = new ModalidadeDAO();

        $this->SalaService = new SalaService();

        $this->handleAction();
    }

    protected function list(string $msgErro = "", string $msgSucesso = "")
    {

        //TODO Melhorar tal coisa
        $dados["salas"] = $this->salaDAO->listByUsuario($this->getIdUsuarioLogado());

        print "<pre>";
        print_r($dados);
        print "</pre>";
        die;

        $this->loadView("sala/list.php", $dados,  $msgErro, $msgSucesso);
    }

    protected function create()
    {

        $dados['id'] = 0;
        $dados['status'] = SalaStatus::getAllAsArray();
        $dados['modalidades'] = $this->modalidadeDAO->list();


        $this->loadView("sala/form.php", $dados);
    }

     protected function edit()
    {
        if (! $this->usuarioEstaLogado())
            return;

        //Busca a sala na base pelo ID    
        $sala = $this->findSalaById();
        if ($sala) {
            $dados['id'] = $sala->getId();
            $dados["sala"] = $sala;

            $this->loadView("sala/form.php", $dados);
        } else
            $this->list("Sala não encontrada!");
    }

    protected function save()
    {
        if (! $this->usuarioEstaLogado())
            return;


        //Capturar os dados do formulário
        $id = trim($_POST['id'] ?? '') ?: NULL;

        $nome_sala = trim($_POST['nome_sala'] ?? '');

        $criador_apelido = trim($_POST['criador_apelido'] ?? '') ?: NULL;
        $quant_min_jogadores = trim($_POST['quant_min_jogadores'] ?? '') !== '' ? (int) $_POST['quant_min_jogadores'] : NULL;
        $quant_max_jogadores = trim($_POST['quant_max_jogadores'] ?? '') !== '' ? (int) $_POST['quant_max_jogadores'] : NULL;
        $data = trim($_POST['data'] ?? '') ?: NULL;

        $hora_inicio = trim($_POST['hora_inicio'] ?? '');

        $hora_fim = trim($_POST['hora_fim'] ?? '') ?: NULL;
        $localizacao = trim($_POST['localizacao'] ?? '') ?: NULL;
        $modalidade_id = trim($_POST['modalidade_id'] ?? '') !== '' ? (int) $_POST['modalidade_id'] : NULL;
        $descricao = trim($_POST['descricao'] ?? '') ?: NULL;
        $status = trim($_POST['status'] ?? '') ?: NULL;


        //Criar o objeto Sala
        $sala = new Sala();
        $sala->setId($id);
        $sala->setNomeSala($nome_sala);

        // Melhorar 
        if (isset($criador_apelido)) {

            $criador = $this->usuarioDAO->findByApelido($criador_apelido);

            if (isset($criador)) {
                $sala->setCriador($criador);
            }
        }
        $sala->setQuantMinJogadores($quant_min_jogadores);
        $sala->setQuantMaxJogadores($quant_max_jogadores);
        $sala->setData($data);
        $sala->setHoraInicio($hora_inicio);
        $sala->setHoraFim($hora_fim);
        $sala->setLocalizacao($localizacao);
        $sala->setModalidade(new Modalidade());
        $sala->setDescricao($descricao);
        $sala->setStatus($status);


        //Validar os dados (camada service)
        $erros = (array) $this->SalaService->validarDados($sala);

        if (sizeof($erros) == 0) {
            //Inserir no Base de Dados
            try {
                if ($sala->getId() == 0)
                    $this->salaDAO->insert($sala);
                else
                    $this->salaDAO->update($sala);

                header("location: " . BASEURL . "/controller/SalaController.php?action=list");
                exit;
            } catch (PDOException $e) {
                //Iserir erro no array
                array_push($erros, "Erro ao gravar no banco de dados: " . $e->getMessage());
                //array_push($erros, $e->getMessage());
            }
        }

        //Mostrar os erros
        $dados['id'] = $sala->getId();
        $dados["sala"] = $sala;
        $dados['status'] = SalaStatus::getAllAsArray();

        $msgErro = implode("<br>", $erros);

        $this->loadView("sala/form.php", $dados, $msgErro);
    }

    private function findSalaById()
    {
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            return null;
        }

        $id = (int) $_GET['id'];
        //return $this->salaDAO->findSalaById($id); // Buscar no banco
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
    // Aqui você pode incluir regras de negócio adicionais
    // Ex: Limitar o tamanho do nome ou impedir palavras proibidas

    //return $sala;
}

/**
 * Exemplo de validação para remoção de sala
 * (opcional - depende da sua regra de negócio)
 */
//public function validarRemocao(Sala $sala)
{
    // Exemplo: impedir exclusão se sala for "Principal"
    //if (strtolower($sala->getNomeSala()) === 'principal') {
    //throw new Exception("A sala Principal não pode ser removida.");
}
//}


#Criar objeto da classe para assim executar o construtor
new SalaController();
