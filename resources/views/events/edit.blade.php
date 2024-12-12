@extends('template.layouts.app')
@section('title', 'Edit Event')
@section('content')
<div class="content-wrapper">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Edit Event</h4>
            <p class="card-description">Update the event details</p>
            <form action="{{ route('events.update', $event->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name">Event Name</label>
                    <input type="text" name="name" class="form-control" id="name" value="{{ old('name', $event->name) }}" required>
                    @error('name') <div class="text-danger">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="event_date">Event Date</label>
                    <input type="date" name="event_date" class="form-control" id="event_date" value="{{ old('event_date', $event->event_date) }}" required>
                    @error('event_date') <div class="text-danger">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="location">Location</label>
                    <input type="text" name="location" class="form-control" id="location" placeholder="Search for a location" value="{{ old('location', $event->location) }}">
                    <div id="map" style="width: 100%; height: 400px;"></div>
                    @error('location') <div class="text-danger">{{ $message }}</div> @enderror
                </div>

                <input type="hidden" name="latitude" id="latitude" value="{{ old('latitude', $event->latitude) }}">
                <input type="hidden" name="longitude" id="longitude" value="{{ old('longitude', $event->longitude) }}">

                <div class="form-group">
                    <label for="ticket_price">Ticket Price</label>
                    <input type="text" name="ticket_price" class="form-control" id="ticket_price" value="{{ old('ticket_price', $event->ticket_price) }}">
                    @error('ticket_price') <div class="text-danger">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="image">Upload Image</label>
                    <input type="file" name="image" class="form-control" id="image">
                    @if($event->image_url)
                        <img src="{{ $event->image_url }}" alt="{{ $event->name }}" class="mt-2" style="width: 150px; height: auto;">
                    @endif
                    @error('image') <div class="text-danger">{{ $message }}</div> @enderror
                </div>

                <button type="submit" class="btn btn-primary mt-3">Update Event</button>
                <a href="{{ route('events.index') }}" class="btn btn-secondary mt-3 ml-2">Cancel</a>
            </form>
        </div>
    </div>
</div>

<script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v5.0.3/mapbox-gl-geocoder.min.js"></script>
<link rel="stylesheet" href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v5.0.3/mapbox-gl-geocoder.css" />
<link href="https://api.mapbox.com/mapbox-gl-js/v3.8.0/mapbox-gl.css" rel="stylesheet">
<script src="https://api.mapbox.com/mapbox-gl-js/v3.8.0/mapbox-gl.js"></script>
<script>
    mapboxgl.accessToken = 'pk.eyJ1Ijoic2FteGRldiIsImEiOiJjbTRsN29peXgwbW5sMmlzY2M4Y2Z2cm55In0.ZF0agzmy2Rhx2JX1ci_Jdw';
    const defaultLat = parseFloat(document.getElementById('latitude').value) || 1.0456;
    const defaultLng = parseFloat(document.getElementById('longitude').value) || 104.0305;

    const map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/mapbox/streets-v12',
        center: [defaultLng, defaultLat],
        zoom: 13,
    });

    const marker = new mapboxgl.Marker({ draggable: true })
        .setLngLat([defaultLng, defaultLat])
        .addTo(map);

    // Update inputs when the marker is dragged
    marker.on('dragend', () => {
        const lngLat = marker.getLngLat();
        document.getElementById('latitude').value = lngLat.lat;
        document.getElementById('longitude').value = lngLat.lng;

        fetch(`https://api.mapbox.com/geocoding/v5/mapbox.places/${lngLat.lng},${lngLat.lat}.json?access_token=${mapboxgl.accessToken}`)
            .then(response => response.json())
            .then(data => {
                if (data.features && data.features.length > 0) {
                    document.getElementById('location').value = data.features[0].place_name;
                }
            });
    });

    // Add geocoder for location search
    const geocoder = new MapboxGeocoder({
        accessToken: mapboxgl.accessToken,
        mapboxgl: mapboxgl,
        bbox: [103.8005, 0.8356, 104.2605, 1.2456], // Bounding box for Batam
    });

    map.addControl(geocoder);

    geocoder.on('result', (event) => {
        const lngLat = event.result.center;
        marker.setLngLat(lngLat);
        map.setCenter(lngLat);
        map.setZoom(13);
        document.getElementById('latitude').value = lngLat[1];
        document.getElementById('longitude').value = lngLat[0];
        document.getElementById('location').value = event.result.place_name;
    });

    // Add click event to place marker on map click
    map.on('click', (event) => {
        const lngLat = event.lngLat;
        marker.setLngLat(lngLat);
        document.getElementById('latitude').value = lngLat.lat;
        document.getElementById('longitude').value = lngLat.lng;

        fetch(`https://api.mapbox.com/geocoding/v5/mapbox.places/${lngLat.lng},${lngLat.lat}.json?access_token=${mapboxgl.accessToken}`)
            .then(response => response.json())
            .then(data => {
                if (data.features && data.features.length > 0) {
                    document.getElementById('location').value = data.features[0].place_name;
                }
            });
    });
</script>
@endsection
