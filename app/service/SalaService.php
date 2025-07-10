<?php

require_once(__DIR__ . "/../model/Sala.php");

class SalaService {

    /* Método para validar os dados do usuário que vem do formulário */
    public function criarSala(SalaService $sala)
    {
        $erros = array();

        //Validar campos vazios

        if (! $sala->quantMinJogadores())
            array_push($erros, "O campo quantidade miníma de jogadores é obrigatória.");

        if (! $sala->quantMaxJogadores())
            array_push($erros, "O campo quantidade máxima de jogadores é obrigatória.");

        if (! $sala->horariosDisponiveis())
            array_push($erros, "O campo horarios é obrigatório.");

        if (! $sala->indentificador())
            array_push($erros, "O campo identificador é obrigatório.");

        if (! $sala->modalidade())
            array_push($erros, "O campo modalidade é obrigatório.");

        if (! $sala->descricao())
            array_push($erros, "O campo descrição é obrigatório.");

        return $erros;
    }

    /* Método para validar os dados do usuário que vem do formulário */
    public function validarSala(SalaService $sala)
    {
        $erros = array();

        //Validar campos vazios

        if (! $sala->getQuantMinJogadores())
            array_push($erros, "O campo quantidade miníma de jogadores é obrigatória.");

        if (! $usuario->getQuantMaxJogadores())
            array_push($erros, "O campo quantidade máxima de jogadores é obrigatória.");

        if (! $usuario->getHorariosDisponiveis())
            array_push($erros, "O campo horarios é obrigatório.");

        if (! $usuario->getIndentificador())
            array_push($erros, "O campo identificador é obrigatório.");

        if (! $usuario->getModalidade())
            array_push($erros, "O campo modalidade é obrigatório.");

        if (! $usuario->getDescricao())
            array_push($erros, "O campo descrição é obrigatório.");

        return $erros;
    }
}
