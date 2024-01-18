<?php

require("../modelo/funciones.php");

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_REQUEST['enviar'])) {
    $usernameInput = $_POST['username'];
    $passwordInput = $_POST['password'];

    if (empty($usernameInput) || empty($passwordInput)) {
        header("Location: ../vista/login.php?mensaje=faltanDatos");
        exit();
    }

    $username = ["username" => $usernameInput];

    /* El usuario tiene que ser un array para las consultas POST*/
    /* inicioSesion devuelve un array con dos elementos si es true 
        estoy almacenando los resultados en el array para poder acceder al valor*/

    $result = inicioSesion($username, $passwordInput);

    if ($result[0]) {
        $userType = $result[1];
        
        $_SESSION['userType'] = $userType;

        session_write_close();
        
        header("Location: ../vista/paginaPrincipal.php");
        exit();
    } else {
        echo "mal";
        header("Location: ../vista/login.php?mensaje=errorInicioSesion");
        exit();
    }
} else {
    exit();
}
