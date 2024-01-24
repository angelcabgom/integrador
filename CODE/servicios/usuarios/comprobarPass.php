<?php

require_once("../clases/conexion.php");
$con = new Conexion;

/* Login */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id'])) {
        $id = $_POST['id'];

        // Al usar sentencias preparadas se evitan ataques por inyeccion SQL
        $sql = "SELECT password FROM usuarios WHERE id = ?";

        try {
            $stmt = $con->prepare($sql);
            $stmt->bind_param("s", $id);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $passwordDB = $row['password'];

                header("HTTP/1.1 200 OK");
                echo json_encode([
                    "password" => $passwordDB,
                ]);
            } else {
                header("HTTP/1.1 404 Not Found");
            }

            $stmt->close();
        } catch (mysqli_sql_exception $e) {
            header("HTTP/1.1 500 Internal Server Exception");
        }
    } else {
        header("HTTP/1.1 400 Bad Request");
        echo json_encode(array("message" => "Username no proporcionado"));
    }
    exit();
}
?>