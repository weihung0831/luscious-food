@props([
    'type' => 'success',
    'title' => '',
    'message' => '',
    'dismissible' => true,
])

@php
$typeConfig = [
    'success' => [
        'bgClass' => 'bg-gradient-to-r from-green-50 to-emerald-50',
        'borderClass' => 'border-l-4 border-green-500',
        'iconBgClass' => 'bg-green-100',
        'icon' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" data-slot="icon" aria-hidden="true" class="size-6 text-green-600">
                    <path d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" stroke-linecap="round" stroke-linejoin="round" />
                  </svg>',
    ],
    'error' => [
        'bgClass' => 'bg-gradient-to-r from-red-50 to-pink-50',
        'borderClass' => 'border-l-4 border-red-500',
        'iconBgClass' => 'bg-red-100',
        'icon' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" data-slot="icon" aria-hidden="true" class="size-6 text-red-600">
                    <path d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" stroke-linecap="round" stroke-linejoin="round" />
                  </svg>',
    ],
    'warning' => [
        'bgClass' => 'bg-gradient-to-r from-yellow-50 to-orange-50',
        'borderClass' => 'border-l-4 border-yellow-500',
        'iconBgClass' => 'bg-yellow-100',
        'icon' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" data-slot="icon" aria-hidden="true" class="size-6 text-yellow-600">
                    <path d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" stroke-linecap="round" stroke-linejoin="round" />
                  </svg>',
    ],
    'info' => [
        'bgClass' => 'bg-gradient-to-r from-blue-50 to-indigo-50',
        'borderClass' => 'border-l-4 border-blue-500',
        'iconBgClass' => 'bg-blue-100',
        'icon' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" data-slot="icon" aria-hidden="true" class="size-6 text-blue-600">
                    <path d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" stroke-linecap="round" stroke-linejoin="round" />
                  </svg>',
    ],
];

$config = $typeConfig[$type] ?? $typeConfig['success'];
@endphp

<div class="pointer-events-auto w-full max-w-sm rounded-xl shadow-lg overflow-hidden {{ $config['borderClass'] }} animate-in slide-in-from-right duration-300">
    <div class="p-4 {{ $config['bgClass'] }}">
        <div class="flex items-start">
            {{-- 圖示 --}}
            <div class="shrink-0">
                <div class="flex items-center justify-center w-10 h-10 rounded-lg {{ $config['iconBgClass'] }}">
                    {!! $config['icon'] !!}
                </div>
            </div>

            {{-- 訊息內容 --}}
            <div class="ml-3 w-0 flex-1 pt-1">
                <p class="text-sm font-semibold text-gray-900">{{ $title }}</p>
                @if($message)
                    <p class="mt-1 text-sm text-gray-600">{{ $message }}</p>
                @endif
            </div>

            {{-- 關閉按鈕 --}}
            @if($dismissible)
                <div class="ml-4 flex shrink-0">
                    <button type="button" class="inline-flex items-center justify-center rounded-lg p-1.5 text-gray-400 hover:bg-white/50 hover:text-gray-600 transition-all duration-200 focus:outline-2 focus:outline-offset-2 focus:outline-indigo-600">
                        <span class="sr-only">關閉</span>
                        <svg viewBox="0 0 20 20" fill="currentColor" data-slot="icon" aria-hidden="true" class="size-5">
                            <path d="M6.28 5.22a.75.75 0 0 0-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 1 0 1.06 1.06L10 11.06l3.72 3.72a.75.75 0 1 0 1.06-1.06L11.06 10l3.72-3.72a.75.75 0 0 0-1.06-1.06L10 8.94 6.28 5.22Z" />
                        </svg>
                    </button>
                </div>
            @endif
        </div>
    </div>
</div>
