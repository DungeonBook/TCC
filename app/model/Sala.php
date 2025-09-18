<?php

include_once(__DIR__ . "/Modalidade.php");
include_once(__DIR__ . "/Usuario.php");
include_once(__DIR__ . "/salaJogadores.php");

class Sala
{

    private ?int $id;
    private ?string $nomeSala;
    private ?Usuario $criador = null;
    private ?int $quantMinJogadores;
    private ?int $quantMaxJogadores;
    private ?string $data;
    private ?string $horaInicio;
    private ?string $horaFim;
    private ?string $localizacao;
    private ?string $descricao;
    private ?Modalidade $modalidade;


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
     * Get the value of nomeSala
     */
    public function getNomeSala(): ?string
    {
        return $this->nomeSala;
    }

    /**
     * Set the value of nomeSala
     */
    public function setNomeSala(?string $nomeSala): self
    {
        $this->nomeSala = $nomeSala;

        return $this;
    }

    /**
     * Get the value of criador
     */
    public function getCriador(): ?Usuario
    {
        return $this->criador;
    }

    /**
     * Set the value of criador
     */
    public function setCriador(?Usuario $criador): self
    {
        $this->criador = $criador;

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
     * Get the value of data
     */
    public function getData(): ?string
    {
        return $this->data;
    }

    public function getDataFormatada(): ?string
    {
        if($this->data) {
            $date = date_create($this->data);
            return date_format($date, 'd/m/Y');
        }
        return "";
    }

    /**
     * Set the value of data
     */
    public function setData(?string $data): self
    {
        $this->data = $data;
        $data = date_create(date('D-m-Y'));

        return $this;
    }

    /**
     * Get the value of horaInicio
     */
    public function getHoraInicio(): ?string
    {
        return $this->horaInicio;
    }

    /**
     * Set the value of horaInicio
     */
    public function setHoraInicio(?string $horaInicio): self
    {
        $this->horaInicio = $horaInicio;

        return $this;
    }

    /**
     * Get the value of horaFim
     */
    public function getHoraFim(): ?string
    {
        return $this->horaFim;
    }

    /**
     * Set the value of horaFim
     */
    public function setHoraFim(?string $horaFim): self
    {
        $this->horaFim = $horaFim;

        return $this;
    }

    /**
     * Get the value of localizacao
     */
    public function getLocalizacao(): ?string
    {
        return $this->localizacao;
    }

    /**
     * Set the value of localizacao
     */
    public function setLocalizacao(?string $localizacao): self
    {
        $this->localizacao = $localizacao;

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

    /**5
     * Get the value of modalidade
     */
    public function getModalidade(): ?Modalidade
    {
        return $this->modalidade;
    }

    /**
     * Set the value of modalidade
     */
    public function setModalidade(?Modalidade $modalidade): self
    {
        $this->modalidade = $modalidade;

        return $this;
    }

    /**
     * Get the value of status
     */
    public function getStatus(): bool
    {
        if($this->data && $this->horaInicio) {
            $horaJogo = date_create($this->data . " " . $this->horaInicio);
            $horaAtual = date_create(date('D-m-y H:i:s'));
            return $horaAtual < $horaJogo;
        }        
        
        return false;
    }

    public function getStatusDescricao() : string {
        if($this->getStatus())
            return "Ativa";

        return "Inativa";
    }

    public function __toString(): string{
        return "{$this->id}, {$this->nomeSala}, {$this->criador}, {$this->quantMinJogadores}, {$this->quantMaxJogadores}, {$this->data}, {$this->horaInicio}, {$this->horaFim}, {$this->localizacao}, {$this->descricao}, {$this->modalidade}, {$this->getStatus()}"; 
    }
}