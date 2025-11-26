<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Корзина</title>
</head>
<body>
    <x-app-layout>
        <div class="container mx-auto px-4 py-8">
            <h1 class="text-3xl font-bold mb-8">Корзина покупок</h1>
            
            @if($cartItems->isEmpty())
                <div class="text-center py-12">
                    <p class="text-xl text-gray-600 mb-4">Ваша корзина пуста</p>
                    <a href="{{ route('products.index') }}" 
                       class="bg-blue-500 text-white px-6 py-3 rounded-lg hover:bg-blue-600">
                        Перейти к покупкам
                    </a>
                </div>
            @else
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Cart Items -->
                    <div class="lg:col-span-2">
                        @foreach($cartItems as $item)
                            <div class="border rounded-lg p-4 mb-4 flex items-center">
                                @if($item->product->image_url)
                                    <img src="{{ $item->product->image_url }}" 
                                         alt="{{ $item->product->name }}"
                                         class="w-20 h-20 object-cover rounded mr-4">
                                @endif
                                
                                <div class="flex-1">
                                    <h3 class="font-semibold">{{ $item->product->name }}</h3>
                                    <p class="text-gray-600">{{ $item->product->price }} руб. × {{ $item->quantity }} шт.</p>
                                    <p class="font-semibold">{{ $item->product->price * $item->quantity }} руб.</p>
                                </div>
                                
                                <div class="flex items-center gap-4">
                                    <!-- Update Quantity Form -->
                                    <form action="{{ route('cart.update', $item) }}" method="POST" class="flex items-center">
                                        @csrf
                                        @method('PUT')
                                        <input type="number" name="quantity" value="{{ $item->quantity }}" 
                                               min="1" max="{{ $item->product->quantity }}"
                                               class="border rounded px-2 py-1 w-16 text-center">
                                        <button type="submit" class="ml-2 text-blue-500 hover:text-blue-700">
                                            Обновить
                                        </button>
                                    </form>
                                    
                                    <!-- Remove Item Form -->
                                    <form action="{{ route('cart.remove', $item) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="text-red-500 hover:text-red-700 ml-4"
                                                onclick="return confirm('Удалить товар из корзины?')">
                                            Удалить
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    
                    <!-- Order Summary -->
                    <div class="border rounded-lg p-6 h-fit">
                        <h2 class="text-xl font-semibold mb-4">Итог заказа</h2>
                        
                        <div class="space-y-2 mb-4">
                            <div class="flex justify-between">
                                <span>Товары:</span>
                                <span>{{ $total }} руб.</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Доставка:</span>
                                <span>~300 руб.</span>
                            </div>
                            <div class="border-t pt-2 font-semibold text-lg">
                                <div class="flex justify-between">
                                    <span>Итого:</span>
                                    <span>{{ $total + 300 }} руб.</span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Promo Code -->
                        <div class="mb-4">
                            <label for="promo_code" class="block text-sm font-medium mb-2">Промокод</label>
                            <input type="text" id="promo_code" placeholder="Введите промокод"
                                   class="border rounded px-3 py-2 w-full">
                        </div>
                        
                        <!-- Checkout Button -->
                        <a href="{{ route('checkout.create') }}" 
                           class="bg-green-500 text-white w-full text-center py-3 rounded-lg hover:bg-green-600 font-semibold block">
                            Оформить заказ
                        </a>
                        
                        <!-- Continue Shopping -->
                        <a href="{{ route('products.index') }}" 
                           class="text-blue-500 hover:text-blue-700 text-center block mt-4">
                            Продолжить покупки
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </x-app-layout>
</body>
</html>