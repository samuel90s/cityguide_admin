@extends('template.layouts.app')
@section('title', 'Create Event')
@section('content')
<div class="content-wrapper">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Add New Event</h4>
            <form action="{{ route('events.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Event Name</label>
                    <input type="text" name="name" class="form-control" id="name" value="{{ old('name') }}" required>
                    @error('name') <div class="text-danger">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <label for="event_date">Event Date</label>
                    <input type="date" name="event_date" class="form-control" id="event_date" value="{{ old('event_date') }}" required>
                    @error('event_date') <div class="text-danger">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <label for="location">Location</label>
                    <input type="text" name="location" class="form-control" id="location" value="{{ old('location') }}">
                    @error('location') <div class="text-danger">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <label for="ticket_price">Ticket Price</label>
                    <input type="text" name="ticket_price" class="form-control" id="ticket_price" value="{{ old('ticket_price') }}">
                    @error('ticket_price') <div class="text-danger">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <label for="image">Image URL</label>
                    <input type="text" name="image" class="form-control" id="image" value="{{ old('image') }}">
                    @error('image') <div class="text-danger">{{ $message }}</div> @enderror
                </div>
                <button type="submit" class="btn btn-primary">Create Event</button>
            </form>
        </div>
    </div>
</div>
@endsection
