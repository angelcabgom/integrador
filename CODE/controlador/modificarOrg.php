    <?php


    require("../modelo/funciones.php");

    session_start();
    if ($_SESSION['userType'] != 'org') {
        header("Location: ../vista/paginaPrincipal.php?mensaje=permisosIncorrectos");
        exit();
    }

    if (!comprobarPass($_SESSION['id'], $_POST['passconf'])) {
        header("Location: ../vista/configUsuario.php?mensaje=passFail");
        exit();
    }
    session_write_close();



    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_REQUEST['enviar'])) {

        if (
            isset($_POST['username']) && isset($_POST['name'])
            && isset($_POST['email']) && isset($_POST['passconf'])
            && isset($_POST['pais'])  && isset($_POST['oldImagen'])
            && isset($_POST['telefono'])  && isset($_POST['organizacion'])
        ) {
            // Comprobar que el usuario no exista en la base de datos

            if (comprobarUsernameDiff($_POST['username'], $_SESSION['id'])) {
                header("Location: ../vista/configUsuario.php?mensaje=usuarioYaExiste");
                exit();
            }



            session_start();
            $usuario = [
                "id" => $_SESSION['id'],
                "username" => $_POST['username'],
                "name" => $_POST['name'],
                "email" => $_POST['email'],
                "pais" => $_POST['pais'],
                "userType" => 'user',
                "imagen" => $_POST['oldImagen'],
                "telefono" => $_POST['telefono'],
                "organizacionNombre" => $_POST['organizacion'],
            ];
            session_write_close();

            
            // Compruebo que las contraseñas de los inputs coincidan

            if (!(empty($_POST['nuevaPass']) && empty($_POST['nuevaPassConf']))) {
                $nuevaPass = $_POST['nuevaPass'];
                $nuevaPassConf = $_POST['nuevaPassConf'];
                if ($nuevaPass != $nuevaPassConf) {
                    header("Location: ../vista/configUsuario.php?mensaje=noCoinciden");
                    exit();
                } else {
                    $hashedPassword = password_hash($nuevaPass, PASSWORD_DEFAULT);
                    $usuario['password'] = $hashedPassword;
                }
            }


            if ($_FILES['newImagen']['size'] > 0) {


                // Control del tamaño

                $maxSize = 8 * 1024 * 1024;

                if ($_FILES['newImagen']['size'] > $maxSize) {
                    header("Location: ../vista/configUsuario.php?mensaje=tamanoArchivoExcedido");
                    exit();
                }

                // Control del tipo de archivo

                $extensionesPermitidas = ['jpg', 'jpeg', 'png', 'gif'];
                $extension = pathinfo($_FILES['newImagen']['name'], PATHINFO_EXTENSION);

                if (!in_array(strtolower($extension), $extensionesPermitidas)) {
                    header("Location: ../vista/configUsuario.php?mensaje=tipoArchivoNoPermitido");
                    exit();
                }

                // Imagen ruta temporal
                $rutaTemporal = $_FILES['newImagen']['tmp_name'];
                $nombreImagen = uniqid() . "_" . $_FILES['newImagen']['name'];
                $rutaPermanente = "../img/subidasPerfil/" . $nombreImagen;

                // Borrar imagen antigua
                if (!empty($usuario['imagen']) && file_exists("../img/subidasPerfil/" . $usuario['imagen'])) {
                    unlink("../img/subidasPerfil/" . $usuario['imagen']);
                }

                $usuario['imagen'] = $nombreImagen;

                if (move_uploaded_file($rutaTemporal, $rutaPermanente)) {
                    if (modificar($usuario)) {
                        header("Location: ../vista/login.php");
                        exit();
                    } else {
                        header("Location: ../vista/configUsuario.php?mensaje=errorRegistro");
                        exit();
                    }
                } else {
                    echo "Hubo un error al subir el archivo.";
                }
            }

            if (modificar($usuario)) {
                header("Location: ../vista/login.php");
                exit();
            } else {
                header("Location: ../vista/configUsuario.php?mensaje=errorRegistro");
                exit();
            }
        } else {

            header("Location: ../vista/configUsuario.php?mensaje=faltanDatos");
            exit();
        }
    } else {
        exit();
    }


    ?>