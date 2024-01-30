<body class="d-flex flex-column">
    <!-- headerr -->
    <nav class="navbar-container-principal navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <!-- Logo y nombre navbarr -->
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
                        <!-- Dropdown menuu -->
                        <ul class="custom-explorar-dropdown dropdown-menu" aria-labelledby="navbarDropdown">
                            <div class="row">
                                <?php
                                mostrarPaises();
                                ?>
                            </div>
                        </ul>
                    </li>
                    <ul class="login-register-container navbar-nav ms-auto">
                        </li>
                        <li class="custom-login nav-item mx-5">
                            <a class="link" href="login.php">Login</a>
                        </li>
                        <div class="custom-register nav-item mx-2">
                            <a class="link" href="registro.php">Register</a>
                        </div>
                    </ul>
                </ul>
            </div>
        </div>
    </nav>