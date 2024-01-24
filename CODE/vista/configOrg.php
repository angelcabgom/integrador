<?php

// Estas variables tienen que estar incluidas ***siempre*** por regla general

// Comprobar las redirecciones de los usuarios logados en login, register...
$nombreArchivo = basename(__FILE__);

// se usa ***antes*** de incluir los header para incluir los estilos con la funcion incluirEstilos
$estilosDinamicos = [
    "configPerfil" => "../css/configOrg.css",
];


include("headGlobal.php");
$userData = userData();
$bandera = getBandera($userData[0]['pais']);
?>
<main class="flex-grow-1 vh-100">
    <div class="contenedor-main-informacion-actual">
        <h3><?php echo $userData[0]['nombre']; ?>&nbsp;<?php echo $bandera ?></h3>
        <h6 class="username">
            <span class="material-symbols-outlined">
                groups_2
            </span>
            @<?php echo "{$userData[0]['username']} - {$userData[0]['organizacionNombre']}" ?>
        </h6>
        <div class="contenedor-imagen">
            <img src="../img/subidasPerfil/<?php echo $GLOBALS['imagenPerfil']; ?>">
        </div>
    </div>
    <div class="contenedor-main-informacion">
        <h3>Modificar informacion de organizacion</h3>
        <form class="custom-informacion-form" action="../controlador/modificar.php" enctype="multipart/form-data" method="post">
            <div class="custom-form-group form-group">
                <div class="columnas-flex-wrapper">
                    <div class="columna1">
                        <input type="text" name="username" class="custom-form-control form-control" placeholder="Usuario" required>
                        <input type="text" name="name" class="custom-form-control form-control" placeholder="Nombre" required>
                        <input type="email" name="email" class="custom-form-control form-control" placeholder="Email" required>
                        <input type="password" name="password" class="custom-form-control form-control" placeholder="Contraseña" required>
                        <input type="password" name="passconf" class="custom-form-control form-control" placeholder="Repetir contraseña" required>
                    </div>
                    <div class="columna2">
                        <select name="pais" class="custom-form-control form-control" required>
                            <!-- Respect a las bandera solo aparece el codigo de pais en edge y chrome por 
                            tema de politicas de Microsoft en firefox si que aparecen -->
                            <?php paises(); ?>
                        </select>
                        <input type="password" name="password" class="custom-form-control form-control" placeholder="Contraseña" required>
                        <input type="password" name="passconf" class="custom-form-control form-control" placeholder="Repetir contraseña" required>
                    </div>
                </div>

                <div class="container-image-control form-outline">
                    <span>Foto de perfil</span>
                    <input name="imagen" type="file" class="custom-image-control form-control" accept="image/*" required />
                </div>
                <input type="submit" name="enviar" class="custom-submit-control form-control" value="Modificar">
            </div>
        </form>
    </div>
</main>
<?php include("footer.php"); ?>