<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'sku',
        'description',
        'category',
        'quantity',
        'reorder_level',
        'unit_price',
        'supplier',
    ];

    public function getTotalValueAttribute(): float
    {
        return (float) $this->quantity * (float)$this->unit_price;
    }

    public function getStockStatusAttribute(): string
    {
        if ($this->quantity <= 0) {
            return 'Out of Stock';
        }
        if ($this->quantity <=$this->reorder_level) {
            return 'Low Stock';
        }
        return 'In Stock';
    }

    public function isLowStock(): bool
    {
        return $this->quantity <=$this->reorder_level;
    }
}