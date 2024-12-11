@extends('template.layouts.app')
@section('title', 'Create Transportation')
@section('content')
<div class="content-wrapper">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Add New Transportation</h4>
            <form action="{{ route('transportations.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Transportation Name</label>
                    <input type="text" name="name" class="form-control" id="name" value="{{ old('name') }}" required>
                    @error('name') <div class="text-danger">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <label for="type">Type</label>
                    <select name="type" class="form-control" id="type" required>
                        <option value="" disabled selected>Select a Type</option>
                        <option value="bus" {{ old('type') == 'bus' ? 'selected' : '' }}>Bus</option>
                        <option value="car_rental" {{ old('type') == 'car_rental' ? 'selected' : '' }}>Car Rental</option>
                        <option value="train" {{ old('type') == 'train' ? 'selected' : '' }}>Train</option>
                        <option value="boat" {{ old('type') == 'boat' ? 'selected' : '' }}>Boat</option>
                        <option value="plane" {{ old('type') == 'plane' ? 'selected' : '' }}>Plane</option>
                    </select>
                    @error('type') <div class="text-danger">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" class="form-control" id="description">{{ old('description') }}</textarea>
                    @error('description') <div class="text-danger">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <label for="price_range">Price Range</label>
                    <input type="text" name="price_range" class="form-control" id="price_range" value="{{ old('price_range') }}">
                    @error('price_range') <div class="text-danger">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <label for="image">Image URL</label>
                    <input type="text" name="image" class="form-control" id="image" value="{{ old('image') }}">
                    @error('image') <div class="text-danger">{{ $message }}</div> @enderror
                </div>
                <button type="submit" class="btn btn-primary">Create Transportation</button>
            </form>
        </div>
    </div>
</div>
@endsection
