<?php
#Nome do arquivo: UsuarioPapel.php
#Objetivo: classe Enum para os papeis de permissões do model de Usuario

class UsuarioPapel
{

    public static string $SEPARADOR = "|";

    const JOGADOR = "jogador";
    const ADMINISTRADOR = "administrador";

    public static function getAllAsArray()
    {
        return [UsuarioPapel::JOGADOR, UsuarioPapel::ADMINISTRADOR];
    }
}
