<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Каталог товаров</title>
</head>
<body>
    <x-app-layout>
        <div class="container mx-auto px-4 py-8">
            <h1 class="text-3xl font-bold mb-8">Каталог товаров</h1>
            
            <!-- Search and Filter -->
            <div class="mb-6">
                <form action="{{ route('products.index') }}" method="GET" class="flex gap-4">
                    <input type="text" name="search" placeholder="Поиск товаров..." 
                           value="{{ request('search') }}" class="border rounded px-3 py-2 flex-1">
                    <select name="category" class="border rounded px-3 py-2">
                        <option value="">Все категории</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" 
                                    {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded">Найти</button>
                </form>
            </div>

            <!-- Products Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach ($products as $product)
                    <div class="border rounded-lg p-4 shadow-sm">
                        @if($product->image_url)
                            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" 
                                 class="w-full h-48 object-cover mb-4 rounded">
                        @endif
                        <h3 class="font-semibold text-lg mb-2">{{ $product->name }}</h3>
                        <p class="text-gray-600 text-sm mb-2">{{ $product->category->name }}</p>
                        <p class="text-gray-500 text-sm mb-4 line-clamp-2">{{ $product->description }}</p>
                        <div class="flex justify-between items-center">
                            <span class="text-xl font-bold text-green-600">{{ $product->price }} руб.</span>
                            <a href="{{ route('products.show', $product) }}" 
                               class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                                Подробнее
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-8">
                {{ $products->links() }}
            </div>
        </div>
    </x-app-layout>
</body>
</html>