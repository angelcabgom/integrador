    <?php
    require_once("../clases/conexion.php");
    $con = new Conexion;

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $sql = "SELECT username, nombre, email, localidad, telefono, organizacionNombre FROM usuarios WHERE 1 ";
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $sql .= "AND id=?";
        }

        try {
            $stmt = $con->prepare($sql);

            if (isset($_GET['id'])) {
                $stmt->bind_param("s", $id);
            }

            $stmt->execute();
            $result = $stmt->get_result();

            if ($result && $result->num_rows > 0) {
                $data = $result->fetch_all(MYSQLI_ASSOC);
                header("HTTP/1.1 200 OK");
                echo json_encode($data);
            } else {
                header("HTTP/1.1 404 Not Found");
            }

            $stmt->close();
        } catch (mysqli_sql_exception $e) {
            header("HTTP/1.1 404 Not Found");
        }
        exit;
    }



    ?>
