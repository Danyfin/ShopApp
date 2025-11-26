<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Оформление заказа</title>
</head>
<body>
    <x-app-layout>
        <div class="container mx-auto px-4 py-8">
            <h1 class="text-3xl font-bold mb-8">Оформление заказа</h1>
            
            <form action="{{ route('orders.store') }}" method="POST">
                @csrf
                
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Customer Information -->
                    <div>
                        <h2 class="text-xl font-semibold mb-4">Данные покупателя</h2>
                        
                        <div class="space-y-4">
                            <div>
                                <label for="customer_name" class="block text-sm font-medium mb-2">ФИО *</label>
                                <input type="text" name="customer_name" id="customer_name" 
                                       value="{{ old('customer_name', auth()->user()->name) }}"
                                       class="border rounded px-3 py-2 w-full" required>
                                @error('customer_name')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="address" class="block text-sm font-medium mb-2">Адрес доставки *</label>
                                <textarea name="address" id="address" rows="3"
                                          class="border rounded px-3 py-2 w-full" required>{{ old('address') }}</textarea>
                                @error('address')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="payment_method" class="block text-sm font-medium mb-2">Способ оплаты *</label>
                                <select name="payment_method" id="payment_method" 
                                        class="border rounded px-3 py-2 w-full" required>
                                    <option value="">Выберите способ оплаты</option>
                                    <option value="МИР" {{ old('payment_method') == 'МИР' ? 'selected' : '' }}>МИР</option>
                                    <option value="VISA" {{ old('payment_method') == 'VISA' ? 'selected' : '' }}>VISA</option>
                                    <option value="MASTERCARD" {{ old('payment_method') == 'MASTERCARD' ? 'selected' : '' }}>MASTERCARD</option>
                                </select>
                                @error('payment_method')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="delivery_method" class="block text-sm font-medium mb-2">Способ доставки *</label>
                                <select name="delivery_method" id="delivery_method" 
                                        class="border rounded px-3 py-2 w-full" required>
                                    <option value="">Выберите способ доставки</option>
                                    <option value="courier" {{ old('delivery_method') == 'courier' ? 'selected' : '' }}>Курьерская доставка (+300 руб.)</option>
                                    <option value="pickup" {{ old('delivery_method') == 'pickup' ? 'selected' : '' }}>Самовывоз (бесплатно)</option>
                                </select>
                                @error('delivery_method')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="promo_code" class="block text-sm font-medium mb-2">Промокод</label>
                                <input type="text" name="promo_code" id="promo_code" 
                                       value="{{ old('promo_code') }}"
                                       class="border rounded px-3 py-2 w-full">
                            </div>
                        </div>
                    </div>
                    
                    <!-- Order Summary -->
                    <div>
                        <h2 class="text-xl font-semibold mb-4">Ваш заказ</h2>
                        
                        <div class="border rounded-lg p-6">
                            @foreach($cartItems as $item)
                                <div class="flex justify-between items-center mb-3 pb-3 border-b">
                                    <div>
                                        <p class="font-semibold">{{ $item->product->name }}</p>
                                        <p class="text-sm text-gray-600">{{ $item->quantity }} × {{ $item->product->price }} руб.</p>
                                    </div>
                                    <span class="font-semibold">{{ $item->product->price * $item->quantity }} руб.</span>
                                </div>
                            @endforeach
                            
                            <div class="space-y-2 mt-4">
                                <div class="flex justify-between">
                                    <span>Подытог:</span>
                                    <span>{{ $total }} руб.</span>
                                </div>
                                <div class="flex justify-between">
                                    <span>Доставка:</span>
                                    <span id="delivery-cost">{{ $deliveryCost }} руб.</span>
                                </div>
                                <div class="border-t pt-2 font-semibold text-lg">
                                    <div class="flex justify-between">
                                        <span>Итого:</span>
                                        <span id="total-amount">{{ $total + $deliveryCost }} руб.</span>
                                    </div>
                                </div>
                            </div>
                            
                            <button type="submit" 
                                    class="bg-green-500 text-white w-full py-3 rounded-lg hover:bg-green-600 font-semibold mt-6">
                                Подтвердить заказ
                            </button>
                            
                            <a href="{{ route('cart.index') }}" 
                               class="text-blue-500 hover:text-blue-700 text-center block mt-4">
                                Вернуться в корзину
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <script>
            // Update delivery cost and total when delivery method changes
            document.getElementById('delivery_method').addEventListener('change', function() {
                const deliveryCost = this.value === 'courier' ? 300 : 0;
                const subtotal = {{ $total }};
                const total = subtotal + deliveryCost;
                
                document.getElementById('delivery-cost').textContent = deliveryCost + ' руб.';
                document.getElementById('total-amount').textContent = total + ' руб.';
            });
        </script>
    </x-app-layout>
</body>
</html>