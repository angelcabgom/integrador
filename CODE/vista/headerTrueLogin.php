<body>

    <!-- headerrrr -->
    <nav class="navbar-container-principal navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <!-- Logo y nombre navbarrr -->
            <a href="paginaPrincipal.php" class="btn custom-link d-flex align-items-center" id="logo">
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
                        <!-- Dropdown menu -->
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

                    <!-- Dropdown menu -->
                    <li class="nav-item ms-auto mx-5 dropdown custom-dropdown">
                        <a href="#" class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="custom-material-icon-profile material-symbols-outlined">
                                person
                            </span>
                        </a>
                        <ul class="custom-perfil-dropdown dropdown-menu dropdown-menu-end">
                            <!-- Opciones del dropdown -->
                            <li>
                                <a href="#" class="dropdown-item-perfil dropdown-item">Tu perfil</a>
                            </li>
                            <li>
                                <a href="#" class="dropdown-item-perfil dropdown-item">Configuracion perfil</a>
                            </li>
                            <li>
                                <a href="../controlador/cerrarSesion.php" class="dropdown-item-perfil dropdown-item cerrar-sesion">
                                    <span class="material-symbols-outlined">
                                        logout
                                    </span>
                                    Cerrar sesion
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>