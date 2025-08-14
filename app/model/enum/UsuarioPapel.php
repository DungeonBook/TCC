<?php

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
