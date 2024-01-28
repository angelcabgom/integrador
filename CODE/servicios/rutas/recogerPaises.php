<?php

require_once("../clases/conexion.php");
$con = new Conexion;

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $sql = "SELECT DISTINCT pais FROM rutas ORDER BY pais ASC";

    try {
        $result = $con->query($sql);

        if ($result) {
            $countries = array();

            while ($row = $result->fetch_assoc()) {
                $countries[] = $row['pais'];
            }

            header("HTTP/1.1 200 OK");
            echo json_encode($countries);
        } else {
            header("HTTP/1.1 500 Internal server exception");
        }
    } catch (mysqli_sql_exception $e) {
        header("HTTP/1.1 400 Bad Request");
        error_log($e->getMessage());
    }
    exit();
}
