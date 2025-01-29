<?php 
    // Importa el archivo encargado de manejar los datos en formato JSON
    require_once "jsonhandler.php";

    // Verifica si se han recibido todos los datos del formulario
    if(isset($_POST["nombre"]) && isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["password2"])){
        $nombre = $_POST["nombre"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $password2 = $_POST["password2"];

        // Se crea un array asociativo con los datos del usuario
        $usuario = [ 
            "nombre" => $nombre, 
            "email" => $email, 
            "password" => $password
        ];

        // Carga la lista de usuarios almacenada en el archivo JSON
        $usuariosJson = loadEventsFromJson();

        $rep = false; // Variable para verificar si el email ya está registrado
        $fallo = false; // Variable para indicar si hay algún error en el registro

        // Verifica que las contraseñas coincidan
        if($password == $password2){

            // Si hay usuarios registrados, verifica si el email ya existe
            if(count($usuariosJson) > 0){
                foreach($usuariosJson as $usuarioSuelto){
                    if($usuarioSuelto["email"] == $email){
                        $rep = true; // Marca que el email ya está registrado
                        $fallo = true;
                        
                        require_once "do_register.php"; // Redirige al formulario de registro nuevamente
                    }
                }

                // Si el email no está repetido, guarda el nuevo usuario y redirige a la API
                if($rep == false){
                    saveEventsToJson($usuario);
                    require_once "api.php";
                }
                
            }else{
                // Si no hay usuarios registrados, guarda el primer usuario
                saveEventsToJson($usuario);
                require_once "api.php"; 
            }

        }else{
            // Si las contraseñas no coinciden, muestra un mensaje de error
            $fallo = true;
            require_once "do_register.php"; // Redirige al formulario de registro
        }
    }
?>
