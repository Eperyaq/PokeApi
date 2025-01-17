<?php 
        require_once "jsonhandler.php";
    
        if(isset($_POST["nombre"]) && isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["password2"])){
            $nombre = $_POST["nombre"];
            $email = $_POST["email"];
            $password = $_POST["password"];
            $password2 = $_POST["password2"];

            $usuario = [$nombre, $email, $password];

            if($password == $password2){
                saveEventsToJson($usuario);
                require_once "index.php"; 
            }else{
                echo "Las contraseñas no coinciden.";
            }
        }
    
?> 