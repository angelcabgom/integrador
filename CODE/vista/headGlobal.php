<?php require("../modelo/funciones.php"); ?>
<!doctype html>
<html lang="en">

<head>
    <title>TrekWikia</title>
    <!-- Required meta tagss -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link type="image/x-icon" href="../img/t.svg" rel="icon" />
    <link type="image/x-icon" href="../img/t.svg" rel="shortcut icon" />
    <!-- Bootstrap CSS v5.2.1 -->
    <!-- node_modules\bootstrap\dist\css\bootstrap.min.css.map -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet-gpx/1.7.0/gpx.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
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

<body>
    <?php

    session_start();
    // Aqui se incluyen los headers
    $imagenPerfil = obtenerImagen();
    $GLOBALS['imagenPerfil'] = $imagenPerfil; // Se mete la imagen de perfil en un $GLOBALS para poder acceder desde cualquier archivo
    comprobarTipoSesion($nombreArchivo);
    session_write_close();
    ?>