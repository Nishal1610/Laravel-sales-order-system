<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class SalesOrder extends Model
{
    protected $fillable = ['order_number', 'product_id', 'total_amount', 'quantity', 'status'];

    public function items()
    {
        return $this->hasMany(SalesOrderItem::class);
    }

    protected static function booted()
    {
        static::updated(function ($order) {
            if ($order->status === 'confirmed' && $order->getOriginal('status') !== 'confirmed') {
                $product = Product::find($order->product_id);
                if ($product && $product->quantity >= $order->quantity) {
                    $product->decrement('quantity', $order->quantity);
                }
            }
        });
    }

}

