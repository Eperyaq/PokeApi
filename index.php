<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Inicio</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin-top: 100px;
        }
        a {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            margin: 10px;
            text-decoration: none;
            border-radius: 5px;
            background-color: #007bff;
            color: white;
            transition: background-color 0.3s;
        }
        a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Bienvenido</h1>
    <p>Elige una opción para continuar:</p>
    <a href="do_login.php">Iniciar Sesión</a>
    <a href="do_register.php">Registrarse</a>
</body>
</html>
