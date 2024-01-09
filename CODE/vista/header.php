<!doctype html>
<html lang="en">

<head>
    <title>Autohaus</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="../img/logo.png" type="image/x-icon">
    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link href="https://db.onlinewebfonts.com/c/e9de4f4d373ef5c6d9cf52490816ff5d?family=BMW+Type+Web+Light+All" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <!-- header -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <!-- Logo y nombre navbar -->
            <a class="btn custom-link d-flex align-items-center " href="main.php">
                <img src="../img/logo.png" alt="Logo" width="25px">
                <p id="tituloCabezera" class="mx-2 my-0 ">Autohaus Leon</p>
            </a>
            <!-- Items navbar -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav align-items-center">
                    <li class="nav-item">
                        <a class="nav-link" href="main.php">Stock</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="agregar.php">Agregar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="eliminar.php">Eliminar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="modificarList.php">Modificar</a>
                    </li>
                </ul>
            </div>
            <!-- Cerrar sesion -->
            <div class="navbar-nav">
                <a class="nav-link btn-link" href="../controlador/cerrarSesion.php">Cerrar Sesión</a>
            </div>
        </div>
    </nav>
    <script>
        // Script para que los TR funciones como enlaces
        document.addEventListener('DOMContentLoaded', function() {
            var filas = document.querySelectorAll('tr[data-url]');

            filas.forEach(function(fila) {
                fila.addEventListener('click', function() {
                    var url = fila.getAttribute('data-url');
                    window.location.href = url;
                });
            });
        });
    </script>