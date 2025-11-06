# Navigation Components (導航相關元件)

**文件說明**: 本文件包含所有導航相關的 Blade 元件規格
**元件數量**: 3 個
**最後更新**: 2025-11-06

---

## 元件清單

1. [navbar](#1-navbar) - 全域導航列
2. [page-header](#2-page-header) - 頁面標題列
3. [breadcrumb](#3-breadcrumb) - 麵包屑導航

---

## 1. navbar (全域導航列)

**檔案位置**: `resources/views/components/navbar.blade.php`

**說明**: 基於 Tailwind UI - Application UI > Navigation > Navbars 設計

**Props**:
```php
@props([
    'logoUrl' => '/',           // Logo 連結
    'logoImage' => '',          // Logo 圖片路徑
    'companyName' => '宥青 ERP 系統', // 公司/系統名稱
    'currentUser' => null,      // 當前使用者資訊 ['name' => '', 'avatar' => '']
])
```

**完整程式碼**:
```blade
@props([
    'logoUrl' => '/',
    'logoImage' => '/images/logo.svg',
    'companyName' => '宥青 ERP 系統',
    'currentUser' => null,
])

{{-- 需要引入 @tailwindplus/elements 來支援行動版選單 --}}
{{-- <script src="https://cdn.jsdelivr.net/npm/@tailwindplus/elements@1" type="module"></script> --}}

<header class="bg-white border-b border-gray-200">
    <nav aria-label="全域導航" class="mx-auto flex max-w-7xl items-center justify-between p-6 lg:px-8">
        {{-- Logo 區域 --}}
        <div class="flex lg:flex-1">
            <a href="{{ $logoUrl }}" class="-m-1.5 p-1.5">
                <span class="sr-only">{{ $companyName }}</span>
                <img src="{{ $logoImage }}" alt="{{ $companyName }}" class="h-8 w-auto" />
            </a>
        </div>

        {{-- 行動版選單按鈕 --}}
        <div class="flex lg:hidden">
            <button type="button" command="show-modal" commandfor="mobile-menu" class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700">
                <span class="sr-only">開啟主選單</span>
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" data-slot="icon" aria-hidden="true" class="size-6">
                    <path d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </button>
        </div>

        {{-- 桌面版主選單 --}}
        <div class="hidden lg:flex lg:gap-x-12">
            <a href="/" class="text-sm/6 font-semibold text-gray-900 hover:text-indigo-600">首頁</a>
            <a href="/recipes" class="text-sm/6 font-semibold text-gray-900 hover:text-indigo-600">研發模組</a>
            <a href="/production" class="text-sm/6 font-semibold text-gray-900 hover:text-indigo-600">生產模組</a>
            <a href="/settings" class="text-sm/6 font-semibold text-gray-900 hover:text-indigo-600">系統設定</a>
        </div>

        {{-- 使用者資訊區域 --}}
        <div class="hidden lg:flex lg:flex-1 lg:justify-end lg:items-center lg:gap-x-4">
            @if($currentUser)
                <div class="flex items-center gap-x-3">
                    @if(isset($currentUser['avatar']))
                        <img src="{{ $currentUser['avatar'] }}" alt="{{ $currentUser['name'] }}" class="h-8 w-8 rounded-full" />
                    @endif
                    <span class="text-sm font-medium text-gray-900">{{ $currentUser['name'] }}</span>
                    <a href="/logout" class="text-sm/6 font-semibold text-gray-600 hover:text-gray-900">登出</a>
                </div>
            @else
                <a href="/login" class="text-sm/6 font-semibold text-gray-900">
                    登入 <span aria-hidden="true">&rarr;</span>
                </a>
            @endif
        </div>
    </nav>

    {{-- 行動版選單對話框 --}}
    <el-dialog>
        <dialog id="mobile-menu" class="backdrop:bg-transparent lg:hidden">
            <div tabindex="0" class="fixed inset-0 focus:outline-none">
                <el-dialog-panel class="fixed inset-y-0 right-0 z-50 w-full overflow-y-auto bg-white p-6 sm:max-w-sm sm:ring-1 sm:ring-gray-900/10">
                    <div class="flex items-center justify-between">
                        <a href="{{ $logoUrl }}" class="-m-1.5 p-1.5">
                            <span class="sr-only">{{ $companyName }}</span>
                            <img src="{{ $logoImage }}" alt="{{ $companyName }}" class="h-8 w-auto" />
                        </a>
                        <button type="button" command="close" commandfor="mobile-menu" class="-m-2.5 rounded-md p-2.5 text-gray-700">
                            <span class="sr-only">關閉選單</span>
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" data-slot="icon" aria-hidden="true" class="size-6">
                                <path d="M6 18 18 6M6 6l12 12" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </button>
                    </div>
                    <div class="mt-6 flow-root">
                        <div class="-my-6 divide-y divide-gray-500/10">
                            <div class="space-y-2 py-6">
                                <a href="/" class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-gray-900 hover:bg-gray-50">首頁</a>
                                <a href="/recipes" class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-gray-900 hover:bg-gray-50">研發模組</a>
                                <a href="/production" class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-gray-900 hover:bg-gray-50">生產模組</a>
                                <a href="/settings" class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-gray-900 hover:bg-gray-50">系統設定</a>
                            </div>
                            @if($currentUser)
                                <div class="py-6">
                                    <div class="flex items-center gap-x-3 px-3 mb-3">
                                        @if(isset($currentUser['avatar']))
                                            <img src="{{ $currentUser['avatar'] }}" alt="{{ $currentUser['name'] }}" class="h-10 w-10 rounded-full" />
                                        @endif
                                        <span class="text-base font-semibold text-gray-900">{{ $currentUser['name'] }}</span>
                                    </div>
                                    <a href="/logout" class="-mx-3 block rounded-lg px-3 py-2.5 text-base/7 font-semibold text-gray-900 hover:bg-gray-50">登出</a>
                                </div>
                            @else
                                <div class="py-6">
                                    <a href="/login" class="-mx-3 block rounded-lg px-3 py-2.5 text-base/7 font-semibold text-gray-900 hover:bg-gray-50">登入</a>
                                </div>
                            @endif
                        </div>
                    </div>
                </el-dialog-panel>
            </div>
        </dialog>
    </el-dialog>
</header>
```

**使用範例**:
```blade
{{-- 基本使用 (未登入) --}}
<x-navbar
    logoImage="/images/logo.svg"
    companyName="美味食品管理系統"
/>

{{-- 已登入使用者 --}}
<x-navbar
    logoImage="/images/logo.svg"
    companyName="美味食品管理系統"
    :currentUser="[
        'name' => '張研發',
        'avatar' => '/images/avatars/user.jpg'
    ]"
/>

{{-- 在主要佈局檔案中使用 --}}
<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <title>配方管理系統</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50">
    {{-- 全域導航列 --}}
    <x-navbar
        :currentUser="auth()->user() ? ['name' => auth()->user()->name] : null"
    />

    {{-- 主要內容區域 --}}
    <main>
        @yield('content')
    </main>
</body>
</html>
```

**設計說明**:
- **來源**: Tailwind UI - Application UI > Navigation > Navbars
- **響應式設計**: 桌面版顯示完整選單,行動版使用側邊抽屜
- **主選單項目**: 首頁、研發模組、生產模組、系統設定
- **使用者狀態**: 支援已登入/未登入兩種狀態
- **行動版選單**: 使用 `@tailwindplus/elements` 的 dialog 元件實現
- **固定在頂部**: 作為全站共用的導航列

**技術需求**:
```html
<!-- 需要在 layout 主檔案的 <head> 中引入 -->
<script src="https://cdn.jsdelivr.net/npm/@tailwindplus/elements@1" type="module"></script>
```

---

## 2. page-header (頁面標題列)

**檔案位置**: `resources/views/recipes/components/page-header.blade.php`

**說明**: 用於每個頁面的標題區域,顯示在全域導航列下方

**Props**:
```php
@props([
    'title' => '',           // 頁面標題
    'subtitle' => '',        // 副標題 (選填)
    'module' => '研發模組',   // 模組名稱
    'section' => '配方單管理', // 區塊名稱
])
```

**完整程式碼**:
```blade
@props([
    'title' => '',
    'subtitle' => '',
    'module' => '研發模組',
    'section' => '配方單管理',
])

<div class="bg-white border-b border-gray-200">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="py-6 md:flex md:items-center md:justify-between">
            <div class="flex-1 min-w-0">
                {{-- 模組路徑標籤 --}}
                <div class="flex items-center mb-2">
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-xs font-medium bg-indigo-100 text-indigo-800">
                        {{ $module }}
                    </span>
                    <svg class="w-4 h-4 mx-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                    <span class="text-sm text-gray-600 font-medium">{{ $section }}</span>
                </div>

                {{-- 頁面標題 --}}
                <h1 class="text-2xl font-bold text-gray-900 sm:text-3xl sm:truncate">
                    {{ $title }}
                </h1>

                {{-- 副標題 (選填) --}}
                @if($subtitle)
                    <p class="mt-2 text-sm text-gray-600">
                        {{ $subtitle }}
                    </p>
                @endif
            </div>

            {{-- 操作按鈕區域 (使用 slot) --}}
            @isset($actions)
                <div class="mt-4 flex flex-col gap-2 md:mt-0 md:ml-4 md:flex-row">
                    {{ $actions }}
                </div>
            @endisset
        </div>
    </div>
</div>
```

**使用範例**:
```blade
{{-- 配方列表頁面 --}}
<x-recipes.page-header
    title="配方列表"
    subtitle="管理所有產品配方及版本紀錄"
>
    <x-slot name="actions">
        <x-recipes.button variant="primary">
            建立新配方
        </x-recipes.button>
    </x-slot>
</x-recipes.page-header>

{{-- 配方詳情頁面 --}}
<x-recipes.page-header
    title="巧克力布朗尼"
    subtitle="版本 v3 · 待審核 · 建立於 2025-11-06"
>
    <x-slot name="actions">
        <x-recipes.button variant="secondary">查看版本歷史</x-recipes.button>
        <x-recipes.button variant="primary">編製新版本</x-recipes.button>
    </x-slot>
</x-recipes.page-header>

{{-- 簡單標題 --}}
<x-recipes.page-header title="版本歷史" />
```

**設計說明**:
- **模組標識**: 顯示「研發模組 > 配方單管理」路徑
- **響應式佈局**: 行動版時按鈕垂直排列,桌面版水平排列
- **彈性操作區**: 透過 `actions` slot 自訂操作按鈕
- **位置**: 放在全域導航列下方,內容區域上方

---

## 3. breadcrumb (麵包屑導航)

**檔案位置**: `resources/views/recipes/components/breadcrumb.blade.php`

**說明**: 基於 Tailwind UI - Application UI > Navigation > Breadcrumbs 設計

**Props**:
```php
@props([
    'items' => [],  // [['label' => '首頁', 'url' => '/'], ['label' => '配方管理', 'url' => '/recipes'], ...]
])
```

**完整程式碼**:
```blade
@props([
    'items' => [],
])

<nav aria-label="Breadcrumb" class="flex">
    <ol role="list" class="flex items-center space-x-4">
        @foreach($items as $index => $item)
            <li>
                <div class="flex items-center">
                    @if($index === 0)
                        {{-- 首頁圖示 --}}
                        <a href="{{ $item['url'] }}" class="text-gray-400 hover:text-gray-500">
                            <svg viewBox="0 0 20 20" fill="currentColor" data-slot="icon" aria-hidden="true" class="size-5 shrink-0">
                                <path d="M9.293 2.293a1 1 0 0 1 1.414 0l7 7A1 1 0 0 1 17 11h-1v6a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1v-3a1 1 0 0 0-1-1H9a1 1 0 0 0-1 1v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-6H3a1 1 0 0 1-.707-1.707l7-7Z" clip-rule="evenodd" fill-rule="evenodd" />
                            </svg>
                            <span class="sr-only">{{ $item['label'] }}</span>
                        </a>
                    @else
                        {{-- 箭頭分隔符號 --}}
                        <svg viewBox="0 0 20 20" fill="currentColor" data-slot="icon" aria-hidden="true" class="size-5 shrink-0 text-gray-400">
                            <path d="M8.22 5.22a.75.75 0 0 1 1.06 0l4.25 4.25a.75.75 0 0 1 0 1.06l-4.25 4.25a.75.75 0 0 1-1.06-1.06L11.94 10 8.22 6.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" fill-rule="evenodd" />
                        </svg>

                        @if($loop->last)
                            {{-- 當前頁面 (最後一項) --}}
                            <span aria-current="page" class="ml-4 text-sm font-medium text-gray-500">
                                {{ $item['label'] }}
                            </span>
                        @else
                            {{-- 中間項目 --}}
                            <a href="{{ $item['url'] }}" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">
                                {{ $item['label'] }}
                            </a>
                        @endif
                    @endif
                </div>
            </li>
        @endforeach
    </ol>
</nav>
```

**使用範例**:
```blade
{{-- 1. 配方列表頁面 (2層) --}}
<x-recipes.breadcrumb :items="[
    ['label' => '首頁', 'url' => '/'],
    ['label' => '配方管理', 'url' => '']
]" />

{{-- 2. 配方詳情頁面 (3層) --}}
<x-recipes.breadcrumb :items="[
    ['label' => '首頁', 'url' => '/'],
    ['label' => '配方管理', 'url' => '/recipes'],
    ['label' => '巧克力布朗尼', 'url' => '']
]" />

{{-- 3. 建立配方頁面 --}}
<x-recipes.breadcrumb :items="[
    ['label' => '首頁', 'url' => '/'],
    ['label' => '配方管理', 'url' => '/recipes'],
    ['label' => '建立新配方', 'url' => '']
]" />

{{-- 4. 版本歷史頁面 (4層) --}}
<x-recipes.breadcrumb :items="[
    ['label' => '首頁', 'url' => '/'],
    ['label' => '配方管理', 'url' => '/recipes'],
    ['label' => '巧克力布朗尼', 'url' => '/recipes/1'],
    ['label' => '版本歷史', 'url' => '']
]" />

{{-- 5. 在 page-header 中整合使用 --}}
<x-recipes.breadcrumb :items="[
    ['label' => '首頁', 'url' => '/'],
    ['label' => '配方管理', 'url' => '/recipes'],
    ['label' => request()->route('id'), 'url' => '']
]" />
```

**設計說明**:
- **來源**: Tailwind UI - Application UI > Navigation > Breadcrumbs
- **首頁圖示**: 第一個項目使用 home icon,更直覺
- **箭頭分隔**: 使用右箭頭圖示分隔各層級
- **當前頁面**: 最後一項不可點擊,顯示為灰色
- **懸停效果**: 可點擊項目有 hover 變深色效果
- **無障礙**: 完整的 aria-label 和 role 屬性
- **響應式**: 在小螢幕上自動適應

---

**返回**: [元件總覽](../components.md)
