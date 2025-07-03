<?php
#Nome do arquivo: UsuarioPapel.php
#Objetivo: classe Enum para os papeis de permissões do model de Usuario

class SalaStatus
{

    public static string $SEPARADOR = "|";

    const JOGADOR = "jogador";
    const ADMINISTRADOR = "administrador";

    public static function getAllAsArray()
    {
        return [SalaStatus::JOGADOR, SalaStatus::ADMINISTRADOR];
    }
}
