<?php

class Chat
{

    private ?int $id;
    private ?salaJogadores $salaJogadores;
    private ?int $dataHora;
    private ?string $mensagem;

    /**
     * Get the value of id
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Set the value of id
     */
    public function setId(?int $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of salaJogadores
     */
    public function getSalaJogadores(): ?salaJogadores
    {
        return $this->salaJogadores;
    }

    /**
     * Set the value of salaJogadores
     */
    public function setSalaJogadores(?salaJogadores $salaJogadores): self
    {
        $this->salaJogadores = $salaJogadores;

        return $this;
    }

    /**
     * Get the value of dataHora
     */
    public function getDataHora(): ?int
    {
        return $this->dataHora;
    }

    /**
     * Set the value of dataHora
     */
    public function setDataHora(?int $dataHora): self
    {
        $this->dataHora = $dataHora;

        return $this;
    }

    /**
     * Get the value of mensagem
     */
    public function getMensagem(): ?string
    {
        return $this->mensagem;
    }

    /**
     * Set the value of mensagem
     */
    public function setMensagem(?string $mensagem): self
    {
        $this->mensagem = $mensagem;

        return $this;
    }
}