@extends('layouts.custom')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Reviews</h2>
        <a href="{{ route('reviews.create') }}" class="btn btn-primary">Add New Review</a>
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
                            <th>Email</th>
                            <th>Rating</th>
                            <th>Review</th>
                            <th>Date</th>
                            @auth
                                <th>Actions</th>
                            @endauth
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($reviews as $review)
                            <tr>
                                <td>{{ $review->email }}</td>
                                <td>
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="bi bi-star{{ $i <= $review->rating ? '-fill' : '' }} text-warning"></i>
                                    @endfor
                                </td>
                                <td>{{ Str::limit($review->review, 100) }}</td>
                                <td>{{ $review->created_at->format('M d, Y') }}</td>
                                @auth
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('reviews.show', $review) }}" 
                                               class="btn btn-sm btn-info text-white">
                                                View
                                            </a>
                                            <a href="{{ route('reviews.edit', $review) }}" 
                                               class="btn btn-sm btn-warning text-white">
                                                Edit
                                            </a>
                                            <form action="{{ route('reviews.destroy', $review) }}" 
                                                  method="POST" 
                                                  class="d-inline"
                                                  onsubmit="return confirm('Are you sure you want to delete this review?');">
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
                                <td colspan="{{ Auth::check() ? '5' : '4' }}" class="text-center">No reviews found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="mt-4">
                {{ $reviews->links() }}
            </div>
        </div>
    </div>
</div>
@endsection 