<div class="row g-3">
    <div class="col-md-6">
        <label for="name" class="form-label fw-semibold">Product Name *</label>
        <input type="text" id="name" name="name" value="{{ old('name', $product->name ?? '') }}" class="form-control @error('name') is-invalid @enderror" required>
        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="col-md-6">
        <label for="sku" class="form-label fw-semibold">SKU Code *</label>
        <input type="text" id="sku" name="sku" value="{{ old('sku', $product->sku ?? '') }}" class="form-control @error('sku') is-invalid @enderror" placeholder="e.g., LUM-1004" required>
        @error('sku')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="col-md-6">
        <label for="category" class="form-label fw-semibold">Category *</label>
        <select id="category" name="category" class="form-select @error('category') is-invalid @enderror" required>
            <option value="">-- Select Category --</option>
            @foreach($categories as $cat)
                <option value="{{ $cat }}" {{ old('category', $product->category ?? '') === $cat ? 'selected' : '' }}>{{ $cat }}</option>
            @endforeach
        </select>
        @error('category')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="col-md-6">
        <label for="supplier" class="form-label fw-semibold">Supplier</label>
        <input type="text" id="supplier" name="supplier" value="{{ old('supplier', $product->supplier ?? '') }}" class="form-control @error('supplier') is-invalid @enderror">
        @error('supplier')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="col-md-4">
        <label for="quantity" class="form-label fw-semibold">Quantity in Stock *</label>
        <input type="number" id="quantity" name="quantity" min="0" value="{{ old('quantity', $product->quantity ?? 0) }}" class="form-control @error('quantity') is-invalid @enderror" required>
        @error('quantity')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="col-md-4">
        <label for="reorder_level" class="form-label fw-semibold">Reorder Level *</label>
        <input type="number" id="reorder_level" name="reorder_level" min="0" value="{{ old('reorder_level', $product->reorder_level ?? 10) }}" class="form-control @error('reorder_level') is-invalid @enderror" required>
        @error('reorder_level')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="col-md-4">
        <label for="unit_price" class="form-label fw-semibold">Unit Price ($) *</label>
        <input type="number" step="0.01" id="unit_price" name="unit_price" min="0" value="{{ old('unit_price', $product->unit_price ?? '0.00') }}" class="form-control @error('unit_price') is-invalid @enderror" required>
        @error('unit_price')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="col-12">
        <label for="description" class="form-label fw-semibold">Description</label>
        <textarea id="description" name="description" rows="3" class="form-control @error('description') is-invalid @enderror">{{ old('description', $product->description ?? '') }}</textarea>
        @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
</div>