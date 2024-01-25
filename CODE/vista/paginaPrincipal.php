<?php

// Estas variables tienen que estar incluidas siempre por regla general

// Comprobar las redirecciones de los usuarios logados en login, register...
$nombreArchivo = basename(__FILE__);


// se usa ***antes*** de incluir los header para incluir los estilos con la funcion incluirEstilos
$estilosDinamicos = [
    "login" => "../css/principal.css",
];

include("headGlobal.php");

?>

<main class="flex-grow-1 vh-100">

    <div class="map-container">
        <div  class="map" id="map"></div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet-gpx/1.7.0/gpx.min.js"></script>
    <script>
        var map = L.map('map', {
            center: [51.505, -0.09],
            zoom: 13,
            zoomControl: false,
            dragging: false,
            scrollWheelZoom: false
        });

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        var gpxLayer = new L.GPX('../gpx/aw.gpx', {
            async: true,
        }).addTo(map);

        gpxLayer.on("loaded", function(e) {
            map.fitBounds(e.target.getBounds());
        });
    </script>
</main>
<?php include("footer.php"); ?>