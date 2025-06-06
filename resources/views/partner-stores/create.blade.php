@extends('layouts.custom')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h2 class="mb-0">Add New Partner Store</h2>
                    <a href="{{ route('partner-stores.index') }}" class="btn btn-secondary">Back to List</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('partner-stores.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="name" class="form-label">Store Name</label>
                            <input type="text" 
                                   class="form-control @error('name') is-invalid @enderror" 
                                   id="name" 
                                   name="name" 
                                   value="{{ old('name') }}" 
                                   required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="product_link" class="form-label">Product Link</label>
                            <input type="url" 
                                   class="form-control @error('product_link') is-invalid @enderror" 
                                   id="product_link" 
                                   name="product_link" 
                                   value="{{ old('product_link') }}" 
                                   placeholder="https://example.com/product"
                                   required>
                            <div class="form-text">Enter the full URL including https:// or http://</div>
                            @error('product_link')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Create Store</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 