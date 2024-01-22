<?php

require_once("../clases/conexion.php");
$con = new Conexion;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['username'])) {
        $username = $_POST['username'];

        $sql = "SELECT COUNT(*) as count FROM usuarios WHERE username = ?";

        try {
            $stmt = $con->prepare($sql);
            $stmt->bind_param("s", $username);
            $stmt->execute();

            $result = $stmt->get_result();

            $row = $result->fetch_assoc();
            $count = $row['count'];

            echo json_encode(["exists" => ($count > 0)]);

            $stmt->close();
        } catch (Exception $e) {
            header("HTTP/1.1 400 Bad Request");
            echo json_encode(["error" => "Error in query execution"]);
        }
    }
    exit();
}
