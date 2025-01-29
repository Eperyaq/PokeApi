<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap');

        body {
            font-family: 'Press Start 2P', sans-serif;
            background-color: #2c3e50;
            color: #ffcb05;
            text-align: center;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 15px;
            text-align: center;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        }

        header a {
            margin: 0 20px;
            text-decoration: none;
            font-weight: bold;
            color: #3b4cca;
            transition: color 0.3s;
        }

        header a:hover {
            color: #ff0000;
        }

        h1 {
            font-size: 3rem;
            text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.8);
        }

        form {
            background: rgba(255, 255, 255, 0.9);
            border: 6px double #3b4cca;
            border-radius: 15px;
            padding: 20px;
            width: 80%;
            max-width: 400px;
            margin: 2rem auto;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.4);
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
            color: #2d2d2d;
        }

        input[type="text"], input[type="password"] {
            width: 90%;
            padding: 10px;
            border: 3px solid #ffcb05;
            border-radius: 10px;
            font-size: 1rem;
            margin-bottom: 15px;
            background-color: rgba(255, 255, 255, 0.8);
        }

        input[type="text"].wrong, input[type="password"].wrong {
            border: 3px solid red;
        }

        button {
            font-size: 1.2rem;
            padding: 10px 20px;
            border: 2px solid #ffcb05;
            border-radius: 10px;
            cursor: pointer;
            margin: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            transition: transform 0.2s;
        }

        button[type="submit"] {
            background: linear-gradient(to bottom, #3b4cca, #1d237e);
            color: #fff;
        }

        button:hover {
            transform: scale(1.05);
        }
        .wrong{
            border: 3px solid red;
        }
    </style>
</head>
<body>
    <header>
        <a href="do_register.php">Registrarse</a>
        <a href="do_login.php">Login</a>
    </header>

    <form action="funcionLogin.php" method="post">
        <h1>Iniciar Sesión</h1>

        <label for="usuario">Nombre de usuario</label>
        <input type="text" name="usuario" class=<?= isset($error) ? "wrong" : ""?> value="<?= isset($usuario) ? $usuario : '' ?>">

        <br>

        <label for="password">Contraseña</label>
        <input type="password" name="password" class=<?= isset($error) ? "wrong" : ""?> >

        <button type="submit">Login</button>

        <?php
            if (isset($error)) {
                echo "<p style='color:red;'>Usuario no encontrado. Verifica tus datos.</p>";
            }
        ?>
    </form>
</body>
</html>