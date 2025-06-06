@extends('layouts.custom')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h2 class="mb-0">Partner Store Details</h2>
                    <a href="{{ route('partner-stores.index') }}" class="btn btn-secondary">Back to List</a>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <h5 class="text-muted">Store Name</h5>
                        <p class="lead">{{ $partnerStore->name }}</p>
                    </div>

                    <div class="mb-4">
                        <h5 class="text-muted">Product Link</h5>
                        <p>
                            <a href="{{ $partnerStore->product_link }}" 
                               target="_blank"
                               class="text-decoration-none">
                                {{ $partnerStore->product_link }}
                                <i class="bi bi-box-arrow-up-right ms-1"></i>
                            </a>
                        </p>
                    </div>

                    <div class="mb-4">
                        <h5 class="text-muted">Added On</h5>
                        <p>{{ $partnerStore->created_at->format('F j, Y g:i A') }}</p>
                    </div>

                    <div class="mb-4">
                        <h5 class="text-muted">Last Updated</h5>
                        <p>{{ $partnerStore->updated_at->format('F j, Y g:i A') }}</p>
                    </div>

                    <div class="mt-4">
                        <a href="{{ route('partner-stores.edit', $partnerStore) }}" class="btn btn-warning me-2">Edit Store</a>
                        <form action="{{ route('partner-stores.destroy', $partnerStore) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="btn btn-danger" 
                                    onclick="return confirm('Are you sure you want to delete this store?')">
                                Delete Store
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 