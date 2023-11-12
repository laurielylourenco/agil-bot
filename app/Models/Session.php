<?php

use App\Controllers\Conn;

session_start();

class SessionUser{



    function existeSessionUser(): bool {
        
        $conn = Conn::getInstance();
    
        $email_usuario = $_SESSION['email'];
        $senha_usuario = $_SESSION['senha'];

        $sql = "SELECT * FROM usuario WHERE login = '$email_usuario' AND senha = '$senha_usuario'";
        $query =  $conn->query($sql);
        $total = $query->fetchAll(PDO::FETCH_ASSOC);


        if (count($total) > 0) {
            return true;
        }
        return false;

    }

}


?>