<?php

include_once(__DIR__ . "/../connection/Connection.php");
include_once(__DIR__ . "/../model/Sala.php");

class SalaDAO
{

    //Método para listar os usuários a partir da base de dados
    public function list()
    {
        $conn = Connection::getConn();

        $sql = "SELECT * FROM salas s ORDER BY s.descricao";
        $stm = $conn->prepare($sql);
        $stm->execute();
        $result = $stm->fetchAll();

        return $this->mapSalas($result);
    }

    public function listByUsuario(int $idUsuario)
    {
        $conn = Connection::getConn();

        $sql = "SELECT * FROM salas s ORDER BY s.descricao";
        $stm = $conn->prepare($sql);
        $stm->execute();
        $result = $stm->fetchAll();

        return $this->mapSalas($result);

            if (count($sala) == 1)
            return $sala[0];
        elseif (count($sala) == 0)
            return null;

        die("SalaDAO.findById()" .
            " - Erro: mais de uma sala encontrada.");
    }

     //Método para buscar um usuário por seu email e senha
    public function findByIdentificador(string $identificador)
    {
        $conn = Connection::getConn();

        $sql = "SELECT * FROM salas s";
        $stm = $conn->prepare($sql);
        $stm->execute([$identificador]);
        $result = $stm->fetchAll();

        $sala = $this->mapSalas($result);

        if (count($sala) == 1) {
            //Tratamento para senha criptografada
            if (password_verify($identificador[0]->getIdentificador()))
                return $sala[0];
            else
                return null;
        } elseif (count($sala) == 0)
            return null;

        die("SalaDAO.findByIdentificador()" .
            " - Erro: mais de uma sala encontrada.");
    }

    public function insert(Sala $sala)
    {
        //TODO - mudar os parametros
        $conn = Connection::getConn();

        $sql = "INSERT INTO sala (quantMinJogadores, quantMaxJogadores, horariosDisponiveis, indentificador, modalidade, descricao)" .
            " VALUES (:quantMinJogadores, :quantMaxJogadores, :horariosDisponiveis, :indentificador, :modalidade, :descricao)";

        $identificador = password_hash($sala->getIdentificador(), PASSWORD_DEFAULT);

        $stm = $conn->prepare($sql);
        $stm->bindValue("quantMinJogadores", $sala->getQuantMinJogadores());
        $stm->bindValue("quantMaxJogadores", $sala->getQuantMaxJogadores());
        $stm->bindValue("horariosDisponiveis", $sala->getHorariosDisponiveis());
        $stm->bindValue("indentificador", $sala->getIndentificador());
        $stm->bindValue("modalidade", $sal->getModalidade());
        $stm->bindValue("descricao", $sala->getDescricao());
        $stm->execute();
    }

    //Método para atualizar um Usuario
    public function update(Sala $sala)
    {
        $conn = Connection::getConn();

        $sql = "UPDATE sala SET quantMinJogadores = :quantMinJogadores, quantMaxJogadores = :quantMaxJogadores, horariosDisponiveis = :horariosDisponiveis," .
            " indentificador = :indentificador, modalidade = :modalidade, descricao = :descricao, WHERE id = :id";

        $stm = $conn->prepare($sql);
        $stm->bindValue("quantMinJogadores", $sala->getQuantMinJogadores());
        $stm->bindValue("quantMaxJogadores", $sala->getQuantMaxJogadores());
        $stm->bindValue("horariosDisponiveis", $sala->getHorariosDisponiveis());
        $stm->bindValue("indentificador", password_hash($sala->getIndentificador(), PASSWORD_DEFAULT));
        $stm->bindValue("modalidade", $sala->getModalidade());
        $stm->bindValue("descricao", $sala->getDescricao());
        $stm->bindValue("id", $sala->getId());
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

    private function mapSalas($result)
    {
        $sala = array();
        foreach ($result as $reg) {
            $sala = new Sala();
            $sala->setId($reg['id']);
            $sala->setQuantMinJogadores($reg['quant_min_jogadores']);
            $sala->setQuantMaxJogadores($reg['quant_max_jogadores']);
            $sala->setHorariosDisponiveis($reg['horarios_disponiveis']);
            $sala->setIndentificador($reg[null]);
            $sala->setModalidade($reg['modalidade']);
            $sala->setDescricao($reg['descricao']);
            $sala->setStatus($reg['status']);
            array_push($usuarios, $sala);
        }

        return $sala;
    }
}