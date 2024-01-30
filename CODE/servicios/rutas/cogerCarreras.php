<?php

require_once("../clases/conexion.php");
$con = new Conexion;


if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $sql = "SELECT id, nombre, descripcion, archivo FROM rutas";

    try {
        $result = $con->query($sql);

        if ($result) {
            $routes = array();

            while ($row = $result->fetch_assoc()) {
                $routes[] = array(
                    'id' => $row['id'],
                    'nombre' => $row['nombre'],
                    'descripcion' => $row['descripcion'],
                    'archivo' => $row['archivo'],
                );
            }

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
