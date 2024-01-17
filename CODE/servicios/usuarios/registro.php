<?php

require_once("../clases/conexion.php");
$con = new Conexion;

/* Registro de usuario */
// Al usar sentencias preparadas se evitan ataques por inyeccion SQL
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (
        isset($_POST['username']) && isset($_POST['name'])
        && isset($_POST['email']) && isset($_POST['password'])
        && isset($_POST['localidad']) && isset($_POST['imagen'])
    ) {
        $username = $_POST['username'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $localidad = $_POST['localidad'];
        $imagen = $_POST['imagen'];

        $sql = "INSERT INTO `usuarios` (`id`, `username`, `nombre`, `email`, `password`, `localidad`, `imagen`) 
                VALUES (NULL, ?, ?, ?, ?, ?, ?)";

        try {
            $stmt = $con->prepare($sql);
            $stmt->bind_param("ssssss", $username, $name, $email, $password, $localidad, $imagen);
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
