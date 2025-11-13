<?php
include_once(__DIR__ . "/../connection/Connection.php");
include_once(__DIR__ . "/../model/Sala.php");
include_once(__DIR__ . "/../model/Usuario.php");
include_once(__DIR__ . "/../model/Modalidade.php");
include_once(__DIR__ . "/../dao/UsuarioDAO.php");

class SalaDAO
{
    public function list()
    {
        $conn = Connection::getConn();

        $sql = "SELECT s.*, m.descricao modalidade_descricao FROM salas s JOIN modalidades m ON (m.id = s.modalidade_id) ORDER BY s.descricao";
        $stm = $conn->prepare($sql);
        $stm->execute();
        $result = $stm->fetchAll(PDO::FETCH_ASSOC);

        return $this->mapSalas($result);
    }

    public function listByUsuario(int $idUsuario)
    {
        $conn = Connection::getConn();

        $sql = "SELECT s.*, m.descricao modalidade_descricao FROM salas s
                    JOIN modalidades m ON (m.id = s.modalidade_id)
                WHERE s.criador_id = :id ORDER BY s.data DESC";
        $stm = $conn->prepare($sql);
        $stm->bindValue("id", $idUsuario);

        $stm->execute();
        $result = $stm->fetchAll(PDO::FETCH_ASSOC);

        return $this->mapSalas($result);
    }

    public function listByParticipante(int $idUsuario)
    {
        $conn = Connection::getConn();

        $sql = "SELECT s.*, m.descricao modalidade_descricao FROM salas s
                    JOIN modalidades m ON (m.id = s.modalidade_id)
                WHERE s.criador_id = :id OR 
                    EXISTS(SELECT sj.id FROM salas_jogadores sj WHERE sj.sala_id = s.id and sj.usuario_id = :id)
                ORDER BY s.data DESC";
        $stm = $conn->prepare($sql);
        $stm->bindValue("id", $idUsuario);

        $stm->execute();
        $result = $stm->fetchAll(PDO::FETCH_ASSOC);

        return $this->mapSalas($result);
    }


    public function listAtivas()
    {
        $conn = Connection::getConn();

        $sql = "SELECT s.*, m.descricao modalidade_descricao FROM salas s
                    JOIN modalidades m ON (m.id = s.modalidade_id)
                WHERE cast(concat(data, ' ', hora_inicio) as datetime) > now()
                ORDER BY s.data DESC";
        $stm = $conn->prepare($sql);

        $stm->execute();
        $result = $stm->fetchAll(PDO::FETCH_ASSOC);

        return $this->mapSalas($result);
    }

    public function findSalaById(int $idSala): ?Sala
    {
        $conn = Connection::getConn();

        $sql = "SELECT s.*, m.descricao modalidade_descricao FROM salas s
                JOIN modalidades m ON (m.id = s.modalidade_id)
                WHERE s.id = :id ORDER BY s.data DESC";
        $stm = $conn->prepare($sql);
        $stm->bindValue("id", $idSala);

        $stm->execute();
        $result = $stm->fetchAll(PDO::FETCH_ASSOC);

        $salas = $this->mapSalas($result);

        if (count($salas) > 0) {
            return $salas[0];
        }

        return NULL;

        try {
            $sql = "SELECT * FROM salas WHERE id = :id LIMIT 1";
            $stmt = $this->$conn->prepare($sql);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erro ao buscar sala: " . $e->getMessage();
            return null;
        }
    }

    public function buscarPorModalidade($modalidadeId)
    {

        $conn = Connection::getConn();

        $sql = "SELECT s.*, m.descricao modalidade_descricao FROM salas s
                    JOIN modalidades m ON (m.id = s.modalidade_id)
                    WHERE s.modalidade_id = :modalidadeId
                    ORDER BY s.data DESC";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(":modalidadeId", $modalidadeId, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $this->mapSalas($result);
    }

    public function insert(Sala $sala)
    {
        $conn = Connection::getConn();

        $sql = "INSERT INTO `salas` (`nome_sala`, `criador_id`, `quant_min_jogadores`, `quant_max_jogadores`, `data`, `hora_inicio`, `hora_fim`, `localizacao`, `descricao`, `modalidade_id`) 
                VALUES (:nomeSala, :criadorId, :quantMinJogadores, :quantMaxJogadores, :data, :horaInicio, :horaFim, :localizacao, :descricao, :modalidadeId)";

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
        $stm->bindValue("modalidadeId", $sala->getModalidade()->getId());

        $stm->execute();
    }

    public function update(Sala $sala)
    {
        $conn = Connection::getConn();

        $sql = "UPDATE salas SET nome_sala = :nomeSala, quant_min_jogadores = :quantMinJogadores, quant_max_jogadores = :quantMaxJogadores, 
                    data = :data, hora_inicio = :horaInicio, hora_fim = :horaFim, localizacao = :localizacao, 
                    descricao = :descricao, modalidade_id = :modalidadeId
                WHERE id = :id";

        $stm = $conn->prepare($sql);
        $stm->bindValue("nomeSala", $sala->getNomeSala());
        $stm->bindValue("quantMinJogadores", $sala->getQuantMinJogadores());
        $stm->bindValue("quantMaxJogadores", $sala->getQuantMaxJogadores());
        $stm->bindValue("data", $sala->getData());
        $stm->bindValue("horaInicio", $sala->getHoraInicio());
        $stm->bindValue("horaFim", $sala->getHoraFim());
        $stm->bindValue("localizacao", $sala->getLocalizacao());
        $stm->bindValue("descricao", $sala->getDescricao());
        $stm->bindValue("modalidadeId", $sala->getModalidade()->getId());
        $stm->bindValue("id", $sala->getId());
        $stm->execute();
    }

    public function deleteById(int $id)
    {
        $conn = Connection::getConn();

        $sql = "DELETE FROM salas WHERE id = :id";

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
            $sala->setModalidade(new Modalidade());
            $sala->getModalidade()->setId($salaArray['modalidade_id']);
            $sala->getModalidade()->setDescricao($salaArray['modalidade_descricao']);

            $criador = $userDAO->findById($salaArray['criador_id']);
            $sala->setCriador($criador);

            array_push($salas, $sala);
        }

        return $salas;
    }
}
