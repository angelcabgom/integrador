<?php

require_once("../clases/conexion.php");
$con = new Conexion;

if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    parse_str(file_get_contents('php://input'), $put);

    if (
        isset($put['id']) && isset($put['username'])
        && isset($put['name']) && isset($put['email'])
        && isset($put['pais']) && isset($put['imagen'])
    ) {
        $id = $put['id'];
        $username = $put['username'];
        $name = $put['name'];
        $email = $put['email'];
        $pais = $put['pais'];
        $imagen = $put['imagen'];
        $telefono = isset($put['telefono']) ? $put['telefono'] : null;
        $organizacionNombre = isset($put['organizacionNombre']) ? $put['organizacionNombre'] : null;

        if (isset($put['password'])) {
            $password = $put['password'];
            $sql = "UPDATE usuarios SET username=?, nombre=?, 
            email=?, password=?, pais=?, imagen=?, 
            telefono=?, organizacionNombre=? WHERE id=?";

            try {
                $stmt = $con->prepare($sql);
                $stmt->bind_param("ssssssssi", $username, $name, $email, $password, $pais, $imagen, $telefono, $organizacionNombre, $id);
                $stmt->execute();

                if ($stmt->affected_rows > 0) {
                    header("HTTP/1.1 200 OK");
                    echo json_encode($id);
                } else {
                    header("HTTP/1.1 404 Not found");
                }

                $stmt->close();
            } catch (Exception $e) {
                echo json_encode(array("error" => $e->getMessage()));
                header("HTTP/1.1 400 Bad Request");
            }
        } else {
            $sql = "UPDATE usuarios SET username=?, nombre=?, 
            email=?, pais=?, imagen=?, 
            telefono=?, organizacionNombre=? WHERE id=?";

            try {
                $stmt = $con->prepare($sql);
                $stmt->bind_param("sssssssi", $username, $name, $email, $pais, $imagen, $telefono, $organizacionNombre, $id);
                $stmt->execute();

                if ($stmt->affected_rows > 0) {
                    header("HTTP/1.1 200 OK");
                    echo json_encode($id);
                } else {
                    header("HTTP/1.1 404 Not found");
                }

                $stmt->close();
            } catch (Exception $e) {
                echo json_encode(array("error" => $e->getMessage()));
                header("HTTP/1.1 400 Bad Request");
            }
        }
    } else {
        header("HTTP/1.1 401 Bad Request");
    }
    exit();
}
