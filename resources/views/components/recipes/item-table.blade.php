@props([
    'items' => [],
    'showTotal' => true,
    'editable' => true,
])

@php
// 計算百分比總和
$percentageTotal = collect($items)->sum(function($item) {
    $percentage = $item['percentage'] ?? 0;
    return is_numeric($percentage) ? floatval($percentage) : 0;
});
$isTotalValid = abs($percentageTotal - 100) < 0.01; // 容許 0.01% 的誤差
@endphp

<div>
    {{-- 標題與新增按鈕 --}}
    @if($editable)
        <div class="sm:flex sm:items-center mb-4">
            <div class="sm:flex-auto">
                <h3 class="text-sm font-semibold text-gray-900">項目清單</h3>
                <p class="mt-1 text-xs text-gray-700">至少需要一個項目,百分比總和建議為 100%</p>
            </div>
            <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                {{-- TODO: 使用 Alpine.js 實作動態新增項目 --}}
                <x-recipes.button variant="primary" size="sm" type="button">
                    <svg viewBox="0 0 20 20" fill="currentColor" data-slot="icon" aria-hidden="true" class="-ml-0.5 size-5">
                        <path d="M10.75 4.75a.75.75 0 0 0-1.5 0v4.5h-4.5a.75.75 0 0 0 0 1.5h4.5v4.5a.75.75 0 0 0 1.5 0v-4.5h4.5a.75.75 0 0 0 0-1.5h-4.5v-4.5Z" />
                    </svg>
                    新增項目
                </x-recipes.button>
            </div>
        </div>
    @endif

    {{-- 手機版：卡片式佈局 --}}
    <div class="md:hidden space-y-4">
        @forelse($items as $index => $item)
            <div class="bg-white rounded-lg border border-gray-200 shadow-sm hover:shadow-md transition-shadow duration-200 overflow-hidden">
                {{-- 卡片標題 --}}
                <div class="bg-gradient-to-r from-indigo-50 to-purple-50/30 px-4 py-3 border-b border-gray-100 flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <span class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-indigo-600 text-xs font-semibold text-white">
                            {{ $index + 1 }}
                        </span>
                        <span class="text-sm font-semibold text-gray-900">項目 #{{ $index + 1 }}</span>
                    </div>
                    @if($editable)
                        <button type="button" class="inline-flex items-center gap-1 rounded-lg px-2 py-1 text-xs font-medium text-red-600 hover:bg-red-50 transition-all duration-200">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                            刪除
                        </button>
                    @endif
                </div>

                {{-- 卡片內容 --}}
                <div class="px-4 py-4 space-y-4">
                    {{-- 項目名稱 --}}
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-1.5">項目名稱</label>
                        @if($editable)
                            <input
                                type="text"
                                name="items[{{ $index }}][name]"
                                value="{{ $item['name'] ?? '' }}"
                                placeholder="請輸入項目名稱"
                                class="block w-full rounded-lg border-0 px-3 py-2 text-sm text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 transition-all duration-200 focus:ring-2 focus:ring-inset focus:ring-indigo-500"
                            />
                        @else
                            <span class="text-gray-900 font-medium">{{ $item['name'] ?? '-' }}</span>
                        @endif
                    </div>

                    {{-- 百分比與克數 --}}
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-xs font-medium text-gray-700 mb-1.5">百分比 (%)</label>
                            @if($editable)
                                <input
                                    type="number"
                                    name="items[{{ $index }}][percentage]"
                                    value="{{ $item['percentage'] ?? '' }}"
                                    placeholder="0.00"
                                    step="0.01"
                                    min="0"
                                    max="100"
                                    class="block w-full rounded-lg border-0 px-3 py-2 text-sm text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 transition-all duration-200 focus:ring-2 focus:ring-inset focus:ring-indigo-500"
                                />
                            @else
                                <span class="text-gray-500">{{ number_format($item['percentage'] ?? 0, 2) }}%</span>
                            @endif
                        </div>

                        <div>
                            <label class="block text-xs font-medium text-gray-700 mb-1.5">克數 (g)</label>
                            @if($editable)
                                <input
                                    type="number"
                                    name="items[{{ $index }}][weight]"
                                    value="{{ $item['weight'] ?? '' }}"
                                    placeholder="0.00"
                                    step="0.01"
                                    min="0"
                                    class="block w-full rounded-lg border-0 px-3 py-2 text-sm text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 transition-all duration-200 focus:ring-2 focus:ring-inset focus:ring-indigo-500"
                                />
                            @else
                                <span class="text-gray-500">{{ number_format($item['weight'] ?? 0, 2) }} g</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="bg-white rounded-lg border border-gray-200 px-4 py-8 text-center">
                <p class="text-sm text-gray-500">尚無項目，請點擊「新增項目」按鈕新增</p>
            </div>
        @endforelse
    </div>

    {{-- 桌面版：表格佈局 --}}
    <div class="hidden md:block flow-root">
        <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                <div class="overflow-hidden rounded-lg border border-gray-200">
                    <table class="relative min-w-full">
                        <thead class="bg-gradient-to-r from-gray-50 to-gray-100/50">
                            <tr class="border-b border-gray-200">
                                <th scope="col" class="w-12 py-3.5 pl-4 pr-2 text-center text-xs font-semibold text-gray-500 sm:pl-6">#</th>
                                <th scope="col" class="py-3.5 px-3 text-left text-sm font-semibold text-gray-900">項目名稱</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">百分比 (%)</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">克數 (g)</th>
                                @if($editable)
                                    <th scope="col" class="py-3.5 pr-4 pl-3 sm:pr-6 text-right">
                                        <span class="text-sm font-semibold text-gray-900">操作</span>
                                    </th>
                                @endif
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($items as $index => $item)
                                <tr class="hover:bg-indigo-50/50 transition-colors duration-150 {{ $index % 2 === 0 ? 'bg-white' : 'bg-gray-50/50' }}">
                                    {{-- 行號 --}}
                                    <td class="py-4 pl-4 pr-2 text-center sm:pl-6">
                                        <span class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-indigo-100 text-xs font-semibold text-indigo-700">
                                            {{ $index + 1 }}
                                        </span>
                                    </td>

                                    {{-- 項目名稱 --}}
                                    <td class="py-4 px-3 text-sm">
                                        @if($editable)
                                            <input
                                                type="text"
                                                name="items[{{ $index }}][name]"
                                                value="{{ $item['name'] ?? '' }}"
                                                placeholder="請輸入項目名稱"
                                                class="block w-full rounded-lg border-0 px-3 py-2 text-sm text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 transition-all duration-200 focus:ring-2 focus:ring-inset focus:ring-indigo-500 focus:shadow-md focus:bg-white"
                                            />
                                        @else
                                            <span class="text-gray-900 font-medium">{{ $item['name'] ?? '-' }}</span>
                                        @endif
                                    </td>

                                    {{-- 百分比 --}}
                                    <td class="px-3 py-4 text-sm whitespace-nowrap">
                                        @if($editable)
                                            <input
                                                type="number"
                                                name="items[{{ $index }}][percentage]"
                                                value="{{ $item['percentage'] ?? '' }}"
                                                placeholder="0.00"
                                                step="0.01"
                                                min="0"
                                                max="100"
                                                class="block w-24 rounded-lg border-0 px-3 py-2 text-sm text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 transition-all duration-200 focus:ring-2 focus:ring-inset focus:ring-indigo-500 focus:shadow-md focus:bg-white"
                                            />
                                        @else
                                            <span class="text-gray-500">{{ number_format($item['percentage'] ?? 0, 2) }}%</span>
                                        @endif
                                    </td>

                                    {{-- 克數 --}}
                                    <td class="px-3 py-4 text-sm whitespace-nowrap">
                                        @if($editable)
                                            <input
                                                type="number"
                                                name="items[{{ $index }}][weight]"
                                                value="{{ $item['weight'] ?? '' }}"
                                                placeholder="0.00"
                                                step="0.01"
                                                min="0"
                                                class="block w-24 rounded-lg border-0 px-3 py-2 text-sm text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 transition-all duration-200 focus:ring-2 focus:ring-inset focus:ring-indigo-500 focus:shadow-md focus:bg-white"
                                            />
                                        @else
                                            <span class="text-gray-500">{{ number_format($item['weight'] ?? 0, 2) }} g</span>
                                        @endif
                                    </td>

                                    {{-- 操作欄 --}}
                                    @if($editable)
                                        <td class="py-4 pr-4 pl-3 text-right text-sm font-medium whitespace-nowrap sm:pr-6">
                                            {{-- TODO: 使用 Alpine.js 實作刪除項目功能 --}}
                                            <button type="button" class="inline-flex items-center gap-1.5 rounded-lg px-3 py-1.5 text-sm font-medium text-red-600 hover:bg-red-50 hover:text-red-700 transition-all duration-200">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                                刪除<span class="sr-only">, {{ $item['name'] ?? '項目' }}</span>
                                            </button>
                                        </td>
                                    @endif
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="{{ $editable ? 5 : 4 }}" class="px-3 py-8 text-center text-sm text-gray-500">
                                        尚無項目，請點擊「新增項目」按鈕新增
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- 百分比總和提示 --}}
    @if($showTotal && count($items) > 0)
        <div class="mt-4 flex items-center justify-end gap-x-2">
            <span class="text-sm font-medium text-gray-700">百分比總和:</span>
            <span class="text-sm font-semibold {{ $isTotalValid ? 'text-green-600' : 'text-yellow-600' }}">
                {{ number_format($percentageTotal, 2) }}%
            </span>
            @if(!$isTotalValid)
                <svg viewBox="0 0 20 20" fill="currentColor" data-slot="icon" class="size-5 text-yellow-500" aria-hidden="true">
                    <path d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16ZM8.28 7.22a.75.75 0 0 0-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 1 0 1.06 1.06L10 11.06l1.72 1.72a.75.75 0 1 0 1.06-1.06L11.06 10l1.72-1.72a.75.75 0 0 0-1.06-1.06L10 8.94 8.28 7.22Z" clip-rule="evenodd" fill-rule="evenodd" />
                </svg>
                <span class="text-xs text-yellow-600">(建議為 100%)</span>
            @endif
        </div>
    @endif
</div>
