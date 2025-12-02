<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Админ панель' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <div class="w-64 bg-white border-r border-purple-100">
            <div class="p-4 border-b">
                <h1 class="text-lg font-bold text-purple-800">Админ панель</h1>
            </div>
            
            <nav class="p-4 space-y-2">
                <a href="{{ route('dashboard.category') }}" class="flex items-center p-3 rounded-lg hover:bg-purple-50 text-gray-700">
                    📁 Категории
                </a>
                <a href="{{ route('dashboard.country') }}" class="flex items-center p-3 rounded-lg hover:bg-purple-50 text-gray-700">
                    🌍 Страны
                </a>
                <a href="{{ route('dashboard.user') }}" class="flex items-center p-3 rounded-lg hover:bg-purple-50 text-gray-700">
                    👥 Пользователи
                </a>
                <a href="{{ route('dashboard.product') }}" class="flex items-center p-3 rounded-lg hover:bg-purple-50 text-gray-700">
                    📦 Продукты
                </a>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <!-- Header -->
            <header class="bg-white border-b px-6 py-4">
                <div class="flex justify-between items-center">
                    <a href="{{ route('home') }}" class="text-purple-600 hover:text-purple-800">
                        ← На главную
                    </a>
                    <div class="text-sm text-gray-500">
                        {{ date('d.m.Y') }}
                    </div>
                </div>
            </header>

            <!-- Content -->
            <main class="flex-1 p-6">
                {{ $slot }}
            </main>

            <!-- Footer -->
            <footer class="bg-white border-t px-6 py-4 text-center text-gray-500 text-sm">
                &copy; {{ date('Y') }} Админ панель
            </footer>
        </div>
    </div>
</body>
</html>