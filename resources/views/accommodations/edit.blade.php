@extends('template.layouts.app')
@section('title', 'Edit Accommodation')
@section('content')
<div class="content-wrapper">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Edit Accommodation</h4>
            <p class="card-description">Update the details of the accommodation</p>
            <form action="{{ route('accommodations.update', $accommodation->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Accommodation Name</label>
                    <input type="text" name="name" class="form-control" id="name" value="{{ old('name', $accommodation->name) }}" required>
                    @error('name') <div class="text-danger">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" name="address" class="form-control" id="address" value="{{ old('address', $accommodation->address) }}">
                    @error('address') <div class="text-danger">{{ $message }}</div> @enderror
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
                    <label for="image">Image URL</label>
                    <input type="text" name="image" class="form-control" id="image" value="{{ old('image', $accommodation->image) }}">
                    @error('image') <div class="text-danger">{{ $message }}</div> @enderror
                </div>
                <button type="submit" class="btn btn-primary">Update Accommodation</button>
                <a href="{{ route('accommodations.index') }}" class="btn btn-secondary ml-2">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection
