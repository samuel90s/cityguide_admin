@extends('template.layouts.app')
@section('title', 'Edit Destination')
@section('content')
<div class="content-wrapper">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Edit Destination</h4>
            <p class="card-description">Update the destination details</p>
            <form action="{{ route('destinations.update', $destination->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name">Destination Name</label>
                    <input type="text" name="name" class="form-control" id="name" value="{{ old('name', $destination->name) }}" required>
                    @error('name')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" class="form-control" id="description">{{ old('description', $destination->description) }}</textarea>
                    @error('description')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="location">Location</label>
                    <input type="text" name="location" class="form-control" id="location" placeholder="Search for a location" value="{{ old('location', $destination->location) }}">
                    <div id="map" style="width: 100%; height: 400px;"></div>
                    @error('location')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <input type="hidden" name="latitude" id="latitude" value="{{ old('latitude', $destination->latitude) }}">
                <input type="hidden" name="longitude" id="longitude" value="{{ old('longitude', $destination->longitude) }}">

                <div class="form-group">
                    <label for="category">Category</label>
                    <select name="category" class="form-control" id="category" required>
                        <option value="natural" {{ old('category', $destination->category) == 'natural' ? 'selected' : '' }}>Natural</option>
                        <option value="cultural" {{ old('category', $destination->category) == 'cultural' ? 'selected' : '' }}>Cultural</option>
                        <option value="recreational" {{ old('category', $destination->category) == 'recreational' ? 'selected' : '' }}>Recreational</option>
                        <option value="culinary" {{ old('category', $destination->category) == 'culinary' ? 'selected' : '' }}>Culinary</option>
                    </select>
                    @error('category')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="price_range">Price Range</label>
                    <input type="text" name="price_range" class="form-control" id="price_range" value="{{ old('price_range', $destination->price_range) }}">
                    @error('price_range')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="opening_hours">Opening Hours</label>
                    <input type="text" name="opening_hours" class="form-control" id="opening_hours" value="{{ old('opening_hours', $destination->opening_hours) }}" placeholder="e.g., 09:00 - 18:00">
                    @error('opening_hours')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="image">Upload Image</label>
                    <input type="file" name="image" class="form-control" id="image">
                    @if($destination->image_url)
                        <img src="{{ $destination->image_url }}" alt="{{ $destination->name }}" class="mt-2" style="width: 150px; height: auto;">
                    @endif
                    @error('image')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary mt-3">Update Destination</button>
                <a href="{{ route('destinations.index') }}" class="btn btn-secondary mt-3 ml-2">Cancel</a>
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
