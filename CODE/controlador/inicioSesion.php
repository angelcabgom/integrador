<?php

require("../modelo/funciones.php");
require_once("../vendor/autoload.php");

use Firebase\JWT\JWT;

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_REQUEST['enviar'])) {
    $usernameInput = $_POST['username'];
    $passwordInput = $_POST['password'];

    if (empty($usernameInput) || empty($passwordInput)) {
        header("Location: ../vista/login.php?mensaje=faltanDatos");
        exit();
    }

    $username = ["username" => $usernameInput];

    // Verificar credenciales de inicio de sesión
    $result = inicioSesion($username, $passwordInput);

    if ($result[0]) {
        $userType = $result[1];
        $id = $result[2];

        // Establecer variables de sesión
        $_SESSION['userType'] = $userType;
        $_SESSION['id'] = $id;

        // Generar token JWT
        $payload = array(
            "userType" => $userType,
            "id" => $id,
            'exp' => time()+3600, 
        );

        $jwt = JWT::encode($payload, 'trekwikia', 'HS256');

        // Almacenar token JWT en la sesión
        $_SESSION['jwt'] = $jwt;

        session_write_close();
        header("Location: ../vista/paginaPrincipal.php");
        exit();
    } else {
        session_write_close();
        header("Location: ../vista/login.php?mensaje=errorInicioSesion");
        exit();
    }
} else {
    session_write_close();
    exit();
}
