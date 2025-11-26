@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Редактировать товар</h1>
    <form action="{{ route('products.update', $product) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="name">Название:</label>
            <input type="text" name="name" id="name" value="{{ $product->name }}" required>
        </div>
        <div>
            <label for="description">Описание:</label>
            <textarea name="description" id="description" required>{{ $product->description }}</textarea>
        </div>
        <div>
            <label for="price">Цена:</label>
            <input type="number" name="price" id="price" step="0.01" value="{{ $product->price }}" required>
        </div>
        <div>
            <label for="quantity">Количество:</label>
            <input type="number" name="quantity" id="quantity" value="{{ $product->quantity }}" required>
        </div>
        <div>
            <label for="image_url">URL изображения:</label>
            <input type="text" name="image_url" id="image_url" value="{{ $product->image_url }}">
        </div>
        <button type="submit">Обновить товар</button>
    </form>
</div>
@endsection