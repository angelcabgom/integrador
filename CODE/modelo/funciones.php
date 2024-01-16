    <?php

    // recoge un array con las direcciones a las hojas de estilos tanto
    // comunes como dinamicas 
    function incluirEstilos($styles)
    {
        foreach ($styles as $stylesheet) {
            echo "<link rel=stylesheet type=text/css href='$stylesheet'>";
        }
    }


    function registroUsuario($usuario)
    {
        try {
            $url = "http://localhost/integrador/code/servicios/usuarios/usuarios.php";
            $ch = curl_init();

            $curlOptions = array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_POST => true,
                CURLOPT_POSTFIELDS => $usuario,
                CURLOPT_FAILONERROR => true,
            );

            curl_setopt_array($ch, $curlOptions);

            $response = curl_exec($ch);
            curl_close($ch);

            // if ($response) {
            //     echo "<p>Alumno añadido: $response</p>";
            // } else {
            //     echo "<p>No se ha podido añadir el alumno</p>";
            // }

            return true;
        } catch (Exception $e) {
            return false;
        }
    } 


    ?>