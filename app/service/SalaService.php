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
        array_push($erros, "O campo [Nome da sala] é obrigatório.");

    if (! $sala->getQuantMinJogadores())
        array_push($erros, "O campo [quantidade mínima de jogadores] é obrigatório.");

    if (! $sala->getQuantMaxJogadores())
        array_push($erros, "O campo [quantidade máxima de jogadores] é obrigatório.");

    if ($sala->getQuantMinJogadores() !== null && $sala->getQuantMinJogadores() < 4)
        array_push($erros, "A quantidade mínima de jogadores deve ser maior que 3.");

    if ($sala->getQuantMaxJogadores() !== null && $sala->getQuantMaxJogadores() > 10)
        array_push($erros, "A quantidade máxima de jogadores é 10.");

    if ($sala->getQuantMinJogadores() !== null && $sala->getQuantMaxJogadores() !== null && 
        $sala->getQuantMinJogadores() > $sala->getQuantMaxJogadores())
        array_push($erros, "A quantidade mínima de jogadores não pode ser maior que a quantidade máxima.");

    if (! $sala->getData())
        array_push($erros, "O campo [data da partida] é obrigatório.");

    if (! $sala->getHoraInicio())
        array_push($erros, "O campo [hora de início da partida] é obrigatório.");

    if (! $sala->getHoraFim())
        array_push($erros, "O campo [hora de término da partida] é obrigatório");

    if (! $sala->getLocalizacao())
        array_push($erros, "O campo [localização] é obrigatório");

    if (! $sala->getDescricao())
        array_push($erros, "O campo [descrição] é obrigatório");
    
    if (! $sala->getModalidade() || ! $sala->getModalidade()->getId())
        array_push($erros, "O campo [modalidade] é obrigatório");

    return $erros;

    }
}    