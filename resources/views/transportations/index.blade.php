@extends('template.layouts.app')
@section('title', 'Transportations')
@section('content')
<div class="content-wrapper">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Transportation List</h4>
            <p class="card-description">List of all transportations</p>
            <a href="{{ route('transportations.create') }}" class="btn btn-primary">Add New Transportation</a>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Type</th>
                            <th>Location</th>
                            <th>Price Range</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transportations as $transportation)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                @if($transportation->image_url)
                                    <img src="{{ $transportation->image_url }}" alt="{{ $transportation->name }}" style="width: 100px; height: auto;">
                                @else
                                    <span>No Image</span>
                                @endif
                            </td>
                            <td>{{ $transportation->name }}</td>
                            <td>{{ ucfirst($transportation->type) }}</td>
                            <td>
                                @if($transportation->latitude && $transportation->longitude)
                                    <a href="https://www.google.com/maps/search/?api=1&query={{ $transportation->latitude }},{{ $transportation->longitude }}" target="_blank">
                                        {{ $transportation->location ?? 'View on Map' }}
                                    </a>
                                @else
                                    {{ $transportation->location ?? 'No Location' }}
                                @endif
                            </td>
                            <td>{{ $transportation->price_range ?? 'Not Specified' }}</td>
                            <td>{{ $transportation->created_at->format('d M Y') }}</td>
                            <td>
                                <a href="{{ route('transportations.edit', $transportation->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('transportations.destroy', $transportation->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure to delete this transportation?')">Delete</button>
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
