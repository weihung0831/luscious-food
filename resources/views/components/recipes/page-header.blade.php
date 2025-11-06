@props([
    'title' => '',
    'subtitle' => '',
])

<div class="relative bg-gradient-to-br from-white via-indigo-50/30 to-purple-50/30 border-b border-gray-200">
    <div class="absolute inset-0 bg-grid-slate-100 [mask-image:linear-gradient(0deg,white,rgba(255,255,255,0.6))] -z-10"></div>
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="py-8">
            {{-- 麵包屑導航 (選填) --}}
            @isset($breadcrumb)
                <div class="mb-8">
                    {{ $breadcrumb }}
                </div>
            @endisset

            {{-- 標題與操作按鈕 --}}
            <div class="flex items-start justify-between gap-3 sm:gap-4">
                <div class="min-w-0 flex-1">
                    <div>
                        <h1 class="text-2xl sm:text-3xl md:text-4xl font-bold text-gray-900 tracking-tight">
                            {{ $title }}
                        </h1>
                        @if($subtitle)
                            <p class="mt-2 text-sm sm:text-base text-gray-600">
                                {{ $subtitle }}
                            </p>
                        @endif
                    </div>
                </div>

                {{-- 操作按鈕區域 --}}
                @isset($actions)
                    <div class="flex gap-2 sm:gap-3 shrink-0">
                        {{ $actions }}
                    </div>
                @endisset
            </div>
        </div>
    </div>
</div>
