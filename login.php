<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h1 style="color:cyan">Iniciar Sesion</h1>

    <form action="login.php" method="GET">

        <label for="usuario">Gamil</label>
        <input type="text" name="usuario" id="usuario" />

        <label for="pass">Contraseña</label>
        <input type="password" name="pass" id="pass" />

        <input type="submit">


    </form>


    <?php 
        $users = [
            ["nombre" => "elia", "email" => "perro@gmail.com", "contra" => "123"],
            ["nombre" => "Pablo", "email" => "123@gmail.com", "contra" => "123"],
            ["nombre" => "Juan", "email" => "hola@gmail.com", "contra" => "123"],
        ];

        


        if(isset($_GET["usuario"]) && isset($_GET["pass"])){
            $usuario = $_GET["usuario"];
            $password = $_GET["pass"];
            $nombre = '';

            require_once("do_login.php");

            $flag = login($usuario, $password, $users);

            if($flag){
                require_once("landin.php");
            }else{
                require_once("index.php");
            }

        }


    ?>
</body>
</html>