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
    public function criarSala(array $dados): Sala
    {
        $nome = trim($dados['nome'] ?? '');
        $descricao = trim($dados['descricao'] ?? '');

        if (empty($nome)) {
            throw new Exception("O nome da sala é obrigatório.");
        }

        // Cria o objeto Sala preenchendo os dados
        $sala = new Sala();
        $sala->setNome($nome);
        $sala->setDescricao($descricao);

        // Aqui você pode incluir regras de negócio adicionais
        // Ex: Limitar o tamanho do nome ou impedir palavras proibidas

        return $sala;
    }

    /**
     * Exemplo de validação para remoção de sala
     * (opcional - depende da sua regra de negócio)
     */
    public function validarRemocao(Sala $sala)
    {
        // Exemplo: impedir exclusão se sala for "Principal"
        if (strtolower($sala->getNome()) === 'principal') {
            throw new Exception("A sala Principal não pode ser removida.");
        }
    }
}
