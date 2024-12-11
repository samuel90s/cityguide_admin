@extends('template.layouts.app')
@section('title', 'Edit Transportation')
@section('content')
<div class="content-wrapper">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Edit Transportation</h4>
            <p class="card-description">Update the details of the transportation</p>
            <form action="{{ route('transportations.update', $transportation->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Transportation Name</label>
                    <input type="text" name="name" class="form-control" id="name" value="{{ old('name', $transportation->name) }}" required>
                    @error('name') <div class="text-danger">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <label for="type">Type</label>
                    <select name="type" class="form-control" id="type" required>
                        <option value="bus" {{ old('type', $transportation->type) == 'bus' ? 'selected' : '' }}>Bus</option>
                        <option value="car_rental" {{ old('type', $transportation->type) == 'car_rental' ? 'selected' : '' }}>Car Rental</option>
                        <option value="train" {{ old('type', $transportation->type) == 'train' ? 'selected' : '' }}>Train</option>
                        <option value="boat" {{ old('type', $transportation->type) == 'boat' ? 'selected' : '' }}>Boat</option>
                        <option value="plane" {{ old('type', $transportation->type) == 'plane' ? 'selected' : '' }}>Plane</option>
                    </select>
                    @error('type') <div class="text-danger">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" class="form-control" id="description">{{ old('description', $transportation->description) }}</textarea>
                    @error('description') <div class="text-danger">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <label for="price_range">Price Range</label>
                    <input type="text" name="price_range" class="form-control" id="price_range" value="{{ old('price_range', $transportation->price_range) }}">
                    @error('price_range') <div class="text-danger">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <label for="image">Image URL</label>
                    <input type="text" name="image" class="form-control" id="image" value="{{ old('image', $transportation->image) }}">
                    @error('image') <div class="text-danger">{{ $message }}</div> @enderror
                </div>
                <button type="submit" class="btn btn-primary">Update Transportation</button>
                <a href="{{ route('transportations.index') }}" class="btn btn-secondary ml-2">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection
