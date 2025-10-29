<?php

include_once(__DIR__ . "/../connection/Connection.php");

class SalaJogadoresDAO
{

    public function insert(int $salaId, int $usuarioId)
    {
        $conn = Connection::getConn();

        $sql = "INSERT INTO salas_jogadores (usuario_id, sala_id)
                VALUES (?, ?)";

        $stm = $conn->prepare($sql);
        $stm->execute([$usuarioId, $salaId]);
    }

    public function listJogadoresBySala(int $salaId)
    {
        $conn = Connection::getConn();

        $sql = "SELECT u.*, sj.sala_id 
                FROM salas_jogadores sj
                    JOIN usuarios u ON (u.id = sj.usuario_id)
                WHERE sj.sala_id = :sala_id
                ORDER BY u.apelido ASC";

        $stm = $conn->prepare($sql);
        $stm->bindValue(":sala_id", $salaId, PDO::PARAM_INT);
        $stm->execute();

        $result = $stm->fetchAll(PDO::FETCH_ASSOC);

        return $this->mapJogadores($result);
    }

    private function mapJogadores(array $rows)
    {
        $jogadores = [];

        foreach ($rows as $row) {
            $jogadores[] = [
                'id' => $row['id'],
                'apelido' => $row['apelido'] ?? null,
                'email' => $row['email'] ?? null,
                'sala_id' => $row['sala_id'] ?? null
            ];
        }

        return $jogadores;
    }
}
