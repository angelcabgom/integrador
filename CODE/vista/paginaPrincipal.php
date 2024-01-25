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

    <div id="mapCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#mapCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#mapCarousel" data-bs-slide-to="1" class="active" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#mapCarousel" data-bs-slide-to="2" class="active" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active" id="carouselItem1">
                <div id="map1" class="leaflet-container"></div>
                <div class="carousel-caption d-none d-md-block always-visible">
                    <h5>First slide label</h5>
                    <p>Some representative placeholder content for the first slide.</p>
                </div>
            </div>
            <div class="carousel-item" id="carouselItem2">
                <div id="map2" class="leaflet-container"></div>
                <div class="carousel-caption d-none d-md-block always-visible">
                    <h5>Second slide label</h5>
                    <p>Some representative placeholder content for the second slide.</p>
                </div>
            </div>
            <div class="carousel-item" id="carouselItem3">
                <div id="map3" class="leaflet-container"></div>
                <div class="carousel-caption d-none d-md-block always-visible">
                    <h5>Third slide label</h5>
                    <p>Some representative placeholder content for the third slide.</p>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev always-visible" type="button" data-bs-target="#mapCarousel" data-bs-slide="prev">
            <img class="back" src="../img/svgs/arrow_back_ios_FILL0_wght700_GRAD200_opsz48.svg" alt="">
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next always-visible" type="button" data-bs-target="#mapCarousel" data-bs-slide="next">
            <img class="next" src="../img/svgs/arrow_forward_ios_FILL0_wght700_GRAD200_opsz48.svg" alt="">
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <script>
        var map1, map2, map3;

        $('#mapCarousel').on('slid.bs.carousel', function() {
            initMaps();
        });

        function initMaps() {
            if ($('#carouselItem1').hasClass('active')) {
                if (!map1) {
                    map1 = L.map('map1', {
                        zoomControl: false,
                        dragging: false,
                        touchZoom: false,
                        doubleClickZoom: false,
                        boxZoom: false,
                        scrollWheelZoom: false
                    })

                    map1.setZoom(4);

                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        attribution: '© OpenStreetMap contributors'
                    }).addTo(map1);

                    // Load the GPX file onto map1
                    var gpxLayer = new L.GPX('../gpx/aw.gpx', {
                        async: true,
                        marker_options: {
                            startIconUrl: '../img/mappins/start-pin.png',
                            endIconUrl: '../img/mappins/end-pin.png',
                            shadowUrl: '../img/mappins/shadow.png'
                        },
                    }).on('loaded', function(e) {
                        map1.fitBounds(e.target.getBounds());
                    }).addTo(map1);
                }
            } else if ($('#carouselItem2').hasClass('active')) {
                if (!map2) {
                    map2 = L.map('map2', {
                        zoomControl: false,
                        dragging: false,
                        touchZoom: false,
                        doubleClickZoom: false,
                        boxZoom: false,
                        scrollWheelZoom: false
                    }).setView([40.7128, -74.0060], 13);
                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        attribution: '© OpenStreetMap contributors'
                    }).addTo(map2);
                }
            } else if ($('#carouselItem3').hasClass('active')) {
                if (!map3) {
                    map3 = L.map('map3', {
                        zoomControl: false,
                        dragging: false,
                        touchZoom: false,
                        doubleClickZoom: false,
                        boxZoom: false,
                        scrollWheelZoom: false
                    }).setView([34.0522, -118.2437], 13);
                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        attribution: '© OpenStreetMap contributors'
                    }).addTo(map3);
                }
            }
        }

        // Initial map initialization on page load
        $(document).ready(function() {
            initMaps();
        });
    </script>

</main>
<?php include("footer.php"); ?>