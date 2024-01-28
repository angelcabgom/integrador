<?php
require("../modelo/funciones.php");


// Comprobar archivo lo primero ya q casi todos los datos salen del archivo gpx

$extensionesPermitidas = ['gpx'];
$extension = pathinfo($_FILES['gpxFile']['name'], PATHINFO_EXTENSION);

if (!in_array(strtolower($extension), $extensionesPermitidas)) {
    header("Location: ../vista/organizarCarrera.php?mensaje=tipoArchivoNoPermitido");
    exit();
}

// Ya he dado un margen enorme para los gpx

$maxSize = 10 * 1024 * 1024;

if ($_FILES['gpxFile']['size'] > $maxSize) {
    header("Location: ../vista/organizarCarrera.php?mensaje=tamanoArchivoExcedido");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['enviar'])) {

    if (
        empty($_POST['nombre']) || empty($_POST['descripcion'])
        || empty($_POST['actividad']) || empty($_POST['dificultad'])
        || empty($_FILES['gpxFile'])
    ) {
        header("Location: ../vista/organizarCarrera.php?mensaje=faltanDatos");
        exit();
    }

    $rutaTemporal = $_FILES['gpxFile']['tmp_name'];
    $nombreArchivo = uniqid() . "_" . $_FILES['gpxFile']['name'];
    $rutaPermanente = "../data/subidasgpx/" . $nombreArchivo;


    if (isset($_POST['gpxData'])) {
        $gpxDataJson = $_POST['gpxData'];
        $gpxData = json_decode($gpxDataJson, true);

        $distance = $gpxData['distance'];
        $elevation = $gpxData['elevation'];
        $location = $gpxData['location'];

        session_start();
        $datosCarrera = [
            "nombre" => $_POST['nombre'],
            "descripcion" => $_POST['descripcion'],
            "actividad" => $_POST['actividad'],
            "dificultad" => $_POST['dificultad'],
            "gpxFile" => $nombreArchivo,
            "idUsuario" => $_SESSION['id'],
            "distancia" => $distance,
            "altMin" => $elevation['min'],
            "altMax" => $elevation['max'],
            "desnivelPos" => $elevation['gain'],
            "desnivelNeg" => $elevation['loss'],
            "ciudad" => $location['ciudad'],
            "region" => $location['region'],
            "pais" => $location['pais']
        ];
        session_write_close();

        print_r($datosCarrera);

        if (move_uploaded_file($rutaTemporal, $rutaPermanente)) {
            if (registroCarrera($datosCarrera)) {
                header("Location: ../vista/paginaPrincipal.php?mensaje=carreraRegistrada");
                exit();
            } else {
                header("Location: ../vista/organizarCarrera.php?mensaje=errorRegistroCarrera");
                exit();
            }
        } else {
            echo "Hubo un error al subir el archivo.";
        }
    }
}
