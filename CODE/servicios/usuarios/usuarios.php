    <?php

    require_once("../clases/conexion.php");
    $con = new Conexion;

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
                    VALUES (NULL, '$username', '$name', '$email', '$password', '$localidad', '$imagen') ";

            try {
                $con->query($sql);

                if ($con->affected_rows > 0) {
                    header("HTTP/1.1 201 CREATED");
                    echo json_encode($con->insert_id);
                } else {
                    header("HTTP/1.1 500 Internal server exception");
                }
            } catch (Exception $e) {
                header("HTTP/1.1 400 Bad Request");
            }
        } else {
            header("HTTP/1.1 400 Bad Request");
        }
    }


    ?>