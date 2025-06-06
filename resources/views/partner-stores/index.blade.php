@extends('layouts.custom')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Partner Stores</h2>
        @auth
            <a href="{{ route('partner-stores.create') }}" class="btn btn-primary">Add New Store</a>
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
                            <th>Store Name</th>
                            <th>Product Link</th>
                            @auth
                                <th>Actions</th>
                            @endauth
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($stores as $store)
                            <tr>
                                <td>{{ $store->name }}</td>
                                <td>
                                    <a href="{{ $store->product_link }}" 
                                       target="_blank" 
                                       class="text-decoration-none">
                                        {{ Str::limit($store->product_link, 50) }}
                                        <i class="bi bi-box-arrow-up-right ms-1"></i>
                                    </a>
                                </td>
                                @auth
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('partner-stores.show', $store) }}" 
                                               class="btn btn-sm btn-info text-white">
                                                View
                                            </a>
                                            <a href="{{ route('partner-stores.edit', $store) }}" 
                                               class="btn btn-sm btn-warning text-white">
                                                Edit
                                            </a>
                                            <form action="{{ route('partner-stores.destroy', $store) }}" 
                                                  method="POST" 
                                                  class="d-inline"
                                                  onsubmit="return confirm('Are you sure you want to delete this store?');">
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
                                <td colspan="{{ Auth::check() ? '3' : '2' }}" class="text-center">No partner stores found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="mt-4">
                {{ $stores->links() }}
            </div>
        </div>
    </div>
</div>
@endsection 