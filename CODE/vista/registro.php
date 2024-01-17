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
        <form class="custom-register-form" action="../controlador/registro.php" enctype="multipart/form-data" method="post">
            <div class="custom-form-group form-group">
                <input type="text" name="username" class="custom-form-control form-control" placeholder="Usuario" required>
                <input type="text" name="name" class="custom-form-control form-control" placeholder="Nombre" required>
                <input type="email" name="email" class="custom-form-control form-control" placeholder="Email" required>
                <input type="password" name="password" class="custom-form-control form-control" placeholder="Contraseña" required>
                <input type="password" name="passconf" class="custom-form-control form-control" placeholder="Repetir contraseña" required>
                <input type="text" name="localidad" class="custom-form-control form-control" placeholder="Localidad" required>
                <div class="container-image-control form-outline">
                    <span>Foto de perfil</span>
                    <input name="imagen" type="file" class="custom-image-control form-control" accept="image/*" required />
                </div>
                <input type="submit" name="enviar" class="custom-submit-control form-control" value="Registrarse">
            </div>
        </form>
        <small class="custom-link-login">
            <p>¿Ya eres miembro?</p>
            <a href="login.php">Inicie sesion</a>
            <p>Para organizadores</p>
            <a href="login.html">Registro organizadores</a>
        </small>
    </div>
</main>
<?php include("footer.php") ?>