@props([
    'logoUrl' => '/',
    'logoImage' => '/images/logo.png',
    'companyName' => '宥青國際 ERP 系統',
    'currentUser' => null,
    'currentPage' => 'recipes', // 用於判斷當前頁面
])

<nav class="sticky top-0 bg-white shadow-sm z-50">
    <div class="flex h-16 items-center justify-between px-4 sm:px-6 lg:px-8">
            {{-- 左側：行動版選單按鈕 + Logo 和公司名稱 --}}
            <div class="flex items-center gap-x-2">
                {{-- 行動版選單按鈕（手機版） --}}
                <div class="flex items-center sm:hidden">
                    <button type="button" command="--toggle" commandfor="mobile-menu" class="relative inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-gray-100 hover:text-gray-500 focus:ring-2 focus:ring-indigo-600 focus:outline-hidden focus:ring-inset">
                        <span class="absolute -inset-0.5"></span>
                        <span class="sr-only">開啟主選單</span>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" data-slot="icon" aria-hidden="true" class="size-6 in-aria-expanded:hidden">
                            <path d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" data-slot="icon" aria-hidden="true" class="size-6 not-in-aria-expanded:hidden">
                            <path d="M6 18 18 6M6 6l12 12" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </button>
                </div>

                {{-- Logo 和公司名稱 --}}
                <div class="flex shrink-0 items-center gap-x-2">
                    <img src="{{ $logoImage }}" alt="{{ $companyName }}" class="h-8 w-auto" />
                    <a href="{{ $logoUrl }}" class="text-base font-semibold text-gray-900 truncate">{{ $companyName }}</a>
                </div>
            </div>

            {{-- 中間：導航連結 --}}
            <div class="hidden sm:flex sm:gap-x-6 absolute left-1/2 -translate-x-1/2">
                <a href="/" class="inline-flex items-center border-b-2 {{ $currentPage === 'home' ? 'border-indigo-600 text-gray-900' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' }} px-1 pt-1 text-sm font-medium">首頁</a>

                {{-- 研發模組下拉選單 --}}
                <div class="relative" x-data="{ moduleOpen: false }">
                    <button
                        @click="moduleOpen = !moduleOpen"
                        @click.away="moduleOpen = false"
                        class="inline-flex items-center gap-x-1 border-b-2 {{ $currentPage === 'recipes' ? 'border-indigo-600 text-gray-900' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' }} px-1 pt-1 text-sm font-medium"
                    >
                        研發模組
                        <svg viewBox="0 0 20 20" fill="currentColor" class="size-4">
                            <path fill-rule="evenodd" d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                        </svg>
                    </button>

                    {{-- 下拉選單面板 --}}
                    <div
                        x-show="moduleOpen"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 scale-95 translate-y-1"
                        x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                        x-transition:leave-end="opacity-0 scale-95 translate-y-1"
                        class="absolute left-0 mt-2 w-56 origin-top rounded-lg bg-white shadow-xl ring-1 ring-gray-200 border border-gray-100 z-[100]"
                        style="display: none;"
                    >
                        <div class="py-2">
                            <a href="/recipes" class="block px-4 py-2.5 text-sm font-medium text-gray-900 hover:bg-indigo-50 hover:text-indigo-600 transition-colors duration-150">配方單管理</a>
                            <a href="/rd-inspections" class="block px-4 py-2.5 text-sm font-medium text-gray-900 hover:bg-indigo-50 hover:text-indigo-600 transition-colors duration-150">研發檢驗單</a>
                            <a href="/sample-management" class="block px-4 py-2.5 text-sm font-medium text-gray-900 hover:bg-indigo-50 hover:text-indigo-600 transition-colors duration-150">送樣管理</a>
                            <a href="/cost-calculation" class="block px-4 py-2.5 text-sm font-medium text-gray-900 hover:bg-indigo-50 hover:text-indigo-600 transition-colors duration-150">成本試算</a>
                            <a href="/new-product-confirmation" class="block px-4 py-2.5 text-sm font-medium text-gray-900 hover:bg-indigo-50 hover:text-indigo-600 transition-colors duration-150">新品確認單</a>
                            <a href="/specification-documents" class="block px-4 py-2.5 text-sm font-medium text-gray-900 hover:bg-indigo-50 hover:text-indigo-600 transition-colors duration-150">規格文件管理</a>
                        </div>
                    </div>
                </div>

                <a href="/settings" class="inline-flex items-center border-b-2 {{ $currentPage === 'settings' ? 'border-indigo-600 text-gray-900' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' }} px-1 pt-1 text-sm font-medium">系統設定</a>
            </div>

            {{-- 右側：搜尋、通知和用戶選單 --}}
            <div class="flex items-center gap-x-2 sm:gap-x-4">
                {{-- 搜尋功能（含展開動畫） --}}
                <div class="relative flex items-center" x-data="{ searchOpen: false }">
                    {{-- 桌面版：搜尋輸入框（展開時顯示） --}}
                    <div
                        x-show="searchOpen"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 scale-95 -translate-x-4"
                        x-transition:enter-end="opacity-100 scale-100 translate-x-0"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 scale-100 translate-x-0"
                        x-transition:leave-end="opacity-0 scale-95 -translate-x-4"
                        class="hidden sm:block absolute right-0 mr-10 z-[100]"
                        style="display: none;"
                    >
                        <input
                            type="text"
                            placeholder="搜尋..."
                            x-ref="searchInputDesktop"
                            @click.away="searchOpen = false"
                            @keydown.escape="searchOpen = false"
                            class="block w-64 rounded-md border-0 py-1.5 pr-3 pl-10 text-sm text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600"
                        />
                        <svg viewBox="0 0 20 20" fill="currentColor" data-slot="icon" aria-hidden="true" class="pointer-events-none absolute left-3 top-1/2 -translate-y-1/2 size-4 text-gray-400">
                            <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 1 0 0 11 5.5 5.5 0 0 0 0-11ZM2 9a7 7 0 1 1 12.452 4.391l3.328 3.329a.75.75 0 1 1-1.06 1.06l-3.329-3.328A7 7 0 0 1 2 9Z" clip-rule="evenodd" />
                        </svg>
                    </div>

                    {{-- 手機版：全螢幕搜尋面板 --}}
                    <div
                        x-show="searchOpen"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0"
                        x-transition:enter-end="opacity-100"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100"
                        x-transition:leave-end="opacity-0"
                        class="sm:hidden fixed inset-0 bg-white z-[200]"
                        style="display: none;"
                    >
                        <div class="flex h-16 items-center gap-x-3 px-4 border-b border-gray-200">
                            <button
                                type="button"
                                @click="searchOpen = false"
                                class="text-gray-400 hover:text-gray-500"
                            >
                                <svg class="size-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                </svg>
                            </button>
                            <div class="relative flex-1">
                                <input
                                    type="text"
                                    placeholder="搜尋..."
                                    x-ref="searchInputMobile"
                                    @keydown.escape="searchOpen = false"
                                    class="block w-full rounded-md border-0 py-2 pr-3 pl-10 text-sm text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600"
                                />
                                <svg viewBox="0 0 20 20" fill="currentColor" class="pointer-events-none absolute left-3 top-1/2 -translate-y-1/2 size-5 text-gray-400">
                                    <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 1 0 0 11 5.5 5.5 0 0 0 0-11ZM2 9a7 7 0 1 1 12.452 4.391l3.328 3.329a.75.75 0 1 1-1.06 1.06l-3.329-3.328A7 7 0 0 1 2 9Z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    {{-- 搜尋按鈕 --}}
                    <button
                        type="button"
                        @click="searchOpen = !searchOpen; $nextTick(() => {
                            if (searchOpen) {
                                if (window.innerWidth < 640) {
                                    $refs.searchInputMobile.focus();
                                } else {
                                    $refs.searchInputDesktop.focus();
                                }
                            }
                        })"
                        class="relative rounded-full p-1 text-gray-400 hover:text-gray-500 focus:outline-2 focus:outline-offset-2 focus:outline-indigo-600 transition-colors duration-200"
                        :class="{ 'text-indigo-600': searchOpen }"
                    >
                        <span class="absolute -inset-1.5"></span>
                        <span class="sr-only">搜尋</span>
                        <svg viewBox="0 0 20 20" fill="currentColor" data-slot="icon" aria-hidden="true" class="size-5 sm:size-6">
                            <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 1 0 0 11 5.5 5.5 0 0 0 0-11ZM2 9a7 7 0 1 1 12.452 4.391l3.328 3.329a.75.75 0 1 1-1.06 1.06l-3.329-3.328A7 7 0 0 1 2 9Z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>

                {{-- 通知功能（含展開動畫） --}}
                <div class="relative" x-data="{ notificationOpen: false }">
                    {{-- 通知按鈕 --}}
                    <button
                        type="button"
                        @click="notificationOpen = !notificationOpen"
                        class="relative rounded-full p-1 text-gray-400 hover:text-gray-500 focus:outline-2 focus:outline-offset-2 focus:outline-indigo-600 transition-colors duration-200"
                        :class="{ 'text-indigo-600': notificationOpen }"
                    >
                        <span class="absolute -inset-1.5"></span>
                        <span class="sr-only">查看通知</span>
                        {{-- 未讀通知數量徽章 --}}
                        <span class="absolute top-0 right-0 flex h-4 w-4 items-center justify-center rounded-full bg-red-500 text-white text-xs font-bold ring-2 ring-white">3</span>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" data-slot="icon" aria-hidden="true" class="size-5 sm:size-6">
                            <path d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </button>

                    {{-- 通知面板 --}}
                    <div
                        x-show="notificationOpen"
                        @click.away="notificationOpen = false"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 scale-95 translate-y-1"
                        x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                        x-transition:leave-end="opacity-0 scale-95 translate-y-1"
                        class="absolute right-0 mt-2 w-80 origin-top-right rounded-lg bg-white shadow-lg ring-1 ring-black/5 focus:outline-hidden z-[100]"
                        style="display: none;"
                    >
                        {{-- 標題 --}}
                        <div class="flex items-center justify-between px-4 py-3 border-b border-gray-100">
                            <h3 class="text-sm font-semibold text-gray-900">通知</h3>
                            <button type="button" class="text-xs font-medium text-indigo-600 hover:text-indigo-700">全部標示為已讀</button>
                        </div>

                        {{-- 通知列表 --}}
                        <div class="max-h-96 overflow-y-auto">
                            {{-- 通知項目 1 --}}
                            <a href="#" class="block px-4 py-3 hover:bg-gray-50 transition-colors duration-150">
                                <div class="flex items-start gap-x-3">
                                    <div class="flex-shrink-0">
                                        <div class="flex h-8 w-8 items-center justify-center rounded-full bg-blue-100">
                                            <svg class="h-4 w-4 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z" />
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-gray-900">新配方已建立</p>
                                        <p class="text-xs text-gray-500 mt-0.5">配方 #0006「珍珠奶茶」已成功建立</p>
                                        <p class="text-xs text-gray-400 mt-1">5 分鐘前</p>
                                    </div>
                                    <span class="h-2 w-2 rounded-full bg-blue-600"></span>
                                </div>
                            </a>

                            {{-- 通知項目 2 --}}
                            <a href="#" class="block px-4 py-3 hover:bg-gray-50 transition-colors duration-150">
                                <div class="flex items-start gap-x-3">
                                    <div class="flex-shrink-0">
                                        <div class="flex h-8 w-8 items-center justify-center rounded-full bg-green-100">
                                            <svg class="h-4 w-4 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-gray-900">配方審核通過</p>
                                        <p class="text-xs text-gray-500 mt-0.5">配方 #0005「薏仁湯」已通過審核</p>
                                        <p class="text-xs text-gray-400 mt-1">1 小時前</p>
                                    </div>
                                    <span class="h-2 w-2 rounded-full bg-blue-600"></span>
                                </div>
                            </a>

                            {{-- 通知項目 3 --}}
                            <a href="#" class="block px-4 py-3 hover:bg-gray-50 transition-colors duration-150">
                                <div class="flex items-start gap-x-3">
                                    <div class="flex-shrink-0">
                                        <div class="flex h-8 w-8 items-center justify-center rounded-full bg-orange-100">
                                            <svg class="h-4 w-4 text-orange-600" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-gray-900">系統維護通知</p>
                                        <p class="text-xs text-gray-500 mt-0.5">系統將於今晚 23:00 進行維護</p>
                                        <p class="text-xs text-gray-400 mt-1">3 小時前</p>
                                    </div>
                                    <span class="h-2 w-2 rounded-full bg-blue-600"></span>
                                </div>
                            </a>
                        </div>

                        {{-- 查看全部 --}}
                        <div class="border-t border-gray-100">
                            <a href="/notifications" class="block px-4 py-3 text-center text-sm font-medium text-indigo-600 hover:text-indigo-700 hover:bg-gray-50 transition-colors duration-150">
                                查看全部通知
                            </a>
                        </div>
                    </div>
                </div>

                {{-- 用戶下拉選單 --}}
                @if($currentUser)
                    <el-dropdown class="relative z-[100]">
                        <button class="relative flex items-center gap-x-2 rounded-lg px-2 sm:px-3 py-1.5 hover:bg-gray-100 transition-colors duration-200">
                            <span class="sr-only">開啟用戶選單</span>
                            @if(isset($currentUser['avatar']))
                                <img src="{{ $currentUser['avatar'] }}" alt="{{ $currentUser['name'] }}" class="size-8 rounded-full bg-gray-100 outline -outline-offset-1 outline-black/5" />
                            @else
                                <svg viewBox="0 0 24 24" fill="currentColor" class="size-8 text-gray-400">
                                    <path fill-rule="evenodd" d="M18.685 19.097A9.723 9.723 0 0 0 21.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 0 0 3.065 7.097A9.716 9.716 0 0 0 12 21.75a9.716 9.716 0 0 0 6.685-2.653Zm-12.54-1.285A7.486 7.486 0 0 1 12 15a7.486 7.486 0 0 1 5.855 2.812A8.224 8.224 0 0 1 12 20.25a8.224 8.224 0 0 1-5.855-2.438ZM15.75 9a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" clip-rule="evenodd" />
                                </svg>
                            @endif
                            <span class="hidden sm:block text-sm font-medium text-gray-700">{{ $currentUser['name'] }}</span>
                            <svg viewBox="0 0 20 20" fill="currentColor" class="hidden sm:block size-4 text-gray-400">
                                <path fill-rule="evenodd" d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                            </svg>
                        </button>

                        <el-menu anchor="bottom end" popover class="w-48 origin-top-right rounded-md bg-white py-1 shadow-lg outline outline-black/5 transition transition-discrete [--anchor-gap:--spacing(2)] data-closed:scale-95 data-closed:transform data-closed:opacity-0 data-enter:duration-200 data-enter:ease-out data-leave:duration-75 data-leave:ease-in">
                            <a href="/profile" class="block px-4 py-2 text-sm text-gray-700 focus:bg-gray-100 focus:outline-hidden">個人資料</a>
                            <a href="/settings" class="block px-4 py-2 text-sm text-gray-700 focus:bg-gray-100 focus:outline-hidden">設定</a>
                            <a href="/logout" class="block px-4 py-2 text-sm text-gray-700 focus:bg-gray-100 focus:outline-hidden">登出</a>
                        </el-menu>
                    </el-dropdown>
                @else
                    <a href="/login" class="ml-3 text-sm font-medium text-gray-700 hover:text-gray-900">登入</a>
                @endif
            </div>
    </div>

    {{-- 行動版選單 --}}
    <el-disclosure id="mobile-menu" hidden class="sm:hidden">
        <div class="space-y-1 pt-2 pb-4">
            <a href="/" class="block border-l-4 {{ $currentPage === 'home' ? 'border-indigo-600 bg-indigo-50 text-indigo-700' : 'border-transparent text-gray-500 hover:border-gray-300 hover:bg-gray-50 hover:text-gray-700' }} py-2 pr-4 pl-3 text-base font-medium">首頁</a>

            {{-- 研發模組 (行動版) --}}
            <div x-data="{ mobileModuleOpen: false }">
                <button
                    @click="mobileModuleOpen = !mobileModuleOpen"
                    class="flex w-full items-center justify-between border-l-4 {{ $currentPage === 'recipes' ? 'border-indigo-600 bg-indigo-50 text-indigo-700' : 'border-transparent text-gray-500 hover:border-gray-300 hover:bg-gray-50 hover:text-gray-700' }} py-2 pr-4 pl-3 text-base font-medium"
                >
                    研發模組
                    <svg viewBox="0 0 20 20" fill="currentColor" class="size-5" :class="{ 'rotate-180': mobileModuleOpen }">
                        <path fill-rule="evenodd" d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                    </svg>
                </button>
                <div x-show="mobileModuleOpen" x-transition class="bg-indigo-50/50">
                    <a href="/recipes" class="block py-2.5 pr-4 pl-10 text-sm font-medium text-gray-900 hover:bg-indigo-100 hover:text-indigo-700">配方單管理</a>
                    <a href="/rd-inspections" class="block py-2.5 pr-4 pl-10 text-sm font-medium text-gray-900 hover:bg-indigo-100 hover:text-indigo-700">研發檢驗單</a>
                    <a href="/sample-management" class="block py-2.5 pr-4 pl-10 text-sm font-medium text-gray-900 hover:bg-indigo-100 hover:text-indigo-700">送樣管理</a>
                    <a href="/cost-calculation" class="block py-2.5 pr-4 pl-10 text-sm font-medium text-gray-900 hover:bg-indigo-100 hover:text-indigo-700">成本試算</a>
                    <a href="/new-product-confirmation" class="block py-2.5 pr-4 pl-10 text-sm font-medium text-gray-900 hover:bg-indigo-100 hover:text-indigo-700">新品確認單</a>
                    <a href="/specification-documents" class="block py-2.5 pr-4 pl-10 text-sm font-medium text-gray-900 hover:bg-indigo-100 hover:text-indigo-700">規格文件管理</a>
                </div>
            </div>

            <a href="/settings" class="block border-l-4 {{ $currentPage === 'settings' ? 'border-indigo-600 bg-indigo-50 text-indigo-700' : 'border-transparent text-gray-500 hover:border-gray-300 hover:bg-gray-50 hover:text-gray-700' }} py-2 pr-4 pl-3 text-base font-medium">系統設定</a>
        </div>
    </el-disclosure>
</nav>
