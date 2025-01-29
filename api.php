<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PokeApi</title>

<style>
    /* Estilos para centrar el formulario */
    .mb-3 {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }
</style>
</head>
<body>

    <!-- Formulario para ingresar el nombre del Pokémon -->
    <form method="POST" action="api.php">
        <div class="mb-3">
            <label for="nombrePokemon" class="nombrePokemon">Nombre del pokemon </label>
            <input type="text" name="nombrePokemon" id="nombrePokemon">
            <button type="submit">Buscar Pokemon</button>
        </div>
    </form>

    <?php 
    
    // Verifica si el usuario ha enviado un nombre de Pokémon
    if(isset($_POST["nombrePokemon"])){
        
        $pokemon = $_POST["nombrePokemon"]; // Captura el nombre ingresado

        // Inicializa cURL para hacer la solicitud a la API de Pokémon
        $ch = curl_init("https://pokeapi.co/api/v2/pokemon/$pokemon/");

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        $datos_pokemon = json_decode($result, true);
        curl_close($ch); // Cierra la conexión cURL

        // Verifica si el Pokémon existe en la API
        if ($datos_pokemon === null || isset($datos_pokemon["detail"])) {
            echo '<p style="color: red; font-weight: bold;"> Error: El Pokémon "' . $pokemon . '" no existe. Intenta con otro nombre.</p>';
            exit; // Detiene la ejecución del script si el Pokémon no se encuentra
        }

        // Obtiene los datos principales del Pokémon
        $nombre = ucfirst($datos_pokemon["name"]); // Convierte la primera letra en mayúscula
        $tipo = ucfirst($datos_pokemon["types"][0]["type"]["name"]); // Obtiene el tipo principal del Pokémon
        
        // Verifica si el Pokémon tiene un segundo tipo
        $tipo2 = '';
        if(isset($datos_pokemon["types"][1])){
            $tipo2 = ucfirst($datos_pokemon["types"][1]["type"]["name"]);
        }
       
        // Obtiene las estadísticas del Pokémon
        $vida = $datos_pokemon["stats"][0]["base_stat"];
        $ataque = $datos_pokemon["stats"][1]["base_stat"];
        $defensa = $datos_pokemon["stats"][2]["base_stat"];
        $especialAtaque = $datos_pokemon["stats"][3]["base_stat"];
        $especialDefensa = $datos_pokemon["stats"][4]["base_stat"];

        // Función para asignar un color de fondo según el tipo del Pokémon
        function colorFondo($tipo) {
            $colors = [
                "fire" => "red",
                "grass" => "green",
                "water" => "blue",
                "electric" => "yellow",
                "psychic" => "purple",
                "normal" => "gray",
                "ice" => "lightblue",
                "fighting" => "brown",
                "poison" => "violet",
                "ground" => "sandybrown",
                "flying" => "skyblue",
                "rock" => "darkgray",
                "bug" => "olive",
                "ghost" => "indigo",
                "steel" => "silver",
                "dragon" => "darkblue",
                "dark" => "black",
                "fairy" => "pink",
                // Si el tipo no está en la lista, se usa el color blanco por defecto
                "default" => "white"
            ];
        
            return $colors[$tipo] ?? $colors["default"];
        }

        // Obtiene el color correspondiente al tipo del Pokémon
        $color = colorFondo(strtolower($tipo));

        // Muestra la información del Pokémon en un contenedor estilizado
        echo '
        <div style="display: flex; flex-direction: column; width: 250px; height: auto; border-radius:15px;">
            <!-- Sección superior con el color de fondo según el tipo del Pokémon -->
            <div style="background-color: '. $color .'; display:flex; flex-direction: column; align-items: center; justify-content: center; border-radius: 15px 15px 0 0 ; border-bottom: 1px solid black;">
                <img src="' .$datos_pokemon['sprites']['front_default'] .'" style="width: 100px; border-radius: 100px; border: 1px solid black; background-color:white; margin:5px;">
            </div>

            <!-- Sección inferior con los datos del Pokémon -->
            <div style="display: flex; flex-direction: column; align-items: center; background-color: antiquewhite; border-radius: 0 0 15px 15px;">
                <h1 style="text-align: center;">'.$nombre .'</h1>
                <p style="font-weight:bold; margin:20px;">
                   Type = '. $tipo .' ' . ($tipo2 ? $tipo2 : '') .'
                   <br> HP = ' . $vida . 
                   '<br> ATTACK = '. $ataque . 
                   '<br> DEFENSE = '. $defensa . 
                   '<br> SPECIAL-ATTACK = ' .$especialAtaque . 
                   '<br> SPECIAL-DEFENSE = ' . $especialDefensa .'
                </p>
            </div>
        </div>';
    }
    ?>
</body>
</html>
