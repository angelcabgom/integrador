<?php

// Estas variables tienen que estar incluidas ***siempre*** por regla general

// Comprobar las redirecciones de los usuarios logados en login, register...
$nombreArchivo = basename(__FILE__);

// se usa ***antes*** de incluir los header para incluir los estilos con la funcion incluirEstilos
$estilosDinamicos = [
    "configPerfil" => "../css/configPerfil.css",
];


include("headGlobal.php");
$userData = userData();

$flag = '🇦🇹';
echo $flag;

?>
<main class="flex-grow-1 vh-100">
    <div class="contenedor-main-informacion-actual">
        <h3><?php echo $userData[0]['nombre'] ?> </h3>
        <h6>@<?php echo $userData[0]['username'] ?> </h6>
        <div class="contenedor-imagen">
            <img src="../img/subidasPerfil/<?php echo $GLOBALS['imagenPerfil']; ?>">
        </div>
    </div>
    <div class="contenedor-main-informacion">
        <h3>Modificar informacion de usuario</h3>
        <form class="custom-informacion-form" action="../controlador/registroOrg.php" enctype="multipart/form-data" method="post">
            <div class="custom-form-group form-group">
                <div class="columnas-flex-wrapper">
                    <div class="columna1">
                        <input type="text" name="username" class="custom-form-control form-control" placeholder="Usuario" required>
                        <input type="text" name="name" class="custom-form-control form-control" placeholder="Nombre" required>
                        <input type="email" name="email" class="custom-form-control form-control" placeholder="Email" required>
                    </div>
                    <div class="columna2">
                        <input type="text" name="localidad" class="custom-form-control form-control" placeholder="Localidad" required>
                        <input type="tel" name="telefono" class="custom-form-control form-control" placeholder="Telefono" required>
                        <input type="text" name="organizacion" class="custom-form-control form-control" placeholder="Nombre organizacion" required>
                    </div>
                </div>
                <div class="container-image-control form-outline">
                    <span>Foto de perfil</span>
                    <input name="imagen" type="file" class="custom-image-control form-control" accept="image/*" required />
                </div>
                <input type="submit" name="enviar" class="custom-submit-control form-control" value="Registrarse">
            </div>
        </form>
    </div>
</main>
<?php include("footer.php"); ?>