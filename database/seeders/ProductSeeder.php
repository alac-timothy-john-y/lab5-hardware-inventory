<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            // Lumber
            ['name' => '2x4x8 Kiln-Dried Pine Stud', 'sku' => 'LUM-1001', 'description' => 'Framing grade pine lumber 2x4x8ft', 'category' => 'Lumber', 'quantity' => 120, 'reorder_level' => 30, 'unit_price' => 6.50, 'supplier' => 'Pacific Timber Supply'],
            ['name' => '3/4" Marine Plywood Sheet (4x8)', 'sku' => 'LUM-1002', 'description' => 'Water-resistant structural plywood', 'category' => 'Lumber', 'quantity' => 8, 'reorder_level' => 15, 'unit_price' => 48.00, 'supplier' => 'Pacific Timber Supply'],
            ['name' => '2x6x10 Treated Deck Board', 'sku' => 'LUM-1003', 'description' => 'Pressure-treated outdoor decking lumber', 'category' => 'Lumber', 'quantity' => 0, 'reorder_level' => 20, 'unit_price' => 14.25, 'supplier' => 'Pacific Timber Supply'],

            // Hardware
            ['name' => '3" Galvanized Framing Nails (5lb Box)', 'sku' => 'HDW-2001', 'description' => 'Hot-dipped galvanized steel nails', 'category' => 'Hardware', 'quantity' => 45, 'reorder_level' => 15, 'unit_price' => 18.50, 'supplier' => 'Apex Fasteners Co.'],
            ['name' => 'Heavy Duty Stainless Door Hinges (Pair)', 'sku' => 'HDW-2002', 'description' => '4-inch ball-bearing hinges with screws', 'category' => 'Hardware', 'quantity' => 6, 'reorder_level' => 10, 'unit_price' => 12.00, 'supplier' => 'Apex Fasteners Co.'],
            ['name' => '1/2" Concrete Wedge Anchors (25-Pack)', 'sku' => 'HDW-2003', 'description' => 'Zinc-plated masonry anchor bolts', 'category' => 'Hardware', 'quantity' => 32, 'reorder_level' => 10, 'unit_price' => 24.75, 'supplier' => 'Apex Fasteners Co.'],

            // Tools
            ['name' => '16oz Rip Claw Fiberglass Hammer', 'sku' => 'TLS-3001', 'description' => 'Shock-absorbing grip steel claw hammer', 'category' => 'Tools', 'quantity' => 22, 'reorder_level' => 8, 'unit_price' => 19.99, 'supplier' => 'ProBuild Tools Inc.'],
            ['name' => '18V Cordless Brushless Drill Kit', 'sku' => 'TLS-3002', 'description' => 'Includes 2 lithium batteries and charger', 'category' => 'Tools', 'quantity' => 4, 'reorder_level' => 6, 'unit_price' => 149.00, 'supplier' => 'ProBuild Tools Inc.'],
            ['name' => '25ft Magnetic Tape Measure', 'sku' => 'TLS-3003', 'description' => 'Impact-resistant rubberized casing', 'category' => 'Tools', 'quantity' => 35, 'reorder_level' => 12, 'unit_price' => 14.50, 'supplier' => 'ProBuild Tools Inc.'],

            // Electrical
            ['name' => '12/2 Romex NM-B Copper Wire (250ft)', 'sku' => 'ELC-4001', 'description' => 'Solid copper residential electrical cable', 'category' => 'Electrical', 'quantity' => 14, 'reorder_level' => 5, 'unit_price' => 115.00, 'supplier' => 'VoltMaster Wholesale'],
            ['name' => '20A Single-Pole Circuit Breaker', 'sku' => 'ELC-4002', 'description' => 'Standard thermal-magnetic panel breaker', 'category' => 'Electrical', 'quantity' => 5, 'reorder_level' => 10, 'unit_price' => 9.75, 'supplier' => 'VoltMaster Wholesale'],

            // Plumbing
            ['name' => '1/2" Schedule 40 PVC Pipe (10ft)', 'sku' => 'PLM-5001', 'description' => 'White rigid PVC pressure pipe', 'category' => 'Plumbing', 'quantity' => 65, 'reorder_level' => 20, 'unit_price' => 4.25, 'supplier' => 'AquaFlow Distributors'],
            ['name' => '3/4" Brass Ball Shut-Off Valve', 'sku' => 'PLM-5002', 'description' => 'Lead-free forged brass full-port valve', 'category' => 'Plumbing', 'quantity' => 0, 'reorder_level' => 8, 'unit_price' => 16.40, 'supplier' => 'AquaFlow Distributors'],

            // Paint
            ['name' => 'Interior Matte Latex Paint - White (1 Gal)', 'sku' => 'PNT-6001', 'description' => 'Low-VOC washable interior wall paint', 'category' => 'Paint', 'quantity' => 28, 'reorder_level' => 10, 'unit_price' => 34.00, 'supplier' => 'ColorGuard Coatings'],
            ['name' => '9" Microfiber Paint Roller Kit', 'sku' => 'PNT-6002', 'description' => 'Includes roller frame, tray, and 2 covers', 'category' => 'Paint', 'quantity' => 7, 'reorder_level' => 12, 'unit_price' => 15.80, 'supplier' => 'ColorGuard Coatings'],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}