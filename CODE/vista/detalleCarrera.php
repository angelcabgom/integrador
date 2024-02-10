<?php

// Estas variables tienen que estar incluidas siempre por regla general

// Comprobar las redirecciones de los usuarios logados en login, register...
$nombreArchivo = basename(__FILE__);


// se usa ***antes*** de incluir los header para incluir los estilos con la funcion incluirEstilos
$estilosDinamicos = [
    "login" => "../css/detalleCarrera.css",
];

include("headGlobal.php");

?>

<main class="flex-grow-1 vh-100">
    <div class="titulo">
    </div>
    <div class="cuerpo">
        <div class="mapa">
            <p><b>MAPA</b></p>
            <div class="map" id="map"></div>
            <p><b>DESCRIPCION</b></p>
            <div class="descripcion"><span>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Odio veniam ea suscipit quos eligendi sed exercitationem, unde nobis nam soluta corporis consequuntur, ab optio impedit doloremque consequatur quia quaerat omnis.</span></div>
        </div>
        <div class="datos">
            <p><b>ORGANIZADOR</b></p>
            <div class="organizador"></div>
            <p><b>ESTADISTICAS</b></p>
            <div class="informacion"></div>
            <p><b>OTRAS</b></p>
            <div class="otros">Otros</div>
        </div>
    </div>
</main>
<script>
    let idOrg;

    function mostrarDatosCarrera() {
        const urlParams = new URLSearchParams(window.location.search);
        const id = urlParams.get('id');

        fetch(`http://localhost/integrador/code/servicios/rutas/detallesCarrera.php?id=${id}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Error al obtener los datos');
                }
                return response.json();
            })
            .then(jsonresponse => {
                document.querySelector(".titulo").innerHTML = `<h4>${jsonresponse.nombre}</h4>`;
                document.querySelector(".descripcion").innerHTML = `${jsonresponse.descripcion}`;
                const informacionDiv = document.querySelector(".informacion");
                informacionDiv.innerHTML = ""; // limpiar el contenedor 
                idOrg = jsonresponse.id_usuario;
                mostrarOrg();

                // Mapa para darles nombres bonicos a los properties 
                const claveMap = {
                    'dificultad': 'Dificultad',
                    'distancia': 'Distancia',
                    'altMin': 'Altitud minima',
                    'altMax': 'Altitud maxima',
                    'desnivelPos': 'Desnivel positivo',
                    'desnivelNeg': 'Desnivel negativo'
                };

                // itero sobre las claves y despues las comparo con las claves a mostrar en informacion
                Object.keys(jsonresponse).forEach(key => {
                    if (claveMap.hasOwnProperty(key)) {
                        let value = jsonresponse[key];
                        if (key !== 'dificultad' && key !== 'distancia') {
                            value = value + ' m';
                        } else if (key === 'distancia') {
                            value = (value / 1000).toFixed(2) + ' km';
                        }
                        const div = document.createElement("div");

                        div.innerHTML = `<b>${claveMap[key]}</b> ${value}`;

                        informacionDiv.appendChild(div);
                    }
                });

                // comprobar si existe archivo
                if (jsonresponse.hasOwnProperty('archivo')) {
                    // cojo el archivo gpx
                    const gpxFileURL = `../data/subidasgpx/${jsonresponse.archivo}`;

                    // cargo el
                    fetch(gpxFileURL)
                        .then(response => response.text())
                        .then(gpxData => {
                            displayGPXOnMap(gpxData);
                        })
                        .catch(error => {
                            console.error('Error loading GPX file:', error);
                        });
                }
            })
            .catch(error => {
                console.log("Se ha producido un error: " + error);
            });
    }

    mostrarDatosCarrera();

    function mostrarOrg() {
        console.log(idOrg);
        fetch(`http://localhost/integrador/code/servicios/rutas/getOrg.php?id=65`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Error al obtener los datos');
                }
                return response.json();
            })
            .then(jsonresponse => {
                getBandera(jsonresponse.pais)
                    .then(bandera => {
                        // cuando se haya sacado la bandera se hace el echo del string
                        console.log(bandera);
                        document.querySelector(".organizador").innerHTML = `${jsonresponse.organizacionNombre} - ${jsonresponse.username} ${bandera}`;
                    })
                    .catch(error => {
                        console.error('Error getting flag:', error);
                        document.querySelector(".organizador").innerHTML = `${jsonresponse.organizacionNombre} - ${jsonresponse.username}`;
                    });
            })
            .catch(error => {
                console.log("Se ha producido un error: " + error);
            });
    }

    async function getBandera(countryName) {
        if (countryName === 'N/A') {
            return '🌍'; // Emoji por defecto
        }

        try {
            // fetch del json coutnries 
            const response = await fetch('../json/countries.json');
            const countriesArray = await response.json();

            // encontrar objeto del pais
            const pais = countriesArray.find(country => country.name === countryName);

            // si se encuentra se busca el pais
            if (pais) {
                const flagCode = pais.flagCode;
                return `<img src="../img/flags/4x3/${flagCode}.svg">`;
            } else {
                return '🌍'; // emoji default
            }
        } catch (error) {
            console.error('Error fetching or processing country flag data:', error);
            return '🌍'; // default emoji
        }
    }



    var map = L.map('map', {
        worldCopyJump: true
    }).setView([0, 0], 2);
    var gpxLayer;
    var gpxDataJson;

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors',
        minZoom: 2,
    }).addTo(map);

    var maxBounds = L.latLngBounds([90, -9999], [-90, 9999]);
    map.setMaxBounds(maxBounds);

    function displayGPXOnMap(gpxData) {
        /* si hay alguna capa ya existente entonces se eliminar para evitar problemas */
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
            minZoom: 2,
            noWrap: true,
            worldCopyJump: true
        }).on('loaded', function(e) {
            const bounds = e.target.getBounds();
            map.fitBounds(bounds);
            const center = bounds.getCenter();

            var maxBounds = L.latLngBounds([90, -9999], [-90, 9999]);
            map.setMaxBounds(maxBounds);

        }).addTo(map);
    }
</script>
<?php include("footer.php"); ?>