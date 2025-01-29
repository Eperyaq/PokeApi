<?php  
    // Importa el archivo que maneja los datos en formato JSON
    require_once "jsonhandler.php";

    $error = false; // Indicador para saber si hay error en el login
    $usuario = "";
    $password = "";

    // Verifica si se han enviado los datos del formulario
    if( isset($_POST["usuario"]) && isset($_POST["password"]) ){
        $usuario = $_POST["usuario"];  
        $password = $_POST["password"];

        // Carga los usuarios almacenados en el archivo JSON
        $usuarios = loadEventsFromJson();

        $encontrado = false; // Variable para verificar si el usuario existe

        // Recorre la lista de usuarios para comprobar si coinciden usuario y contraseña
        foreach($usuarios as $user){
            if($user["nombre"] == $usuario && $user["password"] == $password){
                $nombre = $user["nombre"]; // Guarda el nombre del usuario autenticado
                $encontrado = true;
                break; // Detiene la búsqueda al encontrar el usuario
            }
        }

        // Si el usuario fue encontrado, carga la API
        if($encontrado){
            require_once "api.php";
        } else { 
            // Si no fue encontrado, vuelve a la página de login y marca error
            require_once "do_login.php";
            $error = true;
        }
    }
?>
