@extends('layouts.app')

@section('title', 'Inventory List - FinTrack Hardware')

@section('content')
<div class="d-flex justify-content-between align-items-center pb-2 mb-3 border-bottom">
    <h2>Hardware Inventory List</h2>
    <a href="{{ route('products.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg me-1"></i>Add New Product
    </a>
</div>

<div class="card shadow-sm border-0 mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('products.index') }}" class="row g-3">
            <div class="col-md-4">
                <label class="form-label small fw-bold">Search Product or SKU</label>
                <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Name or SKU...">
            </div>
            <div class="col-md-3">
                <label class="form-label small fw-bold">Category</label>
                <select name="category" class="form-select">
                    <option value="All">All Categories</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat }}" {{ request('category') === $cat ? 'selected' : '' }}>{{ $cat }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label small fw-bold">Stock Status</label>
                <select name="status" class="form-select">
                    <option value="All">All Statuses</option>
                    <option value="In Stock" {{ request('status') === 'In Stock' ? 'selected' : '' }}>In Stock</option>
                    <option value="Low Stock" {{ request('status') === 'Low Stock' ? 'selected' : '' }}>Low Stock</option>
                    <option value="Out of Stock" {{ request('status') === 'Out of Stock' ? 'selected' : '' }}>Out of Stock</option>
                </select>
            </div>
            <div class="col-md-2 d-flex align-items-end gap-2">
                <button type="submit" class="btn btn-primary w-100">Filter</button>
                <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">Reset</a>
            </div>
        </form>
    </div>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body table-responsive">
        <table class="table table-striped table-hover align-middle">
            <thead>
                <tr>
                    <th>SKU</th>
                    <th>Product Name</th>
                    <th>Category</th>
                    <th>Qty</th>
                    <th>Reorder Lvl</th>
                    <th>Unit Price</th>
                    <th>Total Value</th>
                    <th>Status</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                    <tr class="{{ $product->isLowStock() ? 'table-danger-custom' : '' }}">
                        <td class="fw-bold">{{ $product->sku }}</td>
                        <td>{{ $product->name }}</td>
                        <td><span class="badge bg-light text-dark border">{{ $product->category }}</span></td>
                        <td>{{ $product->quantity }}</td>
                        <td>{{ $product->reorder_level }}</td>
                        <td>${{ number_format($product->unit_price, 2) }}</td>
                        <td class="fw-bold">${{ number_format($product->total_value, 2) }}</td>
                        <td>
                            @if($product->stock_status === 'Out of Stock')
                                <span class="badge bg-danger">Out of Stock</span>
                            @elseif($product->stock_status === 'Low Stock')
                                <span class="badge bg-warning text-dark">Low Stock</span>
                            @else
                                <span class="badge bg-success">In Stock</span>
                            @endif
                        </td>
                        <td class="text-end text-nowrap">
                            <a href="{{ route('products.show', $product) }}" class="btn btn-sm btn-outline-info">View</a>
                            <a href="{{ route('products.edit', $product) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                            <form action="{{ route('products.destroy', $product) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete {{ $product->name }}?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="9" class="text-center text-muted py-4">No products found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection