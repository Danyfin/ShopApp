<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Панель администратора - Пользователи</title>
</head>
<body>
    <x-app-layout>
        <div class="container mx-auto px-4 py-8">
            <h1 class="text-3xl font-bold mb-8">Панель администратора</h1>
            
            <!-- Admin Navigation -->
            <div class="mb-6">
                <nav class="flex space-x-4">
                    <a href="{{ route('admin.index') }}" 
                       class="bg-blue-500 text-white px-4 py-2 rounded">Пользователи</a>
                    <a href="{{ route('admin.orders') }}" 
                       class="bg-gray-200 text-gray-700 px-4 py-2 rounded hover:bg-gray-300">Заказы</a>
                </nav>
            </div>
            
            <!-- Users Table -->
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Пользователь
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Email
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Роль
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Заказов
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Действия
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($users as $user)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $user->name }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-500">{{ $user->email }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <form action="{{ route('admin.users.role', $user) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <select name="role" onchange="this.form.submit()" 
                                                class="text-sm border rounded px-2 py-1 
                                                       {{ $user->role == 'admin' ? 'bg-yellow-100 text-yellow-800' : 'bg-blue-100 text-blue-800' }}">
                                            <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                                            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                        </select>
                                    </form>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-500">{{ $user->orders_count }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    @if($user->id !== auth()->id())
                                        <form action="{{ route('admin.users.delete', $user) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="text-red-600 hover:text-red-900"
                                                    onclick="return confirm('Удалить пользователя {{ $user->name }}?')">
                                                Удалить
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-gray-400">Текущий пользователь</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <div class="mt-4">
                {{ $users->links() }}
            </div>
        </div>
    </x-app-layout>
</body>
</html>