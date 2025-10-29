<?php

include_once(__DIR__ . "/../connection/Connection.php");
include_once(__DIR__ . "/../model/Modalidade.php");

class ModalidadeDAO
{
    public function list()
    {
        $conn = Connection::getConn();

        $sql = "SELECT * FROM modalidades m ORDER BY m.descricao";
        $stm = $conn->prepare($sql);
        $stm->execute();
        $result = $stm->fetchAll(PDO::FETCH_ASSOC);

        return $this->mapModalidade($result);
    }


    private function mapModalidade($arrayDeModalidades)
    {


        $modalidades = array();   

        foreach ($arrayDeModalidades as $modalidadeArray) {

            $modalidade = new Modalidade();
            $modalidade->setId($modalidadeArray['id']);
            $modalidade->setDescricao($modalidadeArray['descricao']);


            array_push($modalidades, $modalidade);
        }

        return $modalidades;
    }
}
