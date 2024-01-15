<?php
// se usa ***antes*** de incluir los header para incluir los estilos con la funcion incluirEstilos
$estilosDinamicos = [
    "registro" => "../css/registro.css",
];

include("headerTrueLogin.php");

?>
<main class="flex-grow-1 vh-100">
    <div class="contenedor-main-registro">
        <h3>Crea una cuenta</h3>
        <form class="custom-register-form" action="#">
            <div class="custom-form-group form-group">
                <input type="email" class="custom-form-control form-control" placeholder="Usuario">
                <input type="email" class="custom-form-control form-control" placeholder="Nombre">
                <input type="email" class="custom-form-control form-control" placeholder="Email">
                <input type="email" class="custom-form-control form-control" placeholder="Contraseña">
                <input type="email" class="custom-form-control form-control" placeholder="Repetir contraseña">
                <input type="email" class="custom-form-control form-control" placeholder="Localidad">
                <div class="container-image-control form-outline">
                    <input name="imagen" type="file" class="custom-image-control form-control" accept="image/*" required />
                </div>
                <input type="submit" class="custom-submit-control form-control" value="Registrarse">
            </div>
        </form>
        <small class="custom-link-login">
            <p>¿Ya eres miembro?</p>
            <a href="login.html">Inicie sesion</a>
            <p>Para organizadores</p>
            <a href="login.html">Registro organizadores</a>
        </small>
    </div>
</main>
<?php include("footer.php") ?>