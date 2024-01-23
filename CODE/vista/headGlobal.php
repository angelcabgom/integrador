<?php require("../modelo/funciones.php"); ?>
<!doctype html>
<html lang="en">

<head>
    <title>TrekWikia</title>
    <!-- Required meta tagss -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="img/logo.png" type="image/x-icon">
    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link href="https://db.onlinewebfonts.com/c/e9de4f4d373ef5c6d9cf52490816ff5d?family=BMW+Type+Web+Light+All" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <!-- Array con todos los estilos en comun -->
    <?php $estilosComunes = [
        "style" => "../css/style.css",
    ];

    // $estilosDinamicos se debe declarar en el documento en el que incluya el header
    // ***antes*** de incluir el header

    incluirEstilos($estilosDinamicos);


    incluirEstilos($estilosComunes);


    ?>
</head>


<?php


session_start();
// Aqui se incluyen los headers
$imagenPerfil = obtenerImagen();
$GLOBALS['imagenPerfil'] = $imagenPerfil; // Se mete la imagen de perfil en un $GLOBALS para poder acceder desde cualquier archivo
comprobarTipoSesion($nombreArchivo);
session_write_close();
?>