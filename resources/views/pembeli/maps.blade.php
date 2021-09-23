@extends('stisla.layouts.app')

@section('title')
  {{ isset($d) ? __('Ubah') : __('Tambah') }} {{ $title = 'Pembeli' }}
@endsection

@section('content')
  <div class="section-header">
    <h1>{{ $title }}</h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active">
        <a href="{{ route('dashboard.index') }}">{{ __('Dashboard') }}</a>
      </div>
      <div class="breadcrumb-item active">
        <a href="{{ route('pembelis.index') }}">{{ __('Pembeli') }}</a>
      </div>
      <div class="breadcrumb-item">{{ isset($d) ? __('Ubah') : __('Tambah') }} {{ $title }}</div>
    </div>
  </div>

  <div class="section-body">
    <div id="mapid" style="height:100vh;"></div>
  </div>
@endsection

@push('css')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
@endpush

@push('js')
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
<script>
    var data = {
            // lat.data[i][1] as latitude
            lat: {
                data: [
                    [0, {{$lat}}],
                    
                ]
            },
            // lng.data[i][1] as longtitude
            lng: {
                data: [
                    [0, {{$long}}],
                    
                ]
            }
        };

        
        bindMap(data);


        function bindMap(data) {

            var greenIcon = L.icon({
                iconUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/images/marker-icon.png',
                //shadowUrl:  'images/marker-icon.png',

                iconSize: [20, 30], // size of the icon
                shadowSize: [50, 64], // size of the shadow
                iconAnchor: [8, 29], // point of the icon which will correspond to marker's location
                shadowAnchor: [4, 62],  // the same for the shadow
                popupAnchor: [-3, -76] // point from which the popup should open relative to the iconAnchor
            });

            //var element = chart.selector.replace('#', '');
           var mapOptions = {
      center: [-8.169650, 113.702890],
      zoom: 12
    }
    var map = new L.map('mapid', mapOptions);

            L.tileLayer(
                'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: 'Data © <a href="http://osm.org/copyright">OpenStreetMap</a>',
                maxZoom: 20
            }).addTo(map);

            // var center = [29.608088, 52.530853];//[51.505, -0.09];
            // map.setView(center, 3);

            for (var i = 0; i < data.lat.data.length; i++) {
                center = [data.lat.data[i][1], data.lng.data[i][1]];
                L.marker(center, { icon: greenIcon }).addTo(map).bindPopup("Lat: " + data.lat.data[i][1] + "<br/>Lon: " + data.lng.data[i][1]);//.openPopup();;

            }

            setInterval(() => {
                map.invalidateSize();
            }, 500);

        }
</script>
@endpush
