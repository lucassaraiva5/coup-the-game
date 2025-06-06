@extends('layouts.custom')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h2 class="mb-0">Event Details</h2>
                    <a href="{{ route('events.index') }}" class="btn btn-secondary">Back to List</a>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <h3>{{ $event->name }}</h3>
                        <p class="text-muted">Date: {{ $event->date->format('F j, Y') }}</p>
                    </div>

                    @if($event->images)
                        <div class="mb-4">
                            <h4>Event Images</h4>
                            <div class="row g-3">
                                @foreach($event->images as $image)
                                    <div class="col-md-4">
                                        <a href="{{ asset('storage/' . $image) }}" 
                                           target="_blank" 
                                           class="d-block">
                                            <img src="{{ asset('storage/' . $image) }}" 
                                                 alt="Event image" 
                                                 class="img-fluid rounded shadow-sm"
                                                 style="width: 100%; height: 200px; object-fit: cover;">
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <div class="mt-4">
                        <a href="{{ route('events.edit', $event) }}" class="btn btn-warning me-2">Edit Event</a>
                        <form action="{{ route('events.destroy', $event) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="btn btn-danger" 
                                    onclick="return confirm('Are you sure you want to delete this event?')">
                                Delete Event
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 