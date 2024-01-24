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



$bandera = getBandera($userData[0]['pais']);
?>
<main class="flex-grow-1 vh-100">
    <div class="contenedor-main-informacion-actual">
        <h3><?php echo $userData[0]['nombre']; ?>&nbsp;<?php echo $bandera ?></h3>
        <h6 class="username">
            <h6 class="username">
                <span class="material-symbols-outlined">
                    groups_2
                </span>
                @<?php echo "{$userData[0]['username']} - {$userData[0]['organizacionNombre']}" ?>
            </h6>
        </h6>
        <div class="contenedor-imagen">
            <img src="../img/subidasPerfil/<?php echo $GLOBALS['imagenPerfil']; ?>">
        </div>
    </div>
    <div class="contenedor-main-informacion">
        <h3>Modificar informacion de usuario</h3>
        <form class="custom-informacion-form" action="../controlador/modificarOrg.php" enctype="multipart/form-data" method="post">
            <div class="custom-form-group form-group">
                <div class="columnas-flex-wrapper">
                    <div class="columna1">
                        <input type="text" name="username" class="custom-form-control form-control" value="<?php echo $userData[0]['username'] ?>" placeholder="Usuario" required>
                        <input type="text" name="name" class="custom-form-control form-control" value="<?php echo $userData[0]['nombre'] ?>" placeholder="Nombre" required>
                        <input type="tel" name="telefono" class="custom-form-control form-control" value="<?php echo $userData[0]['telefono'] ?>" placeholder="Telefono" required>

                    </div>
                    <div class="columna2">
                        <select id="paises" name="pais" class="custom-form-control form-control" required>
                            <!-- Respect a las bandera solo aparece el codigo de pais en edge y chrome por 
                            tema de politicas de Microsoft en firefox si que aparecen -->
                            <?php paises(); ?>
                        </select>
                        <input type="email" name="email" class="custom-form-control form-control" value="<?php echo $userData[0]['email'] ?>" placeholder="Email" required>
                        <input type="text" name="organizacion" class="custom-form-control form-control" value="<?php echo $userData[0]['organizacionNombre'] ?>" placeholder="Nombre organizacion" required>
                    </div>
                </div>
                <input type="password" id="passconf" name="passconf" class="custom-form-control form-control" placeholder="Introducir contraseña actual" required>
                <input type="password" name="nuevaPass" id="additionalInput1" class="custom-form-control form-control" placeholder="Nueva contraseña" style="display:none;">
                <input type="password" name="nuevaPassConf" id="additionalInput2" class="custom-form-control form-control" placeholder="Confirmar nueva contraseña" style="display:none;">
                <div class="checkbox-control">
                    <input type="checkbox" id="additionalInputsCheckbox" onclick="mostrarInputs()">
                    <label for="additionalInputsCheckbox">Cambiar contraseña</label>
                </div>
                <div class="container-image-control form-outline">
                    <span>Foto de perfil</span>
                    <input name="newImagen" type="file" class="custom-image-control form-control" accept="image/*" />
                    <input type="hidden" name="oldImagen" value="<?php echo $GLOBALS['imagenPerfil'] ?>">
                </div>
                <input type="submit" name="enviar" class="custom-submit-control form-control" value="Modificar">
            </div>
        </form>
    </div>
</main>
<?php include("footer.php"); ?>

<script>
    function mostrarInputs() {
        var checkbox = document.getElementById("additionalInputsCheckbox");
        var input1 = document.getElementById("additionalInput1");
        var input2 = document.getElementById("additionalInput2");


        input1.style.display = checkbox.checked ? "block" : "none";
        input2.style.display = checkbox.checked ? "block" : "none";
    }

    function seleccionarElemento() {
        let element = document.getElementById("paises");
        element.value = "<?php echo $userData[0]['pais'] ?>";
    }

    seleccionarElemento();
</script>