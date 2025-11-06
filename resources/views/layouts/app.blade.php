<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', '宥青國際 ERP 系統') }} - @yield('title', '配方單管理')</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/logo.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Noto+Sans+TC:wght@300;400;500;700&display=swap" rel="stylesheet">

    <!-- TailwindPlus Elements (for interactive components: select, modal) -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindplus/elements@1" type="module"></script>

    <!-- Vite CSS & JS (includes Alpine.js) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')
</head>
<body class="min-h-screen bg-gray-50 font-sans antialiased">
    <!-- 全域導航列 (navbar) -->
    @if(View::exists('components.navbar'))
        @php
        $currentUser = [
            'name' => '研發人員',
            'email' => 'wang@example.com',
            // 'avatar' => '/images/avatar.jpg', // 如果有頭像圖片可以取消註解
        ];
        @endphp
        <x-navbar :currentUser="$currentUser" />
    @endif

    <!-- 主要內容區 -->
    <main>
        @yield('content')
    </main>

    <!-- Scripts -->
    @stack('scripts')
</body>
</html>
