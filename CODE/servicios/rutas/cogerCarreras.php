<?php

require_once("../clases/conexion.php");
$con = new Conexion;


if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $sql = "SELECT id, nombre, descripcion, archivo FROM rutas";

    try {
        $result = $con->query($sql);

        if ($result) {
            $routes = array();
            
            $routes = $result->fetch_all(MYSQLI_ASSOC);

            header("HTTP/1.1 200 OK");
            echo json_encode($routes);
        } else {
            header("HTTP/1.1 500 Internal server exception");
        }
    } catch (mysqli_sql_exception $e) {
        header("HTTP/1.1 400 Bad Request");
        error_log($e->getMessage());
    }
}
