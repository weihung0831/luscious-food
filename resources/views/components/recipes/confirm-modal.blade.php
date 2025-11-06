@props([
    'title' => '確認操作',
    'confirmText' => '確認',
    'cancelText' => '取消',
    'confirmVariant' => 'danger', // 'danger' | 'primary'
    'show' => false,
    'itemName' => '', // 用於動態顯示的項目名稱（Alpine.js 變數）
])

<div
    x-show="{{ $show }}"
    x-transition:enter="transition ease-out duration-200"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-150"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    class="fixed inset-0 z-[999] overflow-y-auto"
    style="display: none;"
    @keydown.escape.window="{{ $show }} = false"
>
    {{-- 背景遮罩 --}}
    <div class="fixed inset-0 bg-black/30 backdrop-blur-sm transition-opacity"></div>

    {{-- Modal 容器 --}}
    <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
        <div
            x-show="{{ $show }}"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            class="relative transform overflow-hidden rounded-xl bg-white text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-lg"
        >
            {{-- Modal 內容 --}}
            <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    {{-- 警告圖示 --}}
                    <div class="mx-auto flex size-12 shrink-0 items-center justify-center rounded-full {{ $confirmVariant === 'danger' ? 'bg-red-100' : 'bg-indigo-100' }} sm:mx-0 sm:size-10">
                        <svg class="size-6 {{ $confirmVariant === 'danger' ? 'text-red-600' : 'text-indigo-600' }}" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                        </svg>
                    </div>

                    {{-- 文字內容 --}}
                    <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                        <h3 class="text-lg font-semibold leading-6 text-gray-900">
                            {{ $title }}
                        </h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500">
                                @if($itemName)
                                    您確定要刪除「<span x-text="{{ $itemName }}"></span>」嗎？此操作無法復原。
                                @else
                                    {{ $slot }}
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- 按鈕區 --}}
            <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6 gap-x-3">
                {{-- 確認按鈕 --}}
                <x-recipes.button
                    type="button"
                    :variant="$confirmVariant"
                    size="md"
                    {{ $attributes->merge(['class' => 'w-full sm:w-auto']) }}
                >
                    {{ $confirmText }}
                </x-recipes.button>

                {{-- 取消按鈕 --}}
                <x-recipes.button
                    type="button"
                    variant="secondary"
                    size="md"
                    @click="{{ $show }} = false"
                    class="w-full mt-3 sm:mt-0 sm:w-auto"
                >
                    {{ $cancelText }}
                </x-recipes.button>
            </div>
        </div>
    </div>
</div>
