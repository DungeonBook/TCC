<?php
#Nome do arquivo: UsuarioPapel.php
#Objetivo: classe Enum para os papeis de permissões do model de Usuario

class SalaStatus
{

    public static string $SEPARADOR = "|";

    const ATIVO = "ativo";
    const INATIVO = "inativo";

    public static function getAllAsArray()
    {
        return [SalaStatus::ATIVO, SalaStatus::INATIVO];
    }
}
