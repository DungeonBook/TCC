<?php
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
