@extends('layouts.custom')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h2 class="mb-0">Review Details</h2>
                    <a href="{{ route('reviews.index') }}" class="btn btn-secondary">Back to List</a>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <h5 class="text-muted">Email</h5>
                        <p class="lead">{{ $review->email }}</p>
                    </div>

                    <div class="mb-4">
                        <h5 class="text-muted">Rating</h5>
                        <div class="fs-4">
                            @for($i = 1; $i <= 5; $i++)
                                <i class="bi bi-star{{ $i <= $review->rating ? '-fill' : '' }} text-warning"></i>
                            @endfor
                        </div>
                    </div>

                    <div class="mb-4">
                        <h5 class="text-muted">Review</h5>
                        <p class="lead">{{ $review->review }}</p>
                    </div>

                    <div class="mb-4">
                        <h5 class="text-muted">Date Submitted</h5>
                        <p>{{ $review->created_at->format('F j, Y g:i A') }}</p>
                    </div>

                    <div class="mt-4">
                        <a href="{{ route('reviews.edit', $review) }}" class="btn btn-warning me-2">Edit Review</a>
                        <form action="{{ route('reviews.destroy', $review) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="btn btn-danger" 
                                    onclick="return confirm('Are you sure you want to delete this review?')">
                                Delete Review
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 