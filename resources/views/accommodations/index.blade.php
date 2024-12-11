@extends('template.layouts.app')
@section('title', 'Accommodations')
@section('content')
<div class="content-wrapper">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Accommodation List</h4>
            <p class="card-description">List of all accommodations</p>
            <a href="{{ route('accommodations.create') }}" class="btn btn-primary">Add New Accommodation</a>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Price Per Night</th>
                            <th>Facilities</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($accommodations as $accommodation)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $accommodation->name }}</td>
                            <td>{{ $accommodation->address ?? 'No Address' }}</td>
                            <td>{{ $accommodation->price_per_night ? 'Rp ' . number_format($accommodation->price_per_night, 0, ',', '.') : 'Not Specified' }}</td>
                            <td>{{ $accommodation->facilities ?? 'No Facilities' }}</td>
                            <td>
                                <a href="{{ route('accommodations.edit', $accommodation->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('accommodations.destroy', $accommodation->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure to delete this accommodation?')">Delete</button>
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
