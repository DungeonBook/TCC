<?php

class UsuarioPapel
{

    public static string $SEPARADOR = "|";

    const JOGADOR = "Jogador";
    const ADMINISTRADOR = "Administrador";

    public static function getAllAsArray()
    {
        return [UsuarioPapel::JOGADOR, UsuarioPapel::ADMINISTRADOR];
    }
}
