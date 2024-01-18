    <?php

    // recoge un array con las direcciones a las hojas de estilos tanto
    // comunes como dinamicas 
    function incluirEstilos($styles)
    {
        foreach ($styles as $stylesheet) {
            echo "<link rel=stylesheet type=text/css href='$stylesheet'>";
        }
    }


    function registro($datos)
    {
        try {
            $url = "http://localhost/integrador/code/servicios/usuarios/registro.php";
            $ch = curl_init();

            $curlOptions = array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_POST => true,
                CURLOPT_POSTFIELDS => $datos,
                CURLOPT_FAILONERROR => true,
            );

            curl_setopt_array($ch, $curlOptions);

            $response = curl_exec($ch);
            curl_close($ch);

            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    function inicioSesion($username, $passwordInput)
    {
        try {
            $curl = curl_init();

            $curlOptions = [
                CURLOPT_URL => 'http://localhost/integrador/code/servicios/usuarios/login.php',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => $username,
            ];

            curl_setopt_array($curl, $curlOptions);

            $response = curl_exec($curl);

            $responseDecoded = json_decode($response, true);

            curl_close($curl);

            if (password_verify($passwordInput, $responseDecoded['password'])) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            return false;
        }
    }


    ?>