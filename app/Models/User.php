<?php

namespace App\Models;

use App\Controllers\Conn;

use PDO;
use PDOException;

class User
{

    private $nome;
    private $senha;
    private $login;
    private $telefone;
    private $tipo_usuario;
    private $tipo_servico;


    public function __construct(array $user)
    {
        $this->nome = $user['nome'];
        $this->senha = $user['senha'];
        $this->login = $user['login'];
        $this->telefone = $user['telefone'];
        $this->tipo_servico = $user['tipo_servico'];
        $this->tipo_usuario = $user['tipo_usuario'];
    }


    public function createUser(): bool
    {

        $conn = Conn::getInstance();

        $stmt =  $conn->prepare("
            INSERT INTO  
                usuario (login, senha, nome, telefone, tipo_usuario, tipo_servico) 
            VALUES 
                (:login, :senha, :nome, :telefone, :tipo_usuario, :tipo_servico)
        ");

        // Atribuição dos valores aos placeholders
        $stmt->bindValue(':login', $this->login);
        $stmt->bindValue(':senha', $this->senha);
        $stmt->bindValue(':nome', $this->nome);
        $stmt->bindValue(':telefone', $this->telefone);
        $stmt->bindValue(':tipo_usuario', $this->tipo_usuario);  // Valor fixo '1' para tipo_usuario
        $stmt->bindValue(':tipo_servico', $this->tipo_servico);  // Valor fixo '1' para tipo_servico

        // Executa a consulta preparada
        return  $stmt->execute();
    }

    public function existUser()
    {

        $conn = Conn::getInstance();
        $sql = "SELECT * FROM usuario WHERE login = '{$this->login}' ";
        $query =  $conn->query($sql);
        $total = $query->fetchAll(PDO::FETCH_ASSOC);
        $user = false;

        if (count($total) > 0) {
            foreach ($total as $tabela_usuarios) {

                $user =  array(
                "login" => $tabela_usuarios['login'], 
                "senha" => $tabela_usuarios['senha'], 
                "nome" => $tabela_usuarios['nome'], 
                "tipo_usuario" => $tabela_usuarios['tipo_usuario'],
                "tipo_servico" => $tabela_usuarios['tipo_servico']
                );
            }

            return $user;
        }
        return false;
    }
}
