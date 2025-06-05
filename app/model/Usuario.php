<?php
#Nome do arquivo: Usuario.php
#Objetivo: classe Model para Usuario

require_once(__DIR__ . "/enum/UsuarioPapel.php");

class Usuario
{

    private ?int $id;
    private ?string $papel;
    private ?string $nome;
    private ?string $apelido;
    private ?string $email;
    private ?string $telefone;
    private ?string $dataNascimento;
    private ?string $senha;
    private ?string $foto;

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
     * Get the value of papel
     */
    public function getPapel(): ?string
    {
        return $this->papel;
    }

    /**
     * Set the value of papel
     */
    public function setPapel(?string $papel): self
    {
        $this->papel = $papel;

        return $this;
    }

    /**
     * Get the value of nome
     */
    public function getNome(): ?string
    {
        return $this->nome;
    }

    /**
     * Set the value of nome
     */
    public function setNome(?string $nome): self
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Get the value of apelido
     */
    public function getApelido(): ?string
    {
        return $this->apelido;
    }

    /**
     * Set the value of apelido
     */
    public function setApelido(?string $apelido): self
    {
        $this->apelido = $apelido;

        return $this;
    }

    /**
     * Get the value of email
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * Set the value of email
     */
    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of telefone
     */
    public function getTelefone(): ?string
    {
        return $this->telefone;
    }

    /**
     * Set the value of telefone
     */
    public function setTelefone(?string $telefone): self
    {
        $this->telefone = $telefone;

        return $this;
    }

    /**
     * Get the value of dataNascimento
     */
    public function getDataNascimento(): ?string
    {
        return $this->dataNascimento;
    }

    /**
     * Set the value of dataNascimento
     */
    public function setDataNascimento(?string $dataNascimento): self
    {
        $this->dataNascimento = $dataNascimento;

        return $this;
    }

    /**
     * Get the value of senha
     */
    public function getSenha(): ?string
    {
        return $this->senha;
    }

    /**
     * Set the value of senha
     */
    public function setSenha(?string $senha): self
    {
        $this->senha = $senha;

        return $this;
    }

    /**
     * Get the value of foto
     */
    public function getFoto(): ?string
    {
        return $this->foto;
    }

    /**
     * Set the value of foto
     */
    public function setFoto(?string $foto): self
    {
        $this->foto = $foto;

        return $this;
    }
}
