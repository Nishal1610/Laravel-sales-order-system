<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\SalesOrder;
use Illuminate\Http\Request;

class SalesOrderApiController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'products' => 'required|array',
            'products.*.product_id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
        ]);

        $total = 0;
        $items = [];

        foreach ($validated['products'] as $productData) {
            $product = Product::findOrFail($productData['product_id']);

            if ($product->quantity < $productData['quantity']) {
                return response()->json([
                    'error' => "Not enough stock for product: {$product->name}"
                ], 422);
            }

            $subtotal = $product->price * $productData['quantity'];
            $total += $subtotal;

            $items[] = [
                'product_id' => $product->id,
                'quantity' => $productData['quantity'],
                'price' => $product->price,
            ];
        }

        $order = SalesOrder::create([
            'order_number' => 'SO-' . time(),
            'total_amount' => $total,
            'status' => 'confirmed',
        ]);

        foreach ($items as $item) {
            $order->items()->create($item);
            Product::find($item['product_id'])->decrement('quantity', $item['quantity']);
        }

        return response()->json([
            'message' => 'Sales order created',
            'order_id' => $order->id,
        ]);
    }

    public function show($id)
    {
        $order = SalesOrder::with('items.product')->findOrFail($id);

        return response()->json([
            'order_number' => $order->order_number,
            'status' => $order->status,
            'total_amount' => $order->total_amount,
            'items' => $order->items->map(function ($item) {
                return [
                    'product' => $item->product->name,
                    'quantity' => $item->quantity,
                    'price' => $item->price,
                    'subtotal' => $item->quantity * $item->price,
                ];
            }),
        ]);
    }
}

