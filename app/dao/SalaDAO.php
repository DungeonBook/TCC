<?php

include_once(__DIR__ . "/../connection/Connection.php");
include_once(__DIR__ . "/../model/Sala.php");

class SalaDAO
{

    //Método para listar os usuaários a partir da base de dados
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
            $sala->setIndentificador($reg['identificador']);
            $sala->setModalidade($reg['modalidade']);
            $sala->setDescricao($reg['descricao']);
            $sala->setStatus($reg['status']);
            array_push($usuarios, $sala);
        }

        return $sala;
    }
}