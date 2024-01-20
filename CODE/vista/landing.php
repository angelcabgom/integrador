<?php

// Estas variables tienen que estar incluidas siempre por regla general

// Comprobar las redirecciones de los usuarios logados en login, register...
$nombreArchivo = basename(__FILE__);


// se usa ***antes*** de incluir los header para incluir los estilos con la funcion incluirEstilos
$estilosDinamicos = [
    "landing" => "../css/landing.css",
];

include("headGlobal.php");

?>

<main class="flex-grow-1 vh-100">
    <div class="container-landing">
        <div class="landing-nombre">TrekWikia</div>
        <div class="landing-eslogan">Empieza tu camino aqui</div>
        <div class="container-landing-register">
            <a class="link" href="registro.php">Register</a>
        </div>
    </div>
</main>
<?php include("footer.php"); ?>