@extends('mobiles.layouts.module')

@section('content')
<div class="page-content">
    
    <div class="page-title page-title-small">
        <h2 style="color: black">
            <a href="#" data-back-button>
                <i class="fa fa-arrow-left" style="color: black"></i>
            </a>Logs Attendance
        </h2>
        <div class="divider"></div>
    </div>
    @foreach ($logs as $index => $log)  
        <div class="content mb-0">
            <div style="border: none; border: 1px solid #eef2f1; border-radius: 8px; padding: 10px; box-sizing: border-box;">
                <div class="float-start">
                    <h1 class="mb-0">{{ $log->site['name'] }}</h1>
                    @if ($log->type == 'shift_off')
                       OFF 
                    @else    
                    <p class="font-10" id="address-{{ $index }}">
                        <i class="fa fa-map-marker-alt me-2"></i>Loading address...
                    </p>
                    @endif
                </div>
                    @if ($log->type == 'shift_off')
                        
                    @else                  
                        <a href="#" 
                        class="float-end btn btn-xs bg-highlight rounded-xl shadow-xl text-uppercase font-900 mt-2 font-11" 
                        onclick="viewOnMap({{ $index }}); return false;">View on Map
                        </a>
                    @endif
                
                <div class="clearfix"></div>                
                <div class="divider mt-2 mb-3"></div>
                
                <div class="row">
                    <div class="col-4">
                        <strong class="color-theme">Date:</strong>
                        <p class="font-12"><i class="far fa-calendar me-2"></i>{{ $log->date->format('d-M-Y') }}</p>
                    </div>
                    <div class="col-4">
                        <strong class="color-theme">Time IN:</strong>
                        <p class="font-12"><i class="far fa-clock me-2"></i>
                            @if($log->clock_in)
                                {{ $log->clock_in->format('H:i') }}
                            @else
                                {{ '' }}
                            @endif
                        </p>
                    </div>
                    <div class="col-4">
                        <strong class="color-theme">Time OUT:</strong>
                        <p class="font-12"><i class="far fa-clock me-2"></i>
                            @if($log->clock_out)
                                {{ $log->clock_out->format('H:i') }}
                            @else
                                {{ '' }}
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>  
    @endforeach
</div>    

<div id="mapModal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.5); z-index:1000;">
    <div style="width:80%; height:80%; margin:5% auto; background:#fff; border-radius:8px; overflow:hidden; position:relative;">
        <div id="map" style="width:100%; height:100%;"></div>
        <button 
            style="position:absolute; top:10px; right:10px; background:#007bff; color:#fff; border:none; border-radius:5px; padding:10px 20px; cursor:pointer;" 
            onclick="closeMap()">Close
        </button>
    </div>
</div>

<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script>
    let map;  // Global variable to manage map instance

    // Fetch addresses for all logs
    @foreach ($logs as $index => $log)
        (function() {
            let latlng = "{{ $log->latlong }}".split(',');
            let lat = latlng[0];
            let lng = latlng[1];

            fetch(`https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${lat}&lon=${lng}`)
                .then(response => response.json())
                .then(data => {
                    let address = data.display_name;
                    document.getElementById('address-{{ $index }}').innerText = address;
                })
                .catch(error => console.error('Error fetching address:', error));
        })();
    @endforeach

    function viewOnMap(index) {
        // Collect all log data
        let latlngs = [];
        @foreach ($logs as $logIndex => $log)
            if ({{ $logIndex }} === index) {
                let latlng = "{{ $log->latlong }}".split(',');
                latlngs.push({
                    lat: parseFloat(latlng[0]),
                    lng: parseFloat(latlng[1])
                });
            }
        @endforeach

        document.getElementById('mapModal').style.display = 'block';

        // Remove any existing map instance
        if (map) {
            map.remove();
        }

        // Initialize map
        if (latlngs.length > 0) {
            let latCenter = latlngs.reduce((acc, loc) => acc + loc.lat, 0) / latlngs.length;
            let lngCenter = latlngs.reduce((acc, loc) => acc + loc.lng, 0) / latlngs.length;
            map = L.map('map').setView([latCenter, lngCenter], 13);

            L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
                maxZoom: 18,
                subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
            }).addTo(map);

            const customIcon = L.icon({
                iconUrl: 'https://img.icons8.com/?size=256&id=13800&format=png',
                iconSize: [48],
                iconAnchor: [16, 32],
                popupAnchor: [0, -32]
            });

            // Add markers for all selected locations
            latlngs.forEach(loc => {
                L.marker([loc.lat, loc.lng], { icon: customIcon }).addTo(map)
                    .bindPopup('Location')
                    .openPopup();
            });
        }
    }

    function closeMap() {
        document.getElementById('mapModal').style.display = 'none';
        // Remove map instance and reset the container
        if (map) {
            map.remove();
            map = null;
        }
        document.getElementById('map').innerHTML = "";
    }
</script>
@endsection
