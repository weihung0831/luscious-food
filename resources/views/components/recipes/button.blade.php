@props([
    'type' => 'button',
    'variant' => 'primary',
    'size' => 'md',
    'disabled' => false,
])

@php
// 變體配色
$variantClasses = [
    'primary' => 'bg-emerald-600 text-white hover:bg-emerald-700 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-emerald-600',
    'secondary' => 'bg-white text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600',
    'danger' => 'bg-red-600 text-white hover:bg-red-700 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600',
];

// 尺寸系統 (根據 Tailwind UI 規格)
$sizeClasses = [
    'xs' => 'rounded-md px-2 py-1 text-xs',
    'sm' => 'rounded-md px-2.5 py-1.5 text-sm',
    'md' => 'rounded-md px-4 py-2 text-sm',
    'lg' => 'rounded-lg px-5 py-2.5 text-sm',
    'xl' => 'rounded-lg px-6 py-3 text-base',
];

// 圖示間距 (根據尺寸調整)
$iconGapClasses = [
    'xs' => 'gap-x-1.5',
    'sm' => 'gap-x-1.5',
    'md' => 'gap-x-1.5',
    'lg' => 'gap-x-1.5',
    'xl' => 'gap-x-2',
];

$variantClass = $variantClasses[$variant] ?? $variantClasses['primary'];
$sizeClass = $sizeClasses[$size] ?? $sizeClasses['md'];
$iconGapClass = $iconGapClasses[$size] ?? $iconGapClasses['md'];

// Disabled 狀態樣式
$disabledClass = $disabled ? 'opacity-50 cursor-not-allowed' : '';

// 基礎樣式
$baseClasses = 'inline-flex items-center justify-center font-semibold transition-colors duration-200';

// 檢查是否有 slot 內容包含 SVG (判斷是否為帶圖示的按鈕)
$hasIcon = $slot && str_contains($slot, '<svg');
$gapClass = $hasIcon ? $iconGapClass : '';
@endphp

<button
    type="{{ $type }}"
    @if($disabled) disabled @endif
    {{ $attributes->merge(['class' => trim("$baseClasses $variantClass $sizeClass $gapClass $disabledClass")]) }}
>
    {{ $slot }}
</button>
