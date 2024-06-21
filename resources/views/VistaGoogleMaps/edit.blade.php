@extends('Panza')

@section('PanzaArriba')
    Google Maps Edit
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
        let latitud = {{ $ubicacion->latitud }};
        let longitud = {{ $ubicacion->longitud }};

        function initMap() {
            var mapOptions = {
                center: new google.maps.LatLng(latitud, longitud),
                zoom: 13,
                streetViewControl: false
            };
            map = new google.maps.Map(document.getElementById("map"), mapOptions);

            // Agregar marcador inicial
            addMarker(new google.maps.LatLng(latitud, longitud));

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

        window.onload = initMap;
    </script>
    <div class="map-container">
        <h1>Google Maps</h1>
        <div id="map"></div>
        <div class="controls">
            <form action="{{ route('mapa.update', $ubicacion->id) }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" id="latitud" name="latitud" value="{{ $ubicacion->latitud }}">
                <input type="hidden" id="longitud" name="longitud" value="{{ $ubicacion->longitud }}">
                <button type="submit">Actualizar Ubicación</button>
            </form>
        </div>
    </div>
@endsection
