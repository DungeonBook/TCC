<?php

include_once(__DIR__ . "/Usuario.php");
include_once(__DIR__ . "/Sala.php");

class SalaJogadores
{

    private ?int $id;
    private ?Usuario $jogador;
    private ?Sala $sala;
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
     * Get the value of jogador
     */
    public function getJogador(): ?Usuario
    {
        return $this->jogador;
    }

    /**
     * Set the value of jogador
     */
    public function setJogador(?Usuario $jogador): self
    {
        $this->jogador = $jogador;

        return $this;
    }

    /**
     * Get the value of sala
     */
    public function getSala(): ?Sala
    {
        return $this->sala;
    }

    /**
     * Set the value of sala
     */
    public function setSala(?Sala $sala): self
    {
        $this->sala = $sala;

        return $this;
    }
}
