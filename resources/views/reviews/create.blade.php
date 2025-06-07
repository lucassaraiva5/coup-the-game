@extends('layouts.custom')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h2 class="mb-0">Add New Review</h2>
                    <a href="{{ route('reviews.index') }}" class="btn btn-secondary">Back to List</a>
                </div>
                <div class="card-body">
                    <div class="alert alert-info mb-4">
                        <i class="bi bi-info-circle me-2"></i>
                        Share your experience! No account needed to submit a review.
                    </div>

                    <form action="{{ route('reviews.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" 
                                   class="form-control @error('email') is-invalid @enderror" 
                                   id="email" 
                                   name="email" 
                                   value="{{ old('email') }}" 
                                   placeholder="your@email.com"
                                   required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Rating</label>
                            <div class="star-rating">
                                @for($i = 5; $i >= 1; $i--)
                                    <input type="radio" 
                                           id="star{{ $i }}" 
                                           name="rating" 
                                           value="{{ $i }}" 
                                           {{ old('rating') == $i ? 'checked' : '' }}
                                           required>
                                    <label for="star{{ $i }}" title="{{ $i }} stars">
                                        <i class="bi bi-star-fill"></i>
                                    </label>
                                @endfor
                            </div>
                            <small class="text-muted">Click on a star to rate</small>
                            @error('rating')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="review" class="form-label">Review</label>
                            <textarea class="form-control @error('review') is-invalid @enderror" 
                                      id="review" 
                                      name="review" 
                                      rows="4" 
                                      placeholder="Share your thoughts about the game..."
                                      required>{{ old('review') }}</textarea>
                            @error('review')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Submit Review</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.star-rating {
    display: flex;
    flex-direction: row-reverse;
    justify-content: flex-end;
}

.star-rating input {
    display: none;
}

.star-rating label {
    cursor: pointer;
    font-size: 1.5rem;
    color: #ddd;
    margin: 0 2px;
    transition: color 0.2s ease-in-out;
}

.star-rating label:hover,
.star-rating label:hover ~ label,
.star-rating input:checked ~ label {
    color: #ffc107;
}

.star-rating:hover label {
    color: #ddd;
}

.star-rating:hover label:hover,
.star-rating:hover label:hover ~ label {
    color: #ffc107;
}

.star-rating input:checked ~ label {
    color: #ffc107;
}
</style>

@push('scripts')
<script>
    document.querySelectorAll('.star-rating label').forEach(label => {
        label.addEventListener('mouseover', function() {
            this.querySelector('i').classList.remove('bi-star-fill');
            this.querySelector('i').classList.add('bi-star-fill');
        });

        label.addEventListener('mouseout', function() {
            if (!this.previousElementSibling.checked) {
                this.querySelector('i').classList.remove('bi-star-fill');
                this.querySelector('i').classList.add('bi-star-fill');
            }
        });
    });
</script>
@endpush
@endsection 