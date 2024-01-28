<?php

// Estas variables tienen que estar incluidas siempre por regla general

// Comprobar las redirecciones de los usuarios logados en login, register...
$nombreArchivo = basename(__FILE__);


// se usa ***antes*** de incluir los header para incluir los estilos con la funcion incluirEstilos
$estilosDinamicos = [
    "orgCarreras" => "../css/orgCarrera.css",
];

include("headGlobal.php");

?>

<main class="flex-grow-1 vh-100">
    <div class="contenedor-main-registro">
        <h3>Organiza una carrera</h3>
        <form class="custom-register-form" action="../controlador/orgCarreras.php" enctype="multipart/form-data" method="post">
            <div class="org-grid">
                <div id="map" class="map"></div>
                <div class="form">
                    <div class="container-image-control form-outline">
                        <span>Introducir archivo '.gpx'</span>
                        <input type="file" id="gpxInput" name="gpxFile" class="custom-image-control form-control" accept=".gpx" required />
                    </div>
                    <input type="text" id="nombre" name="nombre" class="custom-form-control form-control" placeholder="Nombre" required>
                    <textarea class="custom-text-area custom-form-control form-control" name="descripcion" id="exampleTextarea" maxlength="200" placeholder="Descripcion" required></textarea>
                    <select name="actividad" class="custom-form-control form-control form-select">
                        <option>Hiking</option>
                        <option>Ciclismo</option>
                        <option>Running</option>
                        <option>Coches</option>
                        <option>Ski</option>
                        <option>Motos</option>
                    </select>
                    <select name="dificultad" class="custom-form-control form-control form-select">
                        <option>🟩 &nbsp; Facil</option>
                        <option>🟨 &nbsp; Intermedio</option>
                        <option>🟥 &nbsp; Dificil</option>
                        <option>⬛ &nbsp; Solo expertos</option>
                    </select>
                    <input type="hidden" id="gpxDataInput" name="gpxData" />
                    <input type="submit" class="custom-submit-control form-control" name="enviar" value="Subir">
                </div>
            </div>
        </form>
    </div>
    <script>
        var map = L.map('map').setView([0, 0], 2);
        var gpxLayer;
        var gpxDataJson;

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors',
            minZoom: 2
        }).addTo(map);

        var maxBounds = L.latLngBounds([90, -180], [-90, 180]);
        map.setMaxBounds(maxBounds);

        document.getElementById('gpxInput').addEventListener('change', handleFileSelect);

        function handleFileSelect(event) {
            var file = event.target.files[0];
            if (file) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    var gpxData = e.target.result;
                    displayGPXOnMap(gpxData);
                };
                reader.readAsText(file);
            }
        }

        function displayGPXOnMap(gpxData) {
            if (map.hasLayer(gpxLayer)) {
                map.removeLayer(gpxLayer);
            }

            var ciudad, region, pais;

            gpxLayer = new L.GPX(gpxData, {
                async: true,
                marker_options: {
                    startIconUrl: '../img/mappins/start-pin.png',
                    endIconUrl: '../img/mappins/end-pin.png',
                    shadowUrl: '../img/mappins/shadow.png'
                },
                minZoom: 2
            }).on('loaded', function(e) {
                const bounds = e.target.getBounds();
                map.fitBounds(bounds);
                const center = bounds.getCenter();

                var maxBounds = L.latLngBounds([90, -180], [-90, 180]);
                map.setMaxBounds(maxBounds);

                const apiUrl = `https://nominatim.openstreetmap.org/reverse?format=json&lat=${center.lat}&lon=${center.lng}&addressdetails=1`;

                fetch(apiUrl)
                    .then(response => response.json())
                    .then(data => {
                        const addressDetails = data.address || {};

                        ciudad = addressDetails.city || addressDetails.town || addressDetails.village || '';
                        region = addressDetails.state || addressDetails.county || '';
                        pais = addressDetails.country || '';


                        var gpxInfo = {
                            name: e.target.get_name(),
                            distance: e.target.get_distance(),
                            elevation: {
                                min: e.target.get_elevation_min(),
                                max: e.target.get_elevation_max(),
                                gain: e.target.get_elevation_gain(),
                                loss: e.target.get_elevation_loss()
                            },
                            location: {
                                ciudad: ciudad,
                                region: region,
                                pais: pais
                            }
                        };

                        document.querySelector("#nombre").value = gpxInfo['name'];

                        gpxDataJson = JSON.stringify(gpxInfo);

                        document.getElementById('gpxDataInput').value = gpxDataJson;
                    })
                    .catch(error => {
                        console.error("Error during reverse geocoding:", error);
                    });
            }).addTo(map);
        }
    </script>
</main>
<?php include("footer.php"); ?>