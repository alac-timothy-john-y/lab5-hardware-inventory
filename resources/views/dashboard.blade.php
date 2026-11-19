@extends('layouts.app')

@section('title', 'Dashboard - FinTrack Hardware')

@section('content')
<div class="d-flex justify-content-between align-items-center pb-2 mb-3 border-bottom">
    <h2>Dashboard Overview</h2>
    <span class="badge bg-success p-2">Database: Connected</span>
</div>

@if($alertProducts->count() > 0)
    <div class="alert alert-low-stock shadow-sm mb-4" role="alert">
        <strong>Low / Out of Stock Alert!</strong>
        {{ $alertProducts->count() }} product(s) need restocking:
        {{ $alertProducts->pluck('name')->join(', ') }}.
    </div>
@endif

<div class="row mb-4">
    <div class="col-md-3 mb-3">
        <div class="card stat-card text-center p-3 shadow-sm border-0 border-primary-custom">
            <h5 class="text-muted small">Total Inventory Value</h5>
            <h2 class="fw-bold" style="color: var(--theme-primary);">${{ number_format($totalInventoryValue, 2) }}</h2>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card stat-card text-center p-3 shadow-sm border-0 border-secondary-custom">
            <h5 class="text-muted small">Total Products</h5>
            <h2 class="fw-bold" style="color: var(--theme-secondary);">{{ $totalProducts }}</h2>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card stat-card text-center p-3 shadow-sm border-0 border-accent-custom">
            <h5 class="text-muted small">Low / Out of Stock</h5>
            <h2 class="fw-bold" style="color: var(--theme-accent);">{{ $attentionCount }}</h2>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card stat-card text-center p-3 shadow-sm border-0 border-primary-custom" style="background-color: var(--theme-card-bg);">
            <h5 class="text-muted small">Stock Health Rate</h5>
            <h2 class="fw-bold" style="color: var(--theme-primary);">{{ $healthRate }}%</h2>
        </div>
    </div>
</div>

<div class="row mb-4">
    <div class="col-lg-6 mb-4">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white fw-bold py-3">Inventory Value by Category</div>
            <div class="card-body">
                <div class="chart-container"><canvas id="categoryValueChart"></canvas></div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 mb-4">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white fw-bold py-3">Stock Status Distribution</div>
            <div class="card-body">
                <div class="chart-container"><canvas id="stockStatusChart"></canvas></div>
            </div>
        </div>
    </div>
</div>

<div class="card shadow-sm border-0">
    <div class="card-header bg-white fw-bold py-3 d-flex justify-content-between align-items-center">
        <span>Recently Added Products</span>
        <a href="{{ route('products.index') }}" class="btn btn-sm btn-primary">View Full Inventory</a>
    </div>
    <div class="card-body table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead>
                <tr>
                    <th>SKU</th>
                    <th>Product Name</th>
                    <th>Category</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentProducts as $product)
                    <tr>
                        <td class="fw-bold">{{ $product->sku }}</td>
                        <td>{{ $product->name }}</td>
                        <td><span class="badge bg-light text-dark border">{{ $product->category }}</span></td>
                        <td>{{ $product->quantity }}</td>
                        <td>${{ number_format($product->unit_price, 2) }}</td>
                        <td>
                            @if($product->stock_status === 'Out of Stock')
                                <span class="badge bg-danger">Out of Stock</span>
                            @elseif($product->stock_status === 'Low Stock')
                                <span class="badge bg-warning text-dark">Low Stock</span>
                            @else
                                <span class="badge bg-success">In Stock</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="text-center text-muted py-3">No products found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const categoryLabels = @json($categorySummary->pluck('category'));
    const categoryValues = @json($categorySummary->pluck('total_value'));

    new Chart(document.getElementById('categoryValueChart'), {
        type: 'bar',
        data: {
            labels: categoryLabels,
            datasets: [{
                label: 'Total Value ($)',
                data: categoryValues,
                backgroundColor: ['#014B43', '#099078', '#d97706', '#2563eb', '#7c3aed', '#9C2113']
            }]
        },
        options: { responsive: true, maintainAspectRatio: false }
    });

    new Chart(document.getElementById('stockStatusChart'), {
        type: 'doughnut',
        data: {
            labels: ['In Stock', 'Low Stock', 'Out of Stock'],
            datasets: [{
                data: [{{ $inStockCount }}, {{ $lowStockCount }}, {{ $outOfStockCount }}],
                backgroundColor: ['#099078', '#f59e0b', '#9C2113']
            }]
        },
        options: { responsive: true, maintainAspectRatio: false }
    });
</script>
@endpush