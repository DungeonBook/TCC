<?php

include_once(__DIR__ . "/../connection/Connection.php");
include_once(__DIR__ . "/../model/Sala.php");
include_once(__DIR__ . "/../model/Usuario.php");
include_once(__DIR__ . "/../model/Modalidade.php");
include_once(__DIR__ . "/../dao/UsuarioDAO.php");


class SalaDAO
{

    //Método para listar os usuários a partir da base de dados
    public function list()
    {
        $conn = Connection::getConn();

        $sql = "SELECT * FROM salas s ORDER BY s.descricao";
        $stm = $conn->prepare($sql);
        $stm->execute();
        $result = $stm->fetchAll(PDO::FETCH_ASSOC);

        return $this->mapSalas($result);
    }

    public function listByUsuario(int $idUsuario)
    {
        $conn = Connection::getConn();

        $sql = "SELECT * FROM salas s WHERE s.criador_id = :id ORDER BY s.descricao";
        $stm = $conn->prepare($sql);
        $stm->bindValue("id", $idUsuario);

        $stm->execute();
        $result = $stm->fetchAll(PDO::FETCH_ASSOC);

        return $this->mapSalas($result);
    }

    //Identificador = senha para salas de partida privada
    public function findByIdentificador(string $identificador)
    {
        // $conn = Connection::getConn();

        // $sql = "SELECT * FROM salas s";
        // $stm = $conn->prepare($sql);
        // $stm->execute([$identificador]);
        // $result = $stm->fetchAll();

        // $sala = $this->mapSalas($result);

        // if (count($sala) == 1) {
        //     //Tratamento para senha criptografada
        //     if (password_verify($identificador[0]->getIdentificador()))
        //         return $sala[0];
        //     else
        //         return null;
        // } elseif (count($sala) == 0)
        //     return null;

        // die("SalaDAO.findByIdentificador()" .
        //     " - Erro: mais de uma sala encontrada.");
    }

    public function insert(Sala $sala)
    {
        //TODO - mudar os parametros
        $conn = Connection::getConn();

        $sql = "INSERT INTO `salas` (`nome_sala`, `criador_id`, `quant_min_jogadores`, `quant_max_jogadores`, `data`, `hora_inicio`, `hora_fim`, `localizacao`, `descricao`, `modalidade_id`, `identificador`, `status`) VALUES (:nomeSala, :criadorId, :quantMinJogadores, :quantMaxJogadores, :dataInicio, :horaInicio, :horaFim, :descricao, :modalidadeId, :identificador, :statusSala)";

        $identificador = password_hash($sala->getIdentificador(), PASSWORD_DEFAULT);

        $stm = $conn->prepare($sql);
        $stm->bindValue("nomeSala", $sala->getNomeSala());
        $stm->bindValue("criadorId", $sala->getCriador()->getId());
        $stm->bindValue("quantMinJogadores", $sala->getQuantMinJogadores());
        $stm->bindValue("quantMaxJogadores", $sala->getQuantMaxJogadores());
        $stm->bindValue("data", $sala->getData());
        $stm->bindValue("horaInicio", $sala->getHoraInicio());
        $stm->bindValue("horaFim", $sala->getHoraFim());
        $stm->bindValue("localizacao", $sala->getLocalizacao());
        $stm->bindValue("descricao", $sala->getDescricao());

        $stm->bindValue("modalidadeId", 1);

        $stm->bindValue("identificador", $sala->getIdentificador());

        $stm->bindValue("statusSala", "ativo");

        $stm->execute();
    }

    //Método para atualizar um Usuario
    public function update(Sala $sala)
    {
        $conn = Connection::getConn();

        $sql = "UPDATE sala SET nomeSala = :nomeSala, criadorId = :criadorId, quantMinJogadores = :quantMinJogadores, quantMaxJogadores, data, horaInicio, horaFim, localizacao, descricao, modalidadeId, identificador, status)" .
            " VALUES (:nomeSala, :criadorId, :quantMinJogadores, :quantMaxJogadores, :data, :horaInicio, :horaFim, :localizacao, :descricao, :modalidadeId, :identificador, :status)";

        $stm = $conn->prepare($sql);
        $stm->bindValue("nomeSala", $sala->getNomeSala());
        $stm->bindValue("criadorId", $sala->getCriador()->getId());
        $stm->bindValue("quantMinJogadores", $sala->getQuantMinJogadores());
        $stm->bindValue("quantMaxJogadores", $sala->getQuantMaxJogadores());
        $stm->bindValue("data", $sala->getData());
        $stm->bindValue("horaInicio", $sala->getHoraInicio());
        $stm->bindValue("horaFim", $sala->getHoraFim());
        $stm->bindValue("localizacao", $sala->getLocalizacao());
        $stm->bindValue("descricao", $sala->getDescricao());
        $stm->bindValue("modalidadeId", 1);
        $stm->bindValue("identificador", $sala->getIdentificador());
        $stm->bindValue("status", $sala->getStatus());
        $stm->execute();
    }

    //Método para excluir um Usuario pelo seu ID
    public function deleteById(int $id)
    {
        $conn = Connection::getConn();

        $sql = "DELETE FROM sala WHERE id = :id";

        $stm = $conn->prepare($sql);
        $stm->bindValue("id", $id);
        $stm->execute();
    }

    private function mapSalas($arrayDeSalas)
    {

        $userDAO = new UsuarioDAO();

        $salas = array();
        foreach ($arrayDeSalas as $salaArray) {

            $sala = new Sala();
            $sala->setId($salaArray['id']);
            $sala->setNomeSala($salaArray['nome_sala']);
            $sala->setQuantMinJogadores($salaArray['quant_min_jogadores']);
            $sala->setQuantMaxJogadores($salaArray['quant_max_jogadores']);
            $sala->setData($salaArray['data']);
            $sala->setHoraInicio($salaArray['hora_inicio']);
            $sala->setHoraFim($salaArray['hora_fim']);
            $sala->setLocalizacao($salaArray['localizacao']);
            $sala->setDescricao($salaArray['descricao']);
            $sala->setIdentificador($salaArray['identificador']);

            $sala->setStatus($salaArray['status']);

            $sala->setModalidade(new Modalidade());

            $criador = $userDAO->findById($salaArray['criador_id']);
            $sala->setCriador($criador);

            array_push($salas, $sala);
        }

        return $salas;
    }
}
