    <?php

    require("../modelo/funciones.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_REQUEST['enviar'])) {

        // Imagen ruta temporal
        $rutaTemporal = $_FILES['imagen']['tmp_name'];
        $nombreImagen = uniqid() . "_" . $_FILES['imagen']['name'];
        $rutaPermanente = "../img/subidasPerfil/" . $nombreImagen;

        $usuario = [
            "username" => $_REQUEST['username'],
            "name" => $_REQUEST['name'],
            "email" => $_REQUEST['email'],
            "password" => $_REQUEST['password'],
            "localidad" => $_REQUEST['localidad'],
            "imagen" => $nombreImagen
        ];

        $passConf = $_REQUEST['passconf'];

        if ($usuario['password'] != $passConf) {
            header("Location: ../vista/registro.php?mensaje=noCoinciden");
            exit();
        }

        if (move_uploaded_file($rutaTemporal, $rutaPermanente)) {
            if (registroUsuario($usuario)) {
                header("Location: ../vista/registro.php?mensaje=registrado");
            } else {
                header("Location: ../vista/registro.php?mensaje=errorRegistro");
            }
        } else {
            echo "Hubo un error al subir el archivo.";
        }
    }

    ?>