<?php

require("../modelo/funciones.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_REQUEST['enviar'])) {

    if (
        isset($_POST['username']) && isset($_POST['name'])
        && isset($_POST['email']) && isset($_POST['password'])
        && isset($_POST['pais']) && isset($_POST['imagen'])
        && isset($_POST['userType'])
    ) {
        header("Location: ../vista/registro.php?mensaje=faltanDatos");
        exit();
    }

    if (comprobarUsername($_POST['username'])) {
        header("Location: ../vista/registroOrg.php?mensaje=usuarioYaExiste");
        exit();
    }

    // Control del tamaño

    $maxSize = 8 * 1024 * 1024;

    if ($_FILES['imagen']['size'] > $maxSize) {
        header("Location: ../vista/registro.php?mensaje=tamanoArchivoExcedido");
        exit();
    }

    // Control del tipo de archivo

    $extensionesPermitidas = ['jpg', 'jpeg', 'png', 'gif'];
    $extension = pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION);

    if (!in_array(strtolower($extension), $extensionesPermitidas)) {
        header("Location: ../vista/registro.php?mensaje=tipoArchivoNoPermitido");
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
        "pais" => $_POST['pais'],
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
        $hashedPassword = password_hash($organizacion['password'], PASSWORD_DEFAULT);
        $organizacion['password'] = $hashedPassword;
    }

    if (move_uploaded_file($rutaTemporal, $rutaPermanente)) {
        if (registro($organizacion)) {
            header("Location: ../vista/login.php");
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
