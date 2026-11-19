@extends('layouts.app')

@section('title', $product->name . ' - Product Details')

@section('content')
<div class="d-flex justify-content-between align-items-center pb-2 mb-3 border-bottom">
    <h2>Product Details</h2>
    <div class="d-flex gap-2">
        <a href="{{ route('products.edit', $product) }}" class="btn btn-primary">Edit Product</a>
        <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">Back to List</a>
    </div>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body p-4">
        <div class="row mb-3">
            <div class="col-md-6">
                <h4 class="fw-bold mb-1">{{ $product->name }}</h4>
                <p class="text-muted mb-2">SKU: <strong>{{ $product->sku }}</strong> | Category: <span class="badge bg-secondary">{{ $product->category }}</span></p>
            </div>
            <div class="col-md-6 text-md-end">
                @if($product->stock_status === 'Out of Stock')
                    <span class="badge bg-danger fs-6">Out of Stock</span>
                @elseif($product->stock_status === 'Low Stock')
                    <span class="badge bg-warning text-dark fs-6">Low Stock</span>
                @else
                    <span class="badge bg-success fs-6">In Stock</span>
                @endif
            </div>
        </div>

        <hr>

        <div class="row g-3">
            <div class="col-md-3"><strong>Quantity in Stock:</strong><br>{{ $product->quantity }} units</div>
            <div class="col-md-3"><strong>Reorder Level:</strong><br>{{ $product->reorder_level }} units</div>
            <div class="col-md-3"><strong>Unit Price:</strong><br>${{ number_format($product->unit_price, 2) }}</div>
            <div class="col-md-3"><strong>Total Stock Value:</strong><br>${{ number_format($product->total_value, 2) }}</div>
            <div class="col-md-6"><strong>Supplier:</strong><br>{{ $product->supplier ?? 'N/A' }}</div>
            <div class="col-md-6"><strong>Last Updated:</strong><br>{{ $product->updated_at->format('M d, Y h:i A') }}</div>
            <div class="col-12"><strong>Description:</strong><br>{{ $product->description ?? 'No description provided.' }}</div>
        </div>

        <div class="mt-4 pt-3 border-top">
            <form action="{{ route('products.destroy', $product) }}" method="POST" onsubmit="return confirm('Permanently delete this product?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete Product</button>
            </form>
        </div>
    </div>
</div>
@endsection