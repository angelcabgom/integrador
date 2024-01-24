    <?php

    require_once("../clases/conexion.php");

    $con = new Conexion;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['username'], $_POST['id'])) {
            $username = $_POST['username'];
            $currentUserId = $_POST['id'];

            // Utiliza una consulta preparada para evitar inyecciones SQL
            $sql = "SELECT COUNT(*) as count FROM usuarios WHERE username = ? AND id != ?";

            try {
                $stmt = $con->prepare($sql);
                $stmt->bind_param("si", $username, $id);
                $stmt->execute();

                $result = $stmt->get_result();

                $row = $result->fetch_assoc();
                $count = $row['count'];

                echo json_encode(["exists" => ($count > 0)]);

                $stmt->close();
            } catch (Exception $e) {
                header("HTTP/1.1 500 Internal Server Error");
                echo json_encode(["error" => "Error in query execution"]);
            }
        }
        exit();
    }

    ?>
