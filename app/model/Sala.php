<?php

include_once(__DIR__ . "/Sala.php");

class Sala {

    private ?int $id;
    private ?Usuario $usuario;
    private ?int $quantMinJogadores;
    private ?int $quantMaxJogadores;
    private ?string $horariosDisponiveis;
    private ?string $indentificador;
    private ?string $modalidade;
    private ?string $descricao;
    private ?int $status;
    

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
     * Get the value of usuario
     */
    public function getUsuario(): ?Usuario
    {
        return $this->usuario;
    }

    /**
     * Set the value of usuario
     */
    public function setUsuario(?Usuario $usuario): self
    {
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * Get the value of quantMinJogadores
     */
    public function getQuantMinJogadores(): ?int
    {
        return $this->quantMinJogadores;
    }

    /**
     * Set the value of quantMinJogadores
     */
    public function setQuantMinJogadores(?int $quantMinJogadores): self
    {
        $this->quantMinJogadores = $quantMinJogadores;

        return $this;
    }

    /**
     * Get the value of quantMaxJogadores
     */
    public function getQuantMaxJogadores(): ?int
    {
        return $this->quantMaxJogadores;
    }

    /**
     * Set the value of quantMaxJogadores
     */
    public function setQuantMaxJogadores(?int $quantMaxJogadores): self
    {
        $this->quantMaxJogadores = $quantMaxJogadores;

        return $this;
    }

    /**
     * Get the value of horariosDisponiveis
     */
    public function getHorariosDisponiveis(): ?string
    {
        return $this->horariosDisponiveis;
    }

    /**
     * Set the value of horariosDisponiveis
     */
    public function setHorariosDisponiveis(?string $horariosDisponiveis): self
    {
        $this->horariosDisponiveis = $horariosDisponiveis;

        return $this;
    }

    /**
     * Get the value of indentificador
     */
    public function getIndentificador(): ?string
    {
        return $this->indentificador;
    }

    /**
     * Set the value of indentificador
     */
    public function setIndentificador(?string $indentificador): self
    {
        $this->indentificador = $indentificador;

        return $this;
    }

    /**
     * Get the value of modalidade
     */
    public function getModalidade(): ?string
    {
        return $this->modalidade;
    }

    /**
     * Set the value of modalidade
     */
    public function setModalidade(?string $modalidade): self
    {
        $this->modalidade = $modalidade;

        return $this;
    }

    /**
     * Get the value of descricao
     */
    public function getDescricao(): ?string
    {
        return $this->descricao;
    }

    /**
     * Set the value of descricao
     */
    public function setDescricao(?string $descricao): self
    {
        $this->descricao = $descricao;

        return $this;
    }

    /**
     * Get the value of status
     */
    public function getStatus(): ?int
    {
        return $this->status;
    }

    /**
     * Set the value of status
     */
    public function setStatus(?int $status): self
    {
        $this->status = $status;

        return $this;
    }
}