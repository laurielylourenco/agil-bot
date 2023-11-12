<?php

namespace App\Routes\AuthRoute;

error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once '/var/www/html/learn-bot/agil-bot/vendor/autoload.php';


use App\Controllers\Auth;
use PDOException;

$metodo = $_POST['metodo'];
$nome = $_POST['name'];
$telefone = $_POST['telefone'];
$username = $_POST['username'];
$password = $_POST['password'];

try {

    if (is_null($metodo)) {
        throw new PDOException("Metodo não definido");
        http_response_code(400);
    }


    if (is_null($nome) || is_null($telefone) || is_null($username)  || is_null($password)) {
        throw new PDOException("Algum parametro está vazio!!");
        http_response_code(400);
    }

    $user = [
        "login" => $username,
        "senha" => $password,
        "nome" => $nome,
        "telefone" => $telefone,
        "tipo_servico" => 1,
        "tipo_usuario" => 1
    ];

    $auth = new Auth($user);

    switch ($metodo) {
        case 'criarConta':

            if ($auth->createAccount()) {

                http_response_code(201);

                echo json_encode([
                    "status" => true,
                    "message" => "Usuario criado"
                ]);

                header("Location: http://localhost/learn-bot/agil-bot/app/Views/Auth/login.php");
            } else {

                echo json_encode([
                    "status" => true,
                    "message" => "Erro ao criar usuario"
                ]);
                http_response_code(404);
            }

            break;

        case 'login':

            if ($auth->login()) {

                echo json_encode([
                    "status" => true,
                    "message" => "Existe esse usuario"
                ]);


                header("Location: http://localhost/learn-bot/agil-bot/app/Views/Auth/login.php");
            } else {

                echo json_encode([
                    "status" => false,
                    "message" => "Existe não esse usuario"
                ]);
                http_response_code(404);
            }

            break;

        default:
            throw new PDOException("Metodo não encontrado");
            http_response_code(400);
            break;
    }
} catch (\Throwable $th) {


    echo json_encode([
        "status" => false,
        "message" => $th->getMessage(),
    ]);
}
