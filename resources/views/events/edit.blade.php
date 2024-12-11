@extends('template.layouts.app')
@section('title', 'Edit Event')
@section('content')
<div class="content-wrapper">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Edit Event</h4>
            <p class="card-description">Update the details of the event</p>
            <form action="{{ route('events.update', $event->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Event Name</label>
                    <input type="text" name="name" class="form-control" id="name" value="{{ old('name', $event->name) }}" required>
                    @error('name') <div class="text-danger">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <label for="event_date">Event Date</label>
                    <input type="date" name="event_date" class="form-control" id="event_date" value="{{ old('event_date', $event->event_date) }}" required>
                    @error('event_date') <div class="text-danger">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <label for="location">Location</label>
                    <input type="text" name="location" class="form-control" id="location" value="{{ old('location', $event->location) }}">
                    @error('location') <div class="text-danger">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <label for="ticket_price">Ticket Price</label>
                    <input type="text" name="ticket_price" class="form-control" id="ticket_price" value="{{ old('ticket_price', $event->ticket_price) }}">
                    @error('ticket_price') <div class="text-danger">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <label for="image">Image URL</label>
                    <input type="text" name="image" class="form-control" id="image" value="{{ old('image', $event->image) }}">
                    @error('image') <div class="text-danger">{{ $message }}</div> @enderror
                </div>
                <button type="submit" class="btn btn-primary">Update Event</button>
                <a href="{{ route('events.index') }}" class="btn btn-secondary ml-2">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection
