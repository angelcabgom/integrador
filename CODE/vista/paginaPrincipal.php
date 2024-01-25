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

    <div class="titulo-flex-wrapper">
        <h2 class="headerTituloInicio">Carreras recomendadas</h2>
        <h5 class="headerSubtituloInicio">Una selección de las mejores carreras elegidas por TrekWikia</h5>
    </div>

    <div class="icons-container">
        <span class="icon material-symbols-outlined active-icon" onclick="goToSlide(0)">
            hiking
        </span>
        <span class="icon material-symbols-outlined" onclick="goToSlide(1)">
            directions_bike
        </span>
        <span class="icon material-symbols-outlined" onclick="goToSlide(2)">
            sprint
        </span>
        <span class="icon material-symbols-outlined" onclick="goToSlide(3)">
            directions_car
        </span>
        <span class="icon material-symbols-outlined" onclick="goToSlide(4)">
            downhill_skiing
        </span>
        <span class="icon material-symbols-outlined" onclick="goToSlide(5)">
            snowmobile
        </span>
    </div>

    <div id="mapCarousel" class="carousel slide">
        <div class="carousel-indicators">
            <span data-bs-target="#mapCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1">
                <i class="material-icons">hiking</i>
            </span>
            <span data-bs-target="#mapCarousel" data-bs-slide-to="1" aria-label="Slide 2">
                <i class="material-icons">directions_bike</i>
            </span>
            <span data-bs-target="#mapCarousel" data-bs-slide-to="2" aria-label="Slide 3">
                <i class="material-icons">sprint</i>
            </span>
            <span data-bs-target="#mapCarousel" data-bs-slide-to="3" aria-label="Slide 4">
                <i class="material-icons">directions_car</i>
            </span>
            <span data-bs-target="#mapCarousel" data-bs-slide-to="4" aria-label="Slide 5">
                <i class="material-icons">downhill_skiing</i>
            </span>
            <span data-bs-target="#mapCarousel" data-bs-slide-to="5" aria-label="Slide 6">
                <i class="material-icons">snowmobile</i>
            </span>
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
            <div class="carousel-item" id="carouselItem4">
                <div id="map4" class="leaflet-container"></div>
                <div class="carousel-caption d-none d-md-block always-visible">
                    <h5>Third slide label</h5>
                    <p>Some representative placeholder content for the third slide.</p>
                </div>
            </div>
            <div class="carousel-item" id="carouselItem5">
                <div id="map5" class="leaflet-container"></div>
                <div class="carousel-caption d-none d-md-block always-visible">
                    <h5>Third slide label</h5>
                    <p>Some representative placeholder content for the third slide.</p>
                </div>
            </div>
            <div class="carousel-item" id="carouselItem6">
                <div id="map6" class="leaflet-container"></div>
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
        function goToSlide(slideIndex) {
            var carousel = new bootstrap.Carousel(document.getElementById('mapCarousel'));
            var indicators = document.querySelectorAll('.carousel-indicators span');
            var icons = document.querySelectorAll('.icons-container .icon');

            indicators.forEach(function(indicator) {
                indicator.classList.remove('active');
            });

            icons.forEach(function(icon) {
                icon.classList.remove('active-icon');
            });

            indicators[slideIndex].classList.add('active');

            icons[slideIndex].classList.add('active-icon');

            carousel.to(slideIndex);
        }

        var map1, map2, map3, map4, map5, map6;

        document.getElementById('mapCarousel').addEventListener('slid.bs.carousel', function(e) {
            var currentIndex = e.to;
            var icons = document.querySelectorAll('.icons-container .icon');
          
            icons.forEach(function(icon) {
                icon.classList.remove('active-icon');
            });

            icons[currentIndex].classList.add('active-icon');
        });

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
                    }).setView([40.7128, -74.0060], 12);
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
                    }).setView([34.0522, -118.2437], 12);
                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        attribution: '© OpenStreetMap contributors'
                    }).addTo(map3);
                }
            } else if ($('#carouselItem4').hasClass('active')) {
                if (!map4) {
                    map4 = L.map('map4', {
                        zoomControl: false,
                        dragging: false,
                        touchZoom: false,
                        doubleClickZoom: false,
                        boxZoom: false,
                        scrollWheelZoom: false
                    }).setView([40.7128, -74.0060], 12);
                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        attribution: '© OpenStreetMap contributors'
                    }).addTo(map4);
                }
            } else if ($('#carouselItem5').hasClass('active')) {
                if (!map5) {
                    map5 = L.map('map5', {
                        zoomControl: false,
                        dragging: false,
                        touchZoom: false,
                        doubleClickZoom: false,
                        boxZoom: false,
                        scrollWheelZoom: false
                    }).setView([35.6895, 139.6917], 12);
                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        attribution: '© OpenStreetMap contributors'
                    }).addTo(map5);
                }
            } else if ($('#carouselItem6').hasClass('active')) {
                if (!map6) {
                    map6 = L.map('map6', {
                        zoomControl: false,
                        dragging: false,
                        touchZoom: false,
                        doubleClickZoom: false,
                        boxZoom: false,
                        scrollWheelZoom: false
                    }).setView([-33.8688, 151.2093], 12);
                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        attribution: '© OpenStreetMap contributors'
                    }).addTo(map6);
                }
            }
        }

        document.addEventListener("DOMContentLoaded", function() {
            initMaps();
        });
    </script>


</main>
<?php include("footer.php"); ?>