@extends('layouts.custom')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Events</h2>
        @auth
            <a href="{{ route('events.create') }}" class="btn btn-primary">Create New Event</a>
        @endauth
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Date</th>
                            <th>Images</th>
                            @auth
                                <th>Actions</th>
                            @endauth
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($events as $event)
                            <tr>
                                <td>{{ $event->name }}</td>
                                <td>{{ $event->date->format('F j, Y') }}</td>
                                <td>
                                    <div class="d-flex gap-2 flex-wrap">
                                        @if($event->images)
                                            @foreach($event->images as $image)
                                                <img src="{{ asset('storage/' . $image) }}" 
                                                     alt="Event image" 
                                                     class="img-thumbnail"
                                                     style="width: 50px; height: 50px; object-fit: cover;">
                                            @endforeach
                                        @endif
                                    </div>
                                </td>
                                @auth
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('events.show', $event) }}" 
                                               class="btn btn-sm btn-info text-white">
                                                View
                                            </a>
                                            <a href="{{ route('events.edit', $event) }}" 
                                               class="btn btn-sm btn-warning text-white">
                                                Edit
                                            </a>
                                            <form action="{{ route('events.destroy', $event) }}" 
                                                  method="POST" 
                                                  class="d-inline"
                                                  onsubmit="return confirm('Are you sure you want to delete this event?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                @endauth
                            </tr>
                        @empty
                            <tr>
                                <td colspan="{{ Auth::check() ? '4' : '3' }}" class="text-center">No events found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="mt-4">
                {{ $events->links() }}
            </div>
        </div>
    </div>
</div>
@endsection 