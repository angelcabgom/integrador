<?php

require_once("../clases/conexion.php");
$con = new Conexion;

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $sql = "SELECT id, nombre, descripcion, dificultad, actividad, archivo, distancia, altMax, desnivelPos, ciudad, region, pais, id_usuario FROM rutas WHERE 1";

    if (isset($_GET['pais'])) {
        $pais = $_GET['pais'];
        $sql .= " AND pais=?";
    }

    try {
        $stmt = $con->prepare($sql);

        if (isset($_GET['pais'])) {
            $stmt->bind_param("s", $pais);
        }

        $stmt->execute();
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        header("HTTP/1.1 200 OK");
        echo json_encode($rows);
    } catch (mysqli_sql_exception $e) {
        header("HTTP/1.1 500 Internal Serverrrrr Error");
        error_log($e->getMessage());
    }
}
