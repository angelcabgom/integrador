<?php require("modelo/funciones.php"); ?>
<!doctype html>
<html lang="en">

<head>
    <title>TrekWikia</title>
    <!-- Required meta tagss -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="img/logo.png" type="image/x-icon">
    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link href="https://db.onlinewebfonts.com/c/e9de4f4d373ef5c6d9cf52490816ff5d?family=BMW+Type+Web+Light+All" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <?php $estilosComunes = [
        "style" => "css/style.css",
    ];

    $estilosDinamicos = [
        "landing" => "css/landing.css",
    ];

    // $estilosDinamicos se debe declarar en el documento en el que incluya el header
    // ***antes*** de incluir el header
    if (isset($estilosDinamicos)) {
        incluirEstilos($estilosDinamicos);
    }

    incluirEstilos($estilosComunes);
    ?>
</head>

<body class="d-flex flex-column min-vh-100">
    <!-- header -->
    <nav class="navbar-container-principal custom-navbar navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <!-- Logo y nombre navbar -->
            <a href="paginaPrincipal.php" class="btn custom-link" id="logo">
                <div id="tituloCabezera" class="mx-2 my-0">TrekWikia</div>
            </a>
            <!-- Items navbarr -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="custom-navbar-nav navbar-nav align-items-center">
                    <li class="custom-nav-item-search nav-item mx-5">
                        <div class="search-container">
                            <span class="material-symbols-outlined">search</span>
                            <input class="custom-search-bar form-control" type="search" placeholder="Buscar carreras" aria-label="Search">
                        </div>
                    </li>
                    <li class="custom-dropdown-menu nav-item dropdown">
                        <a class="explore-link nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Explora
                        </a>
                        <!-- Dropdown menuu -->
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <div class="row">
                                <div class="col-6">
                                    <div class="dropdown-item text-start">
                                        <a href="#">Rutas en España</a>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="dropdown-item text-start">
                                        <a href="#">Rutas en Francia</a>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="dropdown-item text-start">
                                        <a href="#">Rutas en Alemania</a>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="dropdown-item text-start">
                                        <a href="#">Rutas en Suiza</a>
                                    </div>
                                </div>
                            </div>
                        </ul>
                    </li>

                    <ul class="login-register-container navbar-nav ms-auto">
                        </li>
                        <li class="custom-login nav-item mx-5">
                            <a class="link" href="vista/login.php">Login</a>
                        </li>
                        <div class="custom-register nav-item mx-2">
                            <a class="link" href="vista/registro.php">Register</a>
                        </div>
                    </ul>
                </ul>
            </div>
        </div>
    </nav>
    <main class="flex-grow-1 vh-100">
        <div class="container-landing">
            <div class="landing-nombre">TrekWikia</div>
            <div class="landing-eslogan">Empieza tu camino aqui</div>
            <div class="container-landing-register">
                <a class="link" href="vista/registro.php">Register</a>
            </div>
        </div>
    </main>

    <footer>
        <span href="#" class="text-white">&copy; TrekWiki. All rights reserved. Condiciones de uso | Privacidad | Política de cookies</span>
        <div class="container-imagenes">
            <img src="img/TwitterIcono.png" alt="First Image">
            <img id="segundaImagen" src="img/InstagramIcono.png" alt="Second Image">
        </div>
    </footer>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>
</body>

</html>