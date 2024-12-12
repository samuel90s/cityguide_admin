@extends('template.layouts.app')
@section('title', 'Destinations')
@section('content')
<div class="content-wrapper">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Destination List</h4>
            <p class="card-description">List of all destinations</p>
            <a href="{{ route('destinations.create') }}" class="btn btn-primary">Add New Destination</a>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Destination Name</th>
                            <th>Description</th>
                            <th>Location</th>
                            <th>Category</th>
                            <th>Price Range</th>
                            <th>Opening Hours</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($destinations as $destination)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                @if($destination->image_url)
                                    <img src="{{ $destination->image_url }}" alt="{{ $destination->name }}" style="width: 100px; height: auto;">
                                @else
                                    <span>No Image</span>
                                @endif
                            </td>
                            <td>{{ $destination->name }}</td>
                            <td>{{ $destination->description ?? 'No description' }}</td>
                            <td>
                                <a href="https://www.google.com/maps/search/?api=1&query={{ $destination->latitude }},{{ $destination->longitude }}" target="_blank">
                                    {{ $destination->location }}
                                </a>
                            </td>
                            <td>{{ ucfirst($destination->category) }}</td>
                            <td>{{ $destination->price_range ?? 'Not Specified' }}</td>
                            <td>{{ $destination->opening_hours ?? 'Not Specified' }}</td>
                            <td>{{ $destination->created_at->format('d M Y') }}</td>
                            <td>
                                <a href="{{ route('destinations.edit', $destination->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('destinations.destroy', $destination->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure to delete this destination?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
