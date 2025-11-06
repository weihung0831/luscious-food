@props([
    'status' => 'pending',
])

@php
$statusConfig = [
    'pending' => [
        'label' => '待審核',
        'class' => 'bg-yellow-100 text-yellow-800',
    ],
    'approved' => [
        'label' => '已核准',
        'class' => 'bg-green-100 text-green-700',
    ],
    'rejected' => [
        'label' => '已退回',
        'class' => 'bg-red-100 text-red-700',
    ],
    'archived' => [
        'label' => '已歸檔',
        'class' => 'bg-gray-100 text-gray-600',
    ],
];

$config = $statusConfig[$status] ?? $statusConfig['pending'];
@endphp

<span class="inline-flex items-center rounded-full {{ $config['class'] }} px-2 py-1 text-xs font-medium">
    {{ $config['label'] }}
</span>
