<?php
// se usa ***antes*** de incluir los header para incluir los estilos con la funcion incluirEstilos
$estilosDinamicos = [
    "login" => "../css/login.css",
];

include("headerFalseLogin.php");

?>

<main class="flex-grow-1 vh-100">

    <!-- Arreglar media queries de registro -->

    <div class="contenedor-main-login">
        <h4>Login</h4>
        <form class="custom-login-form" action="../controlador/registro.php" enctype="multipart/form-data" method="post">
            <div class="custom-form-group form-group">
                <input type="text" name="username" class="custom-form-control form-control" placeholder="Username">
                <input type="text" name="name" class="custom-form-control form-control" placeholder="Contraseña">
                <input type="submit" name="enviar" class="custom-submit-control form-control" value="Registrarse">
            </div>
        </form>
        <small class="custom-link-login">
            <p>¿No es miembro?</p>
            <a href="registro.php">Cree una cuenta</a>
        </small>
    </div>

</main>
<?php include("footer.php"); ?>