    <?php

    // recoge un array con las direcciones a las hojas de estilos tanto
    // comunes como dinamicas 
    function incluirEstilos($styles)
    {
        foreach ($styles as $stylesheet) {
            echo "<link rel=stylesheet type=text/css href='$stylesheet'>";
        }
    }

    /* Simplemente se envian los datos de registro ya sean user o org con curl, nada en especial */
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

    /* Se comprueba que passwordInput sea la correcta con password_verify y se devuelve true + userType en caso de serlo */
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
                return [true, $responseDecoded['userType'], $responseDecoded['id']];
            } else {
                return false;
            }
        } catch (Exception $e) {
            return false;
        }
    }

    /* Simplemente comprobando la variable $_SESSION['userType'] se incluye un header u otro */
    function comprobarTipoSesion($filename)
    {
        if (isset($_SESSION['userType'])) {
            if (isset($_SESSION['userType']) && $filename == 'login.php') {
                header("Location: paginaPrincipal.php");
                exit();
            } elseif (isset($_SESSION['userType']) && $filename == 'registro.php') {
                header("Location: perfilUsuario.php");
                exit();
            } elseif (isset($_SESSION['userType']) && $filename == 'registroOrg.php') {
                header("Location: perfilUsuario.php");
                exit();
            } elseif ($_SESSION['userType'] == 'user') {
                include("headerTrueLogin.php");
            } elseif ($_SESSION['userType'] == 'org') {
                include("headerTrueLoginOrg.php");
            }
        } else {
            include("headerFalseLogin.php");
        }
    }

    function obtenerImagen()
    {
        if (isset($_SESSION['id'])) {
            $id = $_SESSION['id'];

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => "http://localhost/integrador/code/servicios/usuarios/imagenPerfil.php?id=$id",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_CUSTOMREQUEST => 'GET',
            ));

            $response = curl_exec($curl);
            $responseDecoded = json_decode($response, true);
            $imagen = $responseDecoded[0]['imagen'];

            curl_close($curl);
            return $imagen;
        }
    }

    function comprobarUsername($username)
    {
        try {
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'http://localhost/integrador/code/servicios/usuarios/comprobarUser.php',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => array('username' => $username),
            ));

            $response = curl_exec($curl);
            $responseDecoded = json_decode($response, true);

            curl_close($curl);
            
            return $responseDecoded["exists"];
        } catch (Exception $e) {
            return false;
        }
    }

    ?>