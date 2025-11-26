@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Добавить товар</h1>
    <form action="{{ route('products.store') }}" method="POST">
        @csrf
        <div>
            <label for="name">Название:</label>
            <input type="text" name="name" id="name" required>
        </div>
        <div>
            <label for="description">Описание:</label>
            <textarea name="description" id="description" required></textarea>
        </div>
        <div>
            <label for="price">Цена:</label>
            <input type="number" name="price" id="price" step="0.01" required>
        </div>
        <div>
            <label for="quantity">Количество:</label>
            <input type="number" name="quantity" id="quantity" required>
        </div>
        <div>
            <label for="image_url">URL изображения:</label>
            <input type="text" name="image_url" id="image_url">
        </div>
        <button type="submit">Создать товар</button>
    </form>
</div>
@endsection