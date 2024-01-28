<?php

require_once("../clases/conexion.php");
$con = new Conexion;

/* Registro de usuario */
// Al usar sentencias preparadas se evitan ataques por inyeccion SQL 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (
        isset($_POST['nombre']) && isset($_POST['descripcion'])
        && isset($_POST['actividad']) && isset($_POST['dificultad'])
        && isset($_POST['gpxFile']) && isset($_POST['idUsuario'])
        && isset($_POST['distancia']) && isset($_POST['altMin'])
        && isset($_POST['altMax']) && isset($_POST['desnivelPos'])
        && isset($_POST['desnivelNeg']) && isset($_POST['ciudad'])
        && isset($_POST['region']) && isset($_POST['pais'])
    ) {
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $actividad = $_POST['actividad'];
        $dificultad = $_POST['dificultad'];
        $gpxFile = $_POST['gpxFile'];
        $idUsuario = $_POST['idUsuario'];
        $distancia = $_POST['distancia']; 
        $altMin = $_POST['altMin']; 
        $altMax = $_POST['altMax']; 
        $desnivelPos = $_POST['desnivelPos']; 
        $desnivelNeg = $_POST['desnivelNeg']; 
        $ciudad = $_POST['ciudad']; 
        $region = $_POST['region']; 
        $pais = $_POST['pais']; 

        $sql = "INSERT INTO `rutas` (`id`, `nombre`, `descripcion`, `dificultad`, `actividad`, `archivo`, `distancia`, `altMin`, `altMax`, `desnivelPos`, `desnivelNeg`, `ciudad`, `region`, `pais`, `id_usuario`) 
                VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        try {
            $stmt = $con->prepare($sql);
            $stmt->bind_param("ssssssddddsssi", $nombre, $descripcion, $actividad, $dificultad, $gpxFile, $distancia, $altMin, $altMax, $desnivelPos, $desnivelNeg, $ciudad, $region, $pais, $idUsuario);
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                header("HTTP/1.1 201 CREATED");
                echo json_encode($stmt->insert_id);
            } else {
                header("HTTP/1.1 500 Internal server exception");
            }

            $stmt->close();
        } catch (mysqli_sql_exception $e) {
            header("HTTP/1.1 400 Bad Request");
        }
    } else {
        header("HTTP/1.1 400 Bad Request");
    }
    exit();
}
