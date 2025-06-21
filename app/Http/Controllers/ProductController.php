<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index() {
        return view('products.index', ['products' => Product::all()]);
    }

    public function create() {
        return view('products.create');
    }

    public function store(Request $request) {
        Product::create($request->validate([
            'name' => 'required',
            'sku' => 'required|unique:products',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
        ]));

        return redirect()->route('admin.products')->with('success', 'Product added.');
    }

    public function edit(Product $product) {
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product) {
        $product->update($request->validate([
            'name' => 'required',
            'sku' => 'required|unique:products,sku,' . $product->id,
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
        ]));

        return redirect()->route('admin.products')->with('success', 'Product updated.');
    }

    public function destroy(Product $product) {
        $product->delete();
        return redirect()->route('admin.products')->with('success', 'Product deleted.');
    }
}
