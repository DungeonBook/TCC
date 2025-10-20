<?php

include_once(__DIR__ . "/../connection/Connection.php");
include_once(__DIR__ . "/../model/Usuario.php");

class UsuarioDAO
{

    public function list()
    {
        $conn = Connection::getConn();

        $sql = "SELECT * FROM usuarios u ORDER BY u.nome";
        $stm = $conn->prepare($sql);
        $stm->execute();
        $result = $stm->fetchAll();

        return $this->mapUsuarios($result);
    }

    public function findById(int $id)
    {
        $conn = Connection::getConn();

        $sql = "SELECT * FROM usuarios u" .
            " WHERE u.id = ?";
        $stm = $conn->prepare($sql);
        $stm->execute([$id]);
        $result = $stm->fetchAll();

        $usuarios = $this->mapUsuarios($result);

        if (count($usuarios) == 1)
            return $usuarios[0];
        elseif (count($usuarios) == 0)
            return null;

        die("UsuarioDAO.findById()" .
            " - Erro: mais de um usuário encontrado.");
    }

    public function findByApelido(string $apelido)
    {
        $conn = Connection::getConn();

        $sql = "SELECT * FROM usuarios u WHERE u.apelido = ?";
        $stm = $conn->prepare($sql);
        $stm->execute([$apelido]);
        $result = $stm->fetchAll();

        $usuarios = $this->mapUsuarios($result);

        if (count($usuarios) == 1)
            return $usuarios[0];
        elseif (count($usuarios) == 0)
            return null;

        die("UsuarioDAO.findByApelido()" .
            " - Erro: mais de um usuário encontrado.");
    }

    public function findByEmail(string $email)
    {
        $conn = Connection::getConn();

        $sql = "SELECT * FROM usuarios u WHERE u.email = ?";
        $stm = $conn->prepare($sql);
        $stm->execute([$email]);
        $result = $stm->fetchAll();

        $usuarios = $this->mapUsuarios($result);

        if (count($usuarios) == 1)
            return $usuarios[0];
        elseif (count($usuarios) == 0)
            return null;

        die("UsuarioDAO.findByApelido()" .
            " - Erro: mais de um usuário encontrado.");
    }

    public function findByEmailSenha(string $email, string $senha)
    {
        $conn = Connection::getConn();

        $sql = "SELECT * FROM usuarios u" .
            " WHERE BINARY u.email = ?";
        $stm = $conn->prepare($sql);
        $stm->execute([$email]);
        $result = $stm->fetchAll();

        $usuarios = $this->mapUsuarios($result);

        if (count($usuarios) == 1) {
            if (password_verify($senha, $usuarios[0]->getSenha()))
                return $usuarios[0];
            else
                return null;
        } elseif (count($usuarios) == 0)
            return null;

        die("UsuarioDAO.findByEmailSenha()" .
            " - Erro: mais de um usuário encontrado.");
    }

    public function insert(Usuario $usuario)
    {
        $conn = Connection::getConn();

        $sql = "INSERT INTO usuarios (papel, nome, apelido, email, telefone, data_nascimento, senha, foto)" .
            " VALUES (:papel, :nome, :apelido, :email, :telefone, :data_nascimento, :senha, :foto)";

        $senhaCripto = password_hash($usuario->getSenha(), PASSWORD_DEFAULT);

        $stm = $conn->prepare($sql);
        $stm->bindValue("papel", $usuario->getPapel());
        $stm->bindValue("nome", $usuario->getNome());
        $stm->bindValue("apelido", $usuario->getApelido());
        $stm->bindValue("email", $usuario->getEmail());
        $stm->bindValue("telefone", $usuario->getTelefone());
        $stm->bindValue("data_nascimento", $usuario->getDataNascimento());
        $stm->bindValue("senha", $senhaCripto);
        $stm->bindValue("foto", $usuario->getFoto());
        $stm->execute();
    }

    public function update(Usuario $usuario)
    {
        $conn = Connection::getConn();

        $sql = "UPDATE usuarios SET nome = :nome, apelido = :apelido, email = :email," .
            " telefone = :telefone, data_nascimento = :data_nascimento," .
            " senha = :senha, foto = :foto, papel = :papel" .
            " WHERE id = :id";

        $stm = $conn->prepare($sql);
        $stm->bindValue("nome", $usuario->getNome());
        $stm->bindValue("apelido", $usuario->getApelido());
        $stm->bindValue("email", $usuario->getEmail());
        $stm->bindValue("telefone", $usuario->getTelefone());
        $stm->bindValue("data_nascimento", $usuario->getDataNascimento());
        $stm->bindValue("senha", password_hash($usuario->getSenha(), PASSWORD_DEFAULT));
        $stm->bindValue("foto", $usuario->getFoto());
        $stm->bindValue("papel", $usuario->getPapel());
        $stm->bindValue("id", $usuario->getId());
        $stm->execute();
    }

    public function updatePerfil(Usuario $usuario)
    {
        $conn = Connection::getConn();

        $sql = "UPDATE usuarios SET nome = :nome, apelido = :apelido, email = :email," .
            " telefone = :telefone, data_nascimento = :data_nascimento," .
            " senha = :senha, foto = :foto" .
            " WHERE id = :id";

        $stm = $conn->prepare($sql);
        $stm->bindValue("nome", $usuario->getNome());
        $stm->bindValue("apelido", $usuario->getApelido());
        $stm->bindValue("email", $usuario->getEmail());
        $stm->bindValue("telefone", $usuario->getTelefone());
        $stm->bindValue("data_nascimento", $usuario->getDataNascimento());
        $stm->bindValue("senha", password_hash($usuario->getSenha(), PASSWORD_DEFAULT));
        $stm->bindValue("foto", $usuario->getFoto());
        $stm->bindValue("id", $usuario->getId());
        $stm->execute();
    }

    public function deleteById(int $id)
    {
        $conn = Connection::getConn();

        $sql = "DELETE FROM usuarios WHERE id = :id";

        $stm = $conn->prepare($sql);
        $stm->bindValue("id", $id);
        $stm->execute();
    }

    public function updateFotoPerfil(Usuario $usuario)
    {
        $conn = Connection::getConn();

        $sql = "UPDATE usuarios SET foto = ? WHERE id = ?";

        $stm = $conn->prepare($sql);
        $stm->execute(array($usuario->getFoto(), $usuario->getId()));
    }

    public function quantidadeUsuarios()
    {
        $conn = Connection::getConn();

        $sql = "SELECT COUNT(*) AS qtd_usuarios FROM usuarios";

        $stm = $conn->prepare($sql);
        $stm->execute();
        $result = $stm->fetchAll();

        return $result[0]["qtd_usuarios"];
    }

    private function mapUsuarios($result)
    {
        $usuarios = array();
        foreach ($result as $reg) {
            $usuario = new Usuario();
            $usuario->setId($reg['id']);
            $usuario->setPapel($reg['papel']);
            $usuario->setNome($reg['nome']);
            $usuario->setApelido($reg['apelido']);
            $usuario->setEmail($reg['email']);
            $usuario->setTelefone($reg['telefone']);
            $usuario->setDataNascimento($reg['data_nascimento']);
            $usuario->setSenha($reg['senha']);
            $usuario->setFoto($reg['foto']);
            array_push($usuarios, $usuario);
        }

        return $usuarios;
    }
}
