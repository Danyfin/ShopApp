<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function create()
    {
        $cartItems = CartItem::with('product')
            ->where('user_id', Auth::id())
            ->get();
            
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Корзина пуста');
        }
        
        $total = 0;
        foreach ($cartItems as $item) {
            $total += $item->product->price * $item->quantity;
        }
        
        $deliveryCost = 300; // Пример стоимости доставки
        
        return view('orders.create', compact('cartItems', 'total', 'deliveryCost'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'address' => 'required|string|max:500',
            'payment_method' => 'required|in:МИР,VISA,MASTERCARD',
            'delivery_method' => 'required|in:courier,pickup',
            'promo_code' => 'nullable|string|max:50'
        ]);

        $cartItems = CartItem::with('product')
            ->where('user_id', Auth::id())
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Корзина пуста');
        }

        DB::transaction(function () use ($request, $cartItems) {
            $total = 0;
            foreach ($cartItems as $item) {
                $total += $item->product->price * $item->quantity;
            }
            
            $deliveryCost = $request->delivery_method === 'courier' ? 300 : 0;
            $finalTotal = $total + $deliveryCost;

            $order = Order::create([
                'user_id' => Auth::id(),
                'customer_name' => $request->customer_name,
                'address' => $request->address,
                'payment_method' => $request->payment_method,
                'delivery_method' => $request->delivery_method,
                'status' => 'Новая',
                'total_amount' => $finalTotal,
                'delivery_cost' => $deliveryCost,
                'promo_code' => $request->promo_code
            ]);

            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price
                ]);

                // Update product quantity
                $product = Product::find($item->product_id);
                $product->decrement('quantity', $item->quantity);
            }

            // Clear cart
            CartItem::where('user_id', Auth::id())->delete();
        });

        return redirect()->route('orders.index')->with('success', 'Заказ успешно оформлен');
    }

    public function index()
    {
        $orders = Order::with('orderItems.product')
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('orders.index', compact('orders'));
    }
}