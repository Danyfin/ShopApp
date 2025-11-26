<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>{{ $product->name }}</title>
</head>
<body>
    <x-app-layout>
        <div class="container mx-auto px-4 py-8">
            <a href="{{ route('products.index') }}" class="text-blue-500 hover:text-blue-700 mb-4 inline-block">
                ← Назад к каталогу
            </a>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Product Image -->
                <div>
                    @if($product->image_url)
                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" 
                             class="w-full rounded-lg shadow-md">
                    @else
                        <div class="w-full h-64 bg-gray-200 rounded-lg flex items-center justify-center">
                            <span class="text-gray-400">Нет изображения</span>
                        </div>
                    @endif
                </div>
                
                <!-- Product Info -->
                <div>
                    <h1 class="text-3xl font-bold mb-4">{{ $product->name }}</h1>
                    <p class="text-gray-600 mb-2">Категория: {{ $product->category->name }}</p>
                    <p class="text-2xl font-bold text-green-600 mb-4">{{ $product->price }} руб.</p>
                    
                    <div class="mb-6">
                        <h2 class="text-xl font-semibold mb-2">Описание</h2>
                        <p class="text-gray-700">{{ $product->description }}</p>
                    </div>
                    
                    <!-- Add to Cart Form -->
                    @auth
                        <form action="{{ route('cart.add', $product) }}" method="POST" class="mb-4">
                            @csrf
                            <div class="flex items-center gap-4 mb-4">
                                <label for="quantity" class="font-semibold">Количество:</label>
                                <input type="number" name="quantity" id="quantity" 
                                       value="1" min="1" max="{{ $product->quantity }}"
                                       class="border rounded px-3 py-2 w-20">
                                <span class="text-gray-600">Доступно: {{ $product->quantity }} шт.</span>
                            </div>
                            
                            <button type="submit" 
                                    class="bg-blue-500 text-white px-6 py-3 rounded-lg hover:bg-blue-600 font-semibold">
                                Добавить в корзину
                            </button>
                        </form>
                    @else
                        <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded">
                            <a href="{{ route('login') }}" class="text-blue-500 hover:text-blue-700">
                                Войдите
                            </a>, чтобы добавить товар в корзину
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </x-app-layout>
</body>
</html>