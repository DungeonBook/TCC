<?php
#Classe controller para Usuário
require_once(__DIR__ . "/Controller.php");
require_once(__DIR__ . "/../dao/SalaDAO.php");
require_once(__DIR__ . "/../service/SalaService.php");
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

        $dados['id'] = 0;
        //$dados['papeis'] = UsuarioPapel::getAllAsArray();

        $this->loadView("sala/form.php", $dados);
    }

    protected function save()
    {
        if (! $this->usuarioEstaLogado())
            return;

        //Capturar os dados do formulário
        $id = $_POST['id'];
        $nome_sala = trim($_POST['nome_sala']) != "" ? trim($_POST['nome_sala']) : NULL;
        $descricao = trim($_POST['descricao']) != "" ? trim($_POST['descricao']) : NULL;

        //$quantMinJogadores = trim($_POST['quantMinJogadores']) != "" ? trim($_POST['quantMinJogadores']) : NULL;
        //$quantMaxJogadores = trim($_POST['quantMaxJogadores']) != "" ? trim($_POST['quantMaxJogadores']) : NULL;
        //$horariosDisponiveis = trim($_POST['horariosDisponiveis']) != "" ? trim($_POST['horariosDisponiveis']) : NULL;
        //$indentificador = trim($_POST['indentificador']) != "" ? trim($_POST['indentificador']) : NULL;
        //$modalidade = trim($_POST['modalidade']) != "" ? trim($_POST['modalidade']) : NULL;
        //$status = trim($_POST['status']) != "" ? trim($_POST['status']) : NULL;

        //Criar o objeto Usuario
        $sala = new Sala();
        $sala->setId($id);
        $sala->setNomeSala($nome_sala);
        $sala->setDescricao($descricao);

        //$sala->setQuantMinJogadores($quantMinJogadores);
        //$sala->setQuantMaxJogadores($quantMaxJogadores);
        //$sala->setHorariosDisponiveis($horariosDisponiveis);
        //$sala->setIdentificador($indentificador);
        //$sala->setModalidade($modalidade);
        //$sala->setStatus($status);

        //Validar os dados (camada service)
        $erros = $this->SalaService->validarDados($sala);
        if (! $erros) {
            //Inserir no Base de Dados
            try {
                if ($sala->getId() == 0)
                    $this->salaDAO->insert($sala);
                else
                    $this->salaDAO->update($sala);

                header("location: " . BASEURL . "/controller/UsuarioController.php?action=list");
                exit;
            } catch (PDOException $e) {
                //Iserir erro no array
                array_push($erros, "Erro ao gravar no banco de dados!");
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
}

#Criar objeto da classe para assim executar o construtor
new SalaController();
