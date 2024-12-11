@extends('template.layouts.app')
@section('title', 'Edit Destination')
@section('content')
<div class="content-wrapper">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Edit Destination</h4>
            <p class="card-description">Update the destination details</p>
            <!-- Form untuk Edit Destination -->
            <form action="{{ route('destinations.update', $destination->id) }}" method="POST">
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
                    <input type="text" name="location" class="form-control" id="location" value="{{ old('location', $destination->location) }}" required>
                    @error('location')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

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
                    <label for="latitude">Latitude</label>
                    <input type="text" name="latitude" class="form-control" id="latitude" value="{{ old('latitude', $destination->latitude) }}">
                    @error('latitude')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="longitude">Longitude</label>
                    <input type="text" name="longitude" class="form-control" id="longitude" value="{{ old('longitude', $destination->longitude) }}">
                    @error('longitude')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="image">Image URL</label>
                    <input type="text" name="image" class="form-control" id="image" value="{{ old('image', $destination->image) }}">
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
@endsection
