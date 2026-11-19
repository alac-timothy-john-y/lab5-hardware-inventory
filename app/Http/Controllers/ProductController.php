<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('sku', 'like', "%{$search}%");
            });
        }

        if ($request->filled('category') && $request->category !== 'All') {
            $query->where('category', $request->category);
        }

        if ($request->filled('status') && $request->status !== 'All') {
            if ($request->status === 'Out of Stock') {
                $query->where('quantity', '<=', 0);
            } elseif ($request->status === 'Low Stock') {
                $query->where('quantity', '>', 0)->whereColumn('quantity', '<=', 'reorder_level');
            } elseif ($request->status === 'In Stock') {
                $query->whereColumn('quantity', '>', 'reorder_level');
            }
        }

        $products = $query->orderBy('name')->get();
        $categories = ['Lumber', 'Hardware', 'Tools', 'Electrical', 'Plumbing', 'Paint'];

        return view('products.index', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = ['Lumber', 'Hardware', 'Tools', 'Electrical', 'Plumbing', 'Paint'];
        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'          => 'required|string|max:255',
            'sku'           => 'required|string|max:50|unique:products,sku',
            'description'   => 'nullable|string',
            'category'      => 'required|string|max:100',
            'quantity'      => 'required|integer|min:0',
            'reorder_level' => 'required|integer|min:0',
            'unit_price'    => 'required|numeric|min:0',
            'supplier'      => 'nullable|string|max:255',
        ], [
            'name.required'       => 'Product name is required.',
            'sku.required'        => 'SKU code is required.',
            'sku.unique'          => 'This SKU already exists in the inventory.',
            'quantity.min'        => 'Quantity cannot be negative.',
            'unit_price.min'      => 'Unit price must be 0 or higher.',
        ]);

        Product::create($validated);

        return redirect()->route('products.index')
            ->with('success', 'Product added to inventory successfully!');
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $categories = ['Lumber', 'Hardware', 'Tools', 'Electrical', 'Plumbing', 'Paint'];
        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name'          => 'required|string|max:255',
            'sku'           => 'required|string|max:50|unique:products,sku,' . $product->id,
            'description'   => 'nullable|string',
            'category'      => 'required|string|max:100',
            'quantity'      => 'required|integer|min:0',
            'reorder_level' => 'required|integer|min:0',
            'unit_price'    => 'required|numeric|min:0',
            'supplier'      => 'nullable|string|max:255',
        ], [
            'sku.unique'     => 'Another product is already using this SKU.',
            'quantity.min'   => 'Quantity cannot be negative.',
            'unit_price.min' => 'Unit price must be 0 or higher.',
        ]);

        $product->update($validated);

        return redirect()->route('products.index')
            ->with('success', 'Product updated successfully!');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Product deleted from inventory.');
    }
}