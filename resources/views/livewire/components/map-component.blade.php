@push('styles')
    <link rel="stylesheet" href="{{ asset('css/leaflet.css') }}">
    <link rel="stylesheet" href="{{ asset('css/leaflet-routing-machine.css') }}">
    <link rel="stylesheet" href="{{ asset('css/leaflet-control-geocoder.css') }}">
@endpush
<div>
    <div wire:ignore id="map"></div>
    <button wire:click="initializeMap">Initialize Map</button>
</div>
@push('scripts')
    <script src="{{ asset('js/leaflet.js') }}"></script>
    <script src="{{ asset('js/leaflet-routing-machine.js') }}"></script>
    <script src="{{ asset('js/leaflet-geosearch.js') }}"></script>
    <script src="{{ asset('js/leaflet-control-geocoder.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Livewire.on('initializeMap', function(data) {
                var map = L.map('map').setView([data.lat, data.lng], data.zoom);

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors',
                    maxZoom: 18,
                }).addTo(map);

                L.Routing.control({
                    waypoints: [
                        L.latLng(data.lat, data.lng),
                        L.latLng(data.lat + 0.01, data.lng + 0.01),
                    ],
                }).addTo(map);

                L.Control.geocoder().addTo(map);
            });
        });
    </script>
@endpush
