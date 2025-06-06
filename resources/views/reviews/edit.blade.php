@extends('layouts.custom')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h2 class="mb-0">Edit Review</h2>
                    <a href="{{ route('reviews.index') }}" class="btn btn-secondary">Back to List</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('reviews.update', $review) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" 
                                   class="form-control @error('email') is-invalid @enderror" 
                                   id="email" 
                                   name="email" 
                                   value="{{ old('email', $review->email) }}" 
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
                                           {{ (old('rating', $review->rating) == $i) ? 'checked' : '' }}
                                           required>
                                    <label for="star{{ $i }}" title="{{ $i }} stars">
                                        <i class="bi bi-star-fill"></i>
                                    </label>
                                @endfor
                            </div>
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
                                      required>{{ old('review', $review->review) }}</textarea>
                            @error('review')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Update Review</button>
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
}

.star-rating label:hover,
.star-rating label:hover ~ label,
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