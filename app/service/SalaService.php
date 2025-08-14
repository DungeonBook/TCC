<?php

require_once(__DIR__ . "/../model/Sala.php");

class SalaService
{
    /**
     * Valida e cria uma Sala a partir dos dados recebidos do formulário ou de uma requisição
     * @param array $dados
     * @return Sala
     * @throws Exception se algum dado estiver inválido
     */
    /* Método para validar os dados do usuário que vem do formulário */
    public function validarDados(Sala $sala): array | null
    {
        $erros = array();

        if (! $sala->getNomeSala())
            array_push($erros, "O campo nome da sala é obrigatório.");

        if (! $sala->getCriador())
            array_push($erros, "O campo mestre de mesa é obrigatório.");

        if (! $sala->getQuantMinJogadores())
            array_push($erros, "O campo quantidade miníma de jogadores é obrigatório.");

        if (! $sala->getQuantMaxJogadores())
            array_push($erros, "O campo quantidade máxima de jogadores é obrigatório.");

        if (! $sala->getData())
            array_push($erros, "O campo data da partida é obrigatório.");

        if (! $sala->getHoraInicio())
            array_push($erros, "O campo hora de início da partida é obrigatório.");

        if (! $sala->getHoraFim())
            array_push($erros, "O campo hora de término da partida é obrigatório");

        if (! $sala->getLocalizacao())
            array_push($erros, "O campo localização é obrigatório");

        if (! $sala->getModalidade())
            array_push($erros, "O campo modalidade é obrigatório");

        if (! $sala->getDescricao())
            array_push($erros, "O campo descrição é obrigatório");

        // if (! $sala->getStatus())
        //     array_push($erros, "O campo status é obrigatório");

        return $erros;
    }
}
