<?php

// Estas variables tienen que estar incluidas siempre por regla general

// Comprobar las redirecciones de los usuarios logados en login, register...
$nombreArchivo = basename(__FILE__);


// se usa ***antes*** de incluir los header para incluir los estilos con la funcion incluirEstilos
$estilosDinamicos = [
    "login" => "../css/explorarPais.css",
];

include("headGlobal.php");

?>
<script>
    // fetch del endpoint de la api
    function fetchData() {
        // saco los params de la url
        const urlParams = new URLSearchParams(window.location.search);
        const pais = urlParams.get('pais');

        if (pais) {
            // crear request basado en parametro
            const url = `http://localhost/integrador/code/servicios/rutas/explorarPais.php?pais=${pais}`;
            console.log(url);

            // sacar los datos
            fetch(url)
                .then(response => response.json())
                .then(data => {
                    console.log('Data fetched successfully:', data);
                    generatePage(data);
                })
                .catch(error => console.error('Error fetching data:', error));
        } else {
            console.error('Error: Pais parameter is missing in the URL');
        }
    }

    function generatePage(jsonData) {
        // Cojo el contenedor para las rutas
        var container = document.querySelector('.cuerpo');
        var titulo = document.querySelector('.titulo');
        titulo.innerHTML = `Rutas de ${jsonData[0].pais}`; // Pongo el índice 0 pero puede ser cualquiera ya que es común para toda la página

        // Bucle para crear y añadir los elementos
        jsonData.forEach(function(route) {
            // Div de cada ruta
            var routeDiv = document.createElement('div');
            routeDiv.className = 'ruta-main card';

            // El body del card
            var cardBody = document.createElement('div');
            cardBody.className = 'ruta-body card-body';

            // Crear el enlace
            var link = document.createElement('a');
            link.href = `http://localhost/integrador/code/vista/detalleCarrera.php?id=${route.id}`;
            link.innerHTML = `<h5 class="ruta-titulo card-title">${route.nombre}</h5>`;
            cardBody.appendChild(link);

            // Añadir la ubicación (ciudad y región)
            var locationText = document.createElement('p');
            locationText.className = 'ruta-location card-text';
            locationText.textContent = `${route.ciudad}, ${route.region}`;
            cardBody.appendChild(locationText);

            // Añadir la descripción de la ruta con una etiqueta
            var descriptionLabel = document.createElement('p');
            descriptionLabel.textContent = 'Descripción:';
            descriptionLabel.className = 'ruta-descripcion-label card-text';
            cardBody.appendChild(descriptionLabel);

            var description = document.createElement('p');
            description.className = 'ruta-texto card-text';
            description.textContent = route.descripcion;
            cardBody.appendChild(description);

            // Div para el mapa
            var mapDiv = document.createElement('div');
            mapDiv.id = `map-${route.id}`;
            mapDiv.className = 'map';

            // Añadir el mapa al body del card
            cardBody.appendChild(mapDiv);

            // Añadir el body del card al div de la ruta
            routeDiv.appendChild(cardBody);

            // Añadir la ruta al contenedor
            container.appendChild(routeDiv);

            // Inicializar el mapa
            initMap(`map-${route.id}`, route.archivo);
        });
    }

    function initMap(mapId, route) {
        // crear el mapa para el id adecuado
        var map = L.map(mapId, {
            zoomControl: false,
            dragging: false,
            touchZoom: false,
            doubleClickZoom: false,
            boxZoom: false,
            scrollWheelZoom: false
        });

       
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '©OpenStreetMap contributors'
        }).addTo(map);

        
        loadGpxData(map, route);
    }

    function loadGpxData(map, route) {
        var gpxPath = '../data/subidasgpx/' + route;

        if (gpxPath) {
            var gpxLayer = new L.GPX(gpxPath, {
                    async: true,
                    marker_options: {
                        startIconUrl: '../img/mappins/start-pin.png',
                        endIconUrl: '../img/mappins/end-pin.png',
                        shadowUrl: '../img/mappins/shadow.png'
                    },
                })
                .on('loaded', function(e) {
                    map.fitBounds(e.target.getBounds());
                })
                .on('error', function(error) {
                    console.error('Error loading GPX file:', error);
                })
                .addTo(map);
        }
    }

    fetchData();
</script>

<main>
    <div class="custom-main">
        <h2 class="titulo"></h2>
        <div class="cuerpo">
            <!-- contenido principal -->
        </div>
    </div>
</main>
<?php include("footer.php"); ?>