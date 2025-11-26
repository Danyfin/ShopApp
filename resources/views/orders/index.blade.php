<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Мои заказы</title>
</head>
<body>
    <x-app-layout>
        <div class="container mx-auto px-4 py-8">
            <h1 class="text-3xl font-bold mb-8">Мои заказы</h1>
            
            @if($orders->isEmpty())
                <div class="text-center py-12">
                    <p class="text-xl text-gray-600 mb-4">У вас еще нет заказов</p>
                    <a href="{{ route('products.index') }}" 
                       class="bg-blue-500 text-white px-6 py-3 rounded-lg hover:bg-blue-600">
                        Перейти к покупкам
                    </a>
                </div>
            @else
                <div class="space-y-6">
                    @foreach($orders as $order)
                        <div class="border rounded-lg p-6">
                            <div class="flex justify-between items-start mb-4">
                                <div>
                                    <h3 class="text-lg font-semibold">Заказ #{{ $order->id }}</h3>
                                    <p class="text-gray-600">от {{ $order->created_at->format('d.m.Y H:i') }}</p>
                                </div>
                                <div class="text-right">
                                    <span class="inline-block px-3 py-1 rounded-full text-sm font-semibold 
                                        {{ $order->status == 'Новая' ? 'bg-blue-100 text-blue-800' : '' }}
                                        {{ $order->status == 'В работе' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                        {{ $order->status == 'Отменена' ? 'bg-red-100 text-red-800' : '' }}">
                                        {{ $order->status }}
                                    </span>
                                    <p class="text-xl font-bold mt-2">{{ $order->total_amount }} руб.</p>
                                </div>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                <div>
                                    <p><strong>Получатель:</strong> {{ $order->customer_name }}</p>
                                    <p><strong>Адрес:</strong> {{ $order->address }}</p>
                                </div>
                                <div>
                                    <p><strong>Оплата:</strong> {{ $order->payment_method }}</p>
                                    <p><strong>Доставка:</strong> 
                                        {{ $order->delivery_method == 'courier' ? 'Курьерская доставка' : 'Самовывоз' }}
                                    </p>
                                </div>
                            </div>
                            
                            <!-- Order Items -->
                            <div class="border-t pt-4">
                                <h4 class="font-semibold mb-2">Состав заказа:</h4>
                                @foreach($order->orderItems as $item)
                                    <div class="flex justify-between items-center py-2">
                                        <div class="flex items-center">
                                            @if($item->product->image_url)
                                                <img src="{{ $item->product->image_url }}" 
                                                     alt="{{ $item->product->name }}"
                                                     class="w-10 h-10 object-cover rounded mr-3">
                                            @endif
                                            <div>
                                                <p class="font-medium">{{ $item->product->name }}</p>
                                                <p class="text-sm text-gray-600">{{ $item->quantity }} × {{ $item->price }} руб.</p>
                                            </div>
                                        </div>
                                        <span class="font-semibold">{{ $item->quantity * $item->price }} руб.</span>
                                    </div>
                                @endforeach
                            </div>
                            
                            @if($order->promo_code)
                                <div class="border-t pt-4">
                                    <p><strong>Промокод:</strong> {{ $order->promo_code }}</p>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
                
                <!-- Pagination -->
                <div class="mt-8">
                    {{ $orders->links() }}
                </div>
            @endif
        </div>
    </x-app-layout>
</body>
</html>