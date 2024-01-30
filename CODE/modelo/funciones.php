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

    /* Tiene que estar metido en un bloque de session_start() */
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

            echo $responseDecoded["exists"];

            return $responseDecoded["exists"];
        } catch (Exception $e) {
            return false;
        }
    }

    function comprobarUsernameDiff($username, $id)
    {
        try {
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'http://localhost/integrador/code/servicios/usuarios/comprobarUserDiff.php',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => array('username' => $username, 'id' => $id),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            $responseDecoded = json_decode($response, true);

            curl_close($curl);

            echo $responseDecoded["exists"];

            return $responseDecoded["exists"];
        } catch (Exception $e) {
            return false;
        }
    }


    function userData()
    {
        if (isset($_SESSION['id'])) {
            $id = $_SESSION['id'];
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => "http://localhost/integrador/code/servicios/usuarios/infoUser.php?id=$id",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_CUSTOMREQUEST => 'GET',
            ));

            $response = curl_exec($curl);
            $responseDecoded = json_decode($response, true);

            curl_close($curl);
            return $responseDecoded;
        }
    }

    function paises()
    {
        $countryData = '../json/countries.json';
        $countries = json_decode(file_get_contents($countryData), true);

        foreach ($countries as $country) {
            echo "<option value='{$country['name']}'>{$country['flag']} &nbsp; {$country['name']}</option>";
        }
    }

    function getBandera($countryName)
    {

        if ($countryName == 'N/A') {
            return '🌍';
        }

        $countriesArray = json_decode(file_get_contents('../json/countries.json'), true);


        foreach ($countriesArray as $country) {
            if ($country['name'] == $countryName) {
                return "<img src='../img/flags/4x3/{$country['flagCode']}.svg'>";
            }
        }

        return '🌍';
    }

    function modificar($datos)
    {
        try {
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'http://localhost/integrador/code/servicios/usuarios/modificar.php',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_CUSTOMREQUEST => 'PUT',
                CURLOPT_POSTFIELDS => http_build_query($datos),
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/x-www-form-urlencoded'
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            echo $response;

            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    function comprobarPass($id, $passwordInput)
    {

        try {
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'http://localhost/integrador/code/servicios/usuarios/comprobarPass.php',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => array('id' => $id),
            ));

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

    function registroCarrera($datos)
    {

        try {
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'http://localhost/integrador/code/servicios/rutas/registroCar.php',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => $datos,
            ));

            curl_exec($curl);

            curl_close($curl);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    function mostrarPaises()
    {
        try {
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'http://localhost/integrador/code/servicios/rutas/recogerPaises.php',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_CUSTOMREQUEST => 'GET',
            ));

            $response = curl_exec($curl);
            $paises = json_decode($response);

            $count = count($paises);
            echo "<div class='row'>";
            for ($i = 0; $i < $count; $i++) {

                echo '<div class="col-md-6">
                        <div class="dropdown-item text-start">
                            <a href="http://localhost/integrador/code/vista/explorarPais.php">Carreras en ' . $paises[$i] . '</a>
                        </div>
                    </div>';

                // Nueva row cada dos columnas
                if (($i + 1) % 2 === 0 && $i !== $count - 1) {
                    echo '</div><div class="row">';
                }
            }

            curl_close($curl);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    function recogerCarreras()
    {
        try {
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'http://localhost/integrador/code/servicios/rutas/cogerCarreras.php',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_CUSTOMREQUEST => 'GET',
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            return $response;
        } catch (Exception $e) {
            return false;
        }
    }


    ?>