@props([
    'cancelUrl' => '/recipes',
    'cancelText' => '取消',
    'submitText' => '儲存',
    'submitForm' => null,
    'submitVariant' => 'primary',
])

{{-- 手機版固定底部按鈕列 --}}
<div class="fixed bottom-0 inset-x-0 bg-white border-t border-gray-200 px-4 py-3 sm:hidden z-40 shadow-lg">
    <div class="flex items-center gap-3">
        <a href="{{ $cancelUrl }}" class="flex-1">
            <x-recipes.button variant="secondary" size="md" class="w-full">
                {{ $cancelText }}
            </x-recipes.button>
        </a>
        @if($submitForm)
            <x-recipes.button
                variant="{{ $submitVariant }}"
                type="submit"
                form="{{ $submitForm }}"
                size="md"
                class="flex-1"
            >
                {{ $submitText }}
            </x-recipes.button>
        @else
            <x-recipes.button
                variant="{{ $submitVariant }}"
                type="submit"
                size="md"
                class="flex-1"
            >
                {{ $submitText }}
            </x-recipes.button>
        @endif
    </div>
</div>
