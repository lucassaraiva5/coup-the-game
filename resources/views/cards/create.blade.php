@extends('layouts.custom')

@section('content')
<h2>Create Card</h2>
<form action="{{ route('cards.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label>Title</label>
        <input type="text" name="title" id="title" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Description</label>
        <textarea name="description" id="description" class="form-control" required></textarea>
    </div>
    <div class="mb-3">
        <label for="image">Upload</label>
        <input type="file" class="form-control" id="image" name="image">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection