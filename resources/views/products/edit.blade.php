@extends('layouts.app')

@section('title', 'Edit Product - FinTrack Hardware')

@section('content')
<div class="d-flex justify-content-between align-items-center pb-2 mb-3 border-bottom">
    <h2>Edit Product: {{ $product->name }}</h2>
    <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">Back to List</a>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body p-4">
        <form action="{{ route('products.update', $product) }}" method="POST">
            @csrf
            @method('PUT')
            @include('products._form')
            <div class="mt-4 d-flex gap-2">
                <button type="submit" class="btn btn-primary px-4">Update Product</button>
                <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection