<?php

namespace App\Controllers;

use App\Models\User;
use PDOException;

class Auth
{
    public $user;

    public function __construct(array $user)
    {

        $this->user = $user;
    }

    public function login()
    {
        session_start();

        $user_class = new User($this->user);
        $isUser = $user_class->existUser();
        
        if (!$isUser) {
            session_destroy();
            throw new PDOException("Esse usuario não existe na base");
        }
 
        $_SESSION['login'] = $isUser["login"];
        $_SESSION['senha'] = $isUser["senha"];
        $_SESSION['nome'] = $isUser["nome"];
        $_SESSION['tipo_usuario'] = $isUser["tipo_usuario"];
        $_SESSION['tipo_servico'] = $isUser["tipo_usuario"];

        return $isUser;
    }

    public function createAccount()
    {
        $user_class =  new User($this->user);

        if ($user_class->existUser()) {

            throw new PDOException("Esse usuario já existe na base");
        }

        return  $user_class->createUser();
    }


    public function logout()
    {
        session_destroy();
    }
}
