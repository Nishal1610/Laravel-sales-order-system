<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SalesOrder;
use App\Models\Product;
use Barryvdh\DomPDF\Facade\Pdf;

class SalesOrderController extends Controller
{
    public function index()
    {
        $orders = SalesOrder::with('items.product')->latest()->paginate(10); // or ->get() if not paginating
        return view('sales_orders.index', compact('orders'));
    }

    public function create()
    {
        $products = Product::all();
        return view('sales_orders.create', compact('products'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'products' => 'required|array',
            'products.*.quantity' => 'required|integer|min:1',
        ]);

        $total = 0;
        $items = [];

        foreach ($request->products as $productInput) {
            $product = Product::findOrFail($productInput['product_id']);

            if ($product->quantity < $productInput['quantity']) {
                return back()->with('error', "Not enough stock for {$product->name}.");
            }

            $subtotal = $product->price * $productInput['quantity'];
            $total += $subtotal;

            $items[] = [
                'product_id' => $product->id,
                'quantity' => $productInput['quantity'],
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

            // Reduce stock
            Product::find($item['product_id'])->decrement('quantity', $item['quantity']);
        }

        return redirect()->route('sales_orders.index', $order)->with('success', 'Order created and stock reduced.');
    }

    public function exportPdf(SalesOrder $order)
    {
        $order->load('items.product');

        $pdf = Pdf::loadView('sales_orders.pdf', compact('order'));
        return $pdf->download("SalesOrder_{$order->order_number}.pdf");
    }
}
