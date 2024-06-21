@extends('Panza')

@section('PanzaArriba')
    Crear Punto en Google Maps
@endsection

@section('PanzaAbajo')
    <style>
        #map {
            height: 500px;
            width: 100%;
        }
        .controls {
            margin-bottom: 20px;
            text-align: center;
        }
        .controls button {
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 8px;
        }
        .map-container {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }
    </style>
    <script src="https://maps.googleapis.com/maps/api/js?key={{ $apiKey }}"></script>
    <script>
        let map;
        let marker = null;
        let latitud, longitud;

        function initMap() {
            // Opciones predeterminadas del mapa
            var mapOptions = {
                center: new google.maps.LatLng(-17.7794277, -63.176994),
                zoom: 13,
                streetViewControl: false
            };
            map = new google.maps.Map(document.getElementById("map"), mapOptions);

            // Intentar obtener la ubicación del usuario
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    latitud = position.coords.latitude;
                    longitud = position.coords.longitude;
                    var userLocation = new google.maps.LatLng(latitud, longitud);
                    map.setCenter(userLocation);
                    addMarker(userLocation);

                    // Actualizar los campos del formulario
                    document.getElementById('latitud').value = latitud;
                    document.getElementById('longitud').value = longitud;
                }, function() {
                    handleLocationError(true, map.getCenter());
                });
            } else {
                // El navegador no soporta geolocalización
                handleLocationError(false, map.getCenter());
            }

            // Listener para agregar marcador en el mapa al hacer clic
            map.addListener('click', function(event) {
                addMarker(event.latLng);
                latitud = event.latLng.lat();
                longitud = event.latLng.lng();

                // Actualizar los campos del formulario
                document.getElementById('latitud').value = latitud;
                document.getElementById('longitud').value = longitud;
            });
        }

        function addMarker(location) {
            if (marker) {
                marker.setPosition(location);
            } else {
                marker = new google.maps.Marker({
                    position: location,
                    map: map
                });
            }
        }

        function handleLocationError(browserHasGeolocation, pos) {
            console.log(browserHasGeolocation ?
                'Error: El servicio de geolocalización falló.' :
                'Error: Tu navegador no soporta geolocalización.');
        }

        window.onload = initMap;
    </script>
    <div class="map-container">
        <h1>Google Maps</h1>
        <div id="map"></div>
        <div class="controls">
            <form action="{{ route('mapa.store') }}" method="POST">
                @csrf
                <input type="hidden" id="latitud" name="latitud">
                <input type="hidden" id="longitud" name="longitud">
                <button type="submit">Guardar Ubicación</button>
            </form>
        </div>
    </div>
@endsection
