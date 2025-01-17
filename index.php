<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PokeApi</title>
</head>
<body>

    <form method="POST" action="index.php">
            <div class="mb-3" >
                <label for="nombrePokemon" class="nombrePokemon">Nombre del pokemon </label>
                <input type="text"  name="nombrePokemon" id="nombrePokemon">
                <button type="submit">Buscar Pokemon</button>
            </div>
        </form>


    <?php 
    
    if(isset($_POST["nombrePokemon"])){
        
        $pokemon = $_POST["nombrePokemon"];

        $ch = curl_init("https://pokeapi.co/api/v2/pokemon/$pokemon/");

        curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
        $result = curl_exec($ch);
        $datos_pokemon = json_decode($result,true);
        curl_close($ch); 


        $nombre = ucfirst($datos_pokemon["name"]);
        $tipo = ucfirst($datos_pokemon["types"][0]["type"]["name"]);
        
        $tipo2 = '';
        if(isset($datos_pokemon["types"][1])){
            $tipo2 = ucfirst($datos_pokemon["types"][1]["type"]["name"]);
        }
       
        $vida = $datos_pokemon["stats"][0]["base_stat"];
        $ataque = $datos_pokemon["stats"][1]["base_stat"];
        $defensa = $datos_pokemon["stats"][2]["base_stat"];
        $especialAtaque = $datos_pokemon["stats"][3]["base_stat"];;
        $especialDefensa = $datos_pokemon["stats"][4]["base_stat"];;



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
                // Default color si el tipo no está definido
                "default" => "white"
            ];
        
            return $colors[$tipo] ?? $colors["default"];
        }

        $color = colorFondo(strtolower($tipo));







        echo'<h1>Nombre del pokemon = ' .$nombre .'</h1>';

         
        echo'<img src="' .$datos_pokemon['sprites']['front_default'] .'">';

        

        echo "<hr>";


        /*Imprimir por pantalla las imagenes de los 150 primeros pokemons */

        /*
        for($i = 1; $i < 150; $i++){

            $ch = curl_init("https://pokeapi.co/api/v2/pokemon/$i/");

            curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
            $result = curl_exec($ch);
            $datos_pokemon = json_decode($result,true);
            curl_close($ch);

            
            echo'<img src="' .$datos_pokemon['sprites']['back_shiny'] .'">';


        }
        */

        echo '
        <div style="display: flex; flex-direction: column; width: 250px; height: auto; border-radius:15px;">
        <div style="background-color: '. $color .'; display:flex; flex-direction: column; align-items: center; justify-content: center; border-radius: 15px 15px 0 0 ; border-bottom: 1px solid black;">
            <img src="' .$datos_pokemon['sprites']['front_default'] .'" style=" width: 100px;border-radius: 100px; border: 1px solid black; background-color:white; margin:5px;">
        </div>

        
        <div style="display: flex; flex-direction: column; align-items: center; background-color: antiquewhite; border-radius: 0 0 15px 15px;">
            <h1 style= text-align = center;>
            '.$nombre .'</h1>
            <p style= "font-weight:bold; margin:20px;">
               Type = '. $tipo .' ' . ($tipo2 ? $tipo2 : '')
               .'<br> HP = ' . $vida 
               .'<br> ATTACK = '. $ataque 
               .'<br> DEFENSE = '. $defensa 
               .'<br> SPECIAL-ATTACK = ' .$especialAtaque
               .'<br> SPECIAL-DEFENSE = ' . $especialDefensa .'

            </p>
        </div>
    </div>
    ';



    }
    
    ?>

    

</body>
</html>

<?php 

    
?>
