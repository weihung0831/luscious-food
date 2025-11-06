@props([
    'version' => 'v1',
])

@php
// 支援兩種格式：
// 1. 字母+數字格式 (A1, B2, C5) - 根據字母選擇顏色
// 2. v+數字格式 (v1, v2, v3) - 根據數字選擇顏色

$firstChar = substr($version, 0, 1);

// 判斷是哪種格式
if ($firstChar === 'v' || $firstChar === 'V') {
    // v+數字格式：根據版本號選擇顏色
    $versionNumber = (int) substr($version, 1);
    $colorIndex = ($versionNumber - 1) % 6; // 0-5 循環
    $colors = [
        'bg-blue-100 text-blue-700',      // v1, v7, v13...
        'bg-purple-100 text-purple-700',  // v2, v8, v14...
        'bg-pink-100 text-pink-700',      // v3, v9, v15...
        'bg-indigo-100 text-indigo-700',  // v4, v10, v16...
        'bg-green-100 text-green-700',    // v5, v11, v17...
        'bg-yellow-100 text-yellow-800',  // v6, v12, v18...
    ];
    $colorClass = $colors[$colorIndex];
} else {
    // 字母+數字格式：根據字母選擇顏色
    $colorMap = [
        'A' => 'bg-blue-100 text-blue-700',
        'B' => 'bg-purple-100 text-purple-700',
        'C' => 'bg-pink-100 text-pink-700',
        'D' => 'bg-indigo-100 text-indigo-700',
        'E' => 'bg-green-100 text-green-700',
        'F' => 'bg-yellow-100 text-yellow-800',
    ];
    $colorClass = $colorMap[$firstChar] ?? 'bg-gray-100 text-gray-600';
}
@endphp

<span class="inline-flex items-center rounded-full {{ $colorClass }} px-2 py-1 text-xs font-semibold font-mono">
    {{ $version }}
</span>
