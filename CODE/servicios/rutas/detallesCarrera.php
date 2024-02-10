<?php

require_once("../clases/conexion.php");
$con = new Conexion;

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $sql = "SELECT id, nombre, descripcion, dificultad, actividad, archivo, distancia, altMin, altMax, desnivelPos, desnivelNeg, ciudad, region, pais, id_usuario FROM rutas WHERE 1";

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql .= " AND id=?";
        try {
            $stmt = $con->prepare($sql);

            if (isset($_GET['id'])) {
                $stmt->bind_param("i", $id);
            }

            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                header("HTTP/1.1 200 OK");
                echo json_encode($row);
            } else {
                header("HTTP/1.1 404 Not Found");
            }
        } catch (mysqli_sql_exception $e) {
            header("HTTP/1.1 500 Internal Server Error");
            error_log($e->getMessage());
        }
    }
}
?>
