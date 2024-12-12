@extends('template.layouts.app')
@section('title', 'Edit Accommodation')
@section('content')
<div class="content-wrapper">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Edit Accommodation</h4>
            <p class="card-description">Update the details of the accommodation</p>
            <form action="{{ route('accommodations.update', $accommodation->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Accommodation Name</label>
                    <input type="text" name="name" class="form-control" id="name" value="{{ old('name', $accommodation->name) }}" required>
                    @error('name') <div class="text-danger">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="price_per_night">Price Per Night</label>
                    <input type="text" name="price_per_night" class="form-control" id="price_per_night" value="{{ old('price_per_night', $accommodation->price_per_night) }}">
                    @error('price_per_night') <div class="text-danger">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="facilities">Facilities</label>
                    <textarea name="facilities" class="form-control" id="facilities">{{ old('facilities', $accommodation->facilities) }}</textarea>
                    @error('facilities') <div class="text-danger">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="location">Location</label>
                    <input type="text" name="location" class="form-control" id="location" value="{{ old('location', $accommodation->location) }}" placeholder="Search for a location">
                    <div id="map" style="width: 100%; height: 400px;"></div>
                    @error('location') <div class="text-danger">{{ $message }}</div> @enderror
                </div>

                <input type="hidden" name="latitude" id="latitude" value="{{ old('latitude', $accommodation->latitude) }}">
                <input type="hidden" name="longitude" id="longitude" value="{{ old('longitude', $accommodation->longitude) }}">

                <div class="form-group">
                    <label for="image">Upload Image</label>
                    <input type="file" name="image" class="form-control" id="image">
                    @if($accommodation->image_url)
                        <img src="{{ $accommodation->image_url }}" alt="{{ $accommodation->name }}" class="mt-2" style="width: 150px; height: auto;">
                    @endif
                    @error('image') <div class="text-danger">{{ $message }}</div> @enderror
                </div>

                <button type="submit" class="btn btn-primary mt-3">Update Accommodation</button>
                <a href="{{ route('accommodations.index') }}" class="btn btn-secondary mt-3 ml-2">Cancel</a>
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
