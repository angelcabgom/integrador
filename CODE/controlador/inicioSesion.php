    <?php

    require("../modelo/funciones.php");


    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_REQUEST['enviar'])) {
        $usernameInput = $_POST['username'];
        $passwordInput = $_POST['password'];

        if (empty($usernameInput) || empty($passwordInput)) {
            header("Location: ../vista/login.php?mensaje=faltanDatos");
            exit();
        }

        $username = ["username" => $usernameInput];

        /* El usuario tiene que ser un array para las consultas POST*/
        if (inicioSesion($username, $passwordInput)) {
            header("Location: ../vista/paginaPrincipal.php");
            exit();
        } else {
            header("Location: ../vista/login.php?mensaje=errorInicioSesion");
            exit();
        }
    }


    ?>