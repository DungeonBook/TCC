<?php 

include_once(__DIR__ . "/../connection/Connection.php");

class SalaJogadoresDAO {

    public function insert(int $salaId, int $usuarioId) {
        $conn = Connection::getConn();

        $sql = "INSERT INTO salas_jogadores (usuario_id, sala_id)
                VALUES (?, ?)";

        $stm = $conn->prepare($sql);
        $stm->execute([$usuarioId, $salaId]);
    }

    public function listJogadoresBySala(int $salaId) {
        //TODO fazer o join para o usuario cadastrado na sala 
    }


}