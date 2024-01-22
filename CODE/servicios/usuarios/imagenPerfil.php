<?php

require_once("../clases/conexion.php");
$con = new Conexion;

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $sql = "SELECT imagen FROM usuarios WHERE 1 ";
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql .= "AND id='$id'";
    }
    try {
        $result = $con->query($sql);
        if ($result and $result->num_rows > 0) {
            $alumnos = $result->fetch_all(MYSQLI_ASSOC);
            header("HTTP/1.1 200 OK");
            echo json_encode($alumnos);
        } else {
            header("HTTP/1.1 404 Not Found");
        }
    } catch (mysqli_sql_exception $e) {
        header("HTTP/1.1 404 Not Found");
    }
    exit;
}
