@extends('template.layouts.app')
@section('title', 'Create Destination')
@section('content')
<div class="content-wrapper">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Add New Destination</h4>
            <p class="card-description">Create a new destination for your system</p>
            <!-- Form untuk Menambah Destination Baru -->
            <form action="{{ route('destinations.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Destination Name</label>
                    <input type="text" name="name" class="form-control" id="name" value="{{ old('name') }}" required>
                    @error('name')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" class="form-control" id="description">{{ old('description') }}</textarea>
                    @error('description')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="location">Location</label>
                    <input type="text" name="location" class="form-control" id="location" value="{{ old('location') }}" required>
                    @error('location')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="category">Category</label>
                    <select name="category" class="form-control" id="category" required>
                        <option value="" disabled selected>Select a Category</option>
                        <option value="natural" {{ old('category') == 'natural' ? 'selected' : '' }}>Natural</option>
                        <option value="cultural" {{ old('category') == 'cultural' ? 'selected' : '' }}>Cultural</option>
                        <option value="recreational" {{ old('category') == 'recreational' ? 'selected' : '' }}>Recreational</option>
                        <option value="culinary" {{ old('category') == 'culinary' ? 'selected' : '' }}>Culinary</option>
                    </select>
                    @error('category')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="price_range">Price Range (Optional)</label>
                    <input type="text" name="price_range" class="form-control" id="price_range" value="{{ old('price_range') }}">
                    @error('price_range')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="latitude">Latitude</label>
                    <input type="text" name="latitude" class="form-control" id="latitude" value="{{ old('latitude') }}">
                    @error('latitude')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="longitude">Longitude</label>
                    <input type="text" name="longitude" class="form-control" id="longitude" value="{{ old('longitude') }}">
                    @error('longitude')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="image">Image URL (Optional)</label>
                    <input type="text" name="image" class="form-control" id="image" value="{{ old('image') }}">
                    @error('image')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary mt-3">Create Destination</button>
                <a href="{{ route('destinations.index') }}" class="btn btn-secondary mt-3 ml-2">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection
