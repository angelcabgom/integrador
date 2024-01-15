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
        <div class="custom-form-group form-group">
            <input type="email" class="custom-form-control form-control" placeholder="Email">
            <input type="email" class="custom-form-control form-control" placeholder="Email">
            <input type="email" class="custom-form-control form-control" placeholder="Email">
            <input type="email" class="custom-form-control form-control" placeholder="Email">
            <input type="email" class="custom-form-control form-control" placeholder="Email">
            <input type="email" class="custom-form-control form-control" placeholder="Email">
        </div>
    </div>
</main>
<?php include("footer.php") ?>