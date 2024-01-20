<?php

// Estas variables tienen que estar incluidas ***siempre*** por regla general

// Comprobar las redirecciones de los usuarios logados en login, register...
$nombreArchivo = basename(__FILE__);

// se usa ***antes*** de incluir los header para incluir los estilos con la funcion incluirEstilos
$estilosDinamicos = [
    "registroOrg" => "../css/perfil.css",
];

include("headGlobal.php");

?>
<main class="flex-grow-1 vh-100">
    <p>
        <a href="../controlador/cerrarSesion.php">Cerrar</a>
    </p>
</main>
<?php include("footer.php"); ?>