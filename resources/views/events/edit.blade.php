@extends('layouts.custom')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h2 class="mb-0">Edit Event</h2>
                    <a href="{{ route('events.index') }}" class="btn btn-secondary">Back to List</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('events.update', $event) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label for="name" class="form-label">Event Name</label>
                            <input type="text" 
                                   class="form-control @error('name') is-invalid @enderror" 
                                   id="name" 
                                   name="name" 
                                   value="{{ old('name', $event->name) }}" 
                                   required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="date" class="form-label">Event Date</label>
                            <input type="date" 
                                   class="form-control @error('date') is-invalid @enderror" 
                                   id="date" 
                                   name="date" 
                                   value="{{ old('date', $event->date->format('Y-m-d')) }}" 
                                   required>
                            @error('date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="images" class="form-label">Event Images</label>
                            <input type="file" 
                                   class="form-control @error('images') is-invalid @enderror" 
                                   id="images" 
                                   name="images[]" 
                                   multiple 
                                   accept="image/*">
                            <div class="form-text">Leave empty to keep current images. Upload new images to replace all current ones.</div>
                            @error('images')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        @if($event->images)
                            <div class="mb-3">
                                <label class="form-label">Current Images</label>
                                <div class="d-flex gap-2 flex-wrap">
                                    @foreach($event->images as $image)
                                        <div class="position-relative">
                                            <img src="{{ asset('storage/' . $image) }}" 
                                                 alt="Event image" 
                                                 class="img-thumbnail"
                                                 style="width: 150px; height: 150px; object-fit: cover;">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <div id="imagePreview" class="mb-3 d-flex gap-2 flex-wrap"></div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Update Event</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.getElementById('images').addEventListener('change', function(event) {
        const preview = document.getElementById('imagePreview');
        preview.innerHTML = '<h6 class="form-label w-100">New Images Preview:</h6>';
        
        Array.from(event.target.files).forEach(file => {
            const reader = new FileReader();
            reader.onload = function(e) {
                const div = document.createElement('div');
                div.className = 'position-relative';
                
                const img = document.createElement('img');
                img.src = e.target.result;
                img.className = 'img-thumbnail';
                img.style.width = '150px';
                img.style.height = '150px';
                img.style.objectFit = 'cover';
                
                div.appendChild(img);
                preview.appendChild(div);
            }
            reader.readAsDataURL(file);
        });
    });
</script>
@endpush
@endsection 