@extends('template.layouts.app')
@section('title', 'Create Accommodation')
@section('content')
<div class="content-wrapper">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Add New Accommodation</h4>
            <form action="{{ route('accommodations.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Accommodation Name</label>
                    <input type="text" name="name" class="form-control" id="name" value="{{ old('name') }}" required>
                    @error('name') <div class="text-danger">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" name="address" class="form-control" id="address" value="{{ old('address') }}">
                    @error('address') <div class="text-danger">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <label for="price_per_night">Price Per Night</label>
                    <input type="text" name="price_per_night" class="form-control" id="price_per_night" value="{{ old('price_per_night') }}">
                    @error('price_per_night') <div class="text-danger">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <label for="facilities">Facilities</label>
                    <textarea name="facilities" class="form-control" id="facilities">{{ old('facilities') }}</textarea>
                    @error('facilities') <div class="text-danger">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <label for="image">Image URL</label>
                    <input type="text" name="image" class="form-control" id="image" value="{{ old('image') }}">
                    @error('image') <div class="text-danger">{{ $message }}</div> @enderror
                </div>
                <button type="submit" class="btn btn-primary">Create Accommodation</button>
            </form>
        </div>
    </div>
</div>
@endsection
