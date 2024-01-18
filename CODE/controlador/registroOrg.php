<?php

require("../modelo/funciones.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_REQUEST['enviar'])) {

    if (
        empty($_POST['username']) || empty($_POST['name'])
        || empty($_POST['email']) || empty($_POST['password'])
        || empty($_POST['passconf']) || empty($_POST['localidad']
            || empty($_FILES['imagen']))
    ) {
        header("Location: ../vista/registro.php?mensaje=faltanDatos");
        exit();
    }

    // Imagen ruta temporal
    $rutaTemporal = $_FILES['imagen']['tmp_name'];
    $nombreImagen = uniqid() . "_" . $_FILES['imagen']['name'];
    $rutaPermanente = "../img/subidasPerfil/" . $nombreImagen;

    /* Almaceno solo el nombre imagen para mas facil acceso */
    $organizacion = [
        "username" => $_POST['username'],
        "name" => $_POST['name'],
        "email" => $_POST['email'],
        "password" => $_POST['password'],
        "localidad" => $_POST['localidad'],
        "telefono" => $_POST['telefono'],
        "organizacionNombre" => $_POST['organizacion'],
        "userType" => 'org',
        "imagen" => $nombreImagen
    ];

    // Compruebo que las contraseñas de los inputs coincidan
    $passConf = $_POST['passconf'];

    if ($organizacion['password'] != $passConf) {
        header("Location: ../vista/registroOrg.php?mensaje=noCoinciden");
        exit();
    } else {
        $hashedPassword = password_hash($usuario['password'], PASSWORD_DEFAULT);
        $usuario['password'] = $hashedPassword;
    }

    if (move_uploaded_file($rutaTemporal, $rutaPermanente)) {
        if (registro($organizacion)) {
            header("Location: ../vista/paginaPrincipal.php");
            exit();
        } else {
            header("Location: ../vista/registroOrg.php?mensaje=errorRegistro");
            exit();
        }
    } else {
        echo "Hubo un error al subir el archivo.";
    }
} else {
    exit();
}
