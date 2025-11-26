<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::withCount('orders')->paginate(10);
        return view('admin.index', compact('users'));
    }

    public function orders()
    {
        $orders = Order::with(['user', 'orderItems.product'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);
            
        return view('admin.orders', compact('orders'));
    }

    public function updateOrderStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:Новая,В работе,Отменена'
        ]);

        $order->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Статус заказа обновлен');
    }

    public function deleteUser(User $user)
    {
        if ($user->id === auth()->id()) {
            return redirect()->back()->with('error', 'Нельзя удалить самого себя');
        }

        $user->delete();

        return redirect()->back()->with('success', 'Пользователь удален');
    }

    public function updateUserRole(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|in:user,admin'
        ]);

        $user->update(['role' => $request->role]);

        return redirect()->back()->with('success', 'Роль пользователя обновлена');
    }
}