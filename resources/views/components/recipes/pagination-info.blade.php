@props([
    'from' => 1,
    'to' => 10,
    'total' => 10,
    'perPage' => 20,
    'perPageOptions' => [10, 20, 50, 100],
    'showPerPageSelector' => true,
])

<div class="flex items-center justify-between px-1">
    {{-- 左側：筆數顯示 --}}
    <div class="flex items-center gap-x-2">
        <div class="flex items-center justify-center w-8 h-8 rounded-lg bg-gradient-to-br from-indigo-50 to-purple-50">
            <svg class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
        </div>
        <div class="text-sm text-gray-600">
            顯示第 <span class="font-semibold text-indigo-600">{{ $from }}</span> 至 <span class="font-semibold text-indigo-600">{{ $to }}</span> 筆，共 <span class="font-semibold text-gray-900">{{ $total }}</span> 筆
        </div>
    </div>

    {{-- 右側：每頁顯示選擇器 (選填) --}}
    @if($showPerPageSelector)
        <div class="flex items-center gap-x-2">
            <label class="text-sm font-medium text-gray-700">每頁顯示</label>
            <el-dropdown x-data="{ perPage: {{ $perPage }} }">
                <input type="hidden" name="per_page" id="per-page" :value="perPage">
                <button type="button" class="rounded-lg border border-gray-200 bg-white py-1.5 pl-3 pr-8 text-sm font-medium text-gray-900 shadow-sm transition-all duration-200 hover:border-indigo-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 relative">
                    <span x-text="perPage"></span>
                    <svg class="absolute right-2 top-1/2 -translate-y-1/2 size-4 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                    </svg>
                </button>
                <el-menu anchor="bottom start" popover class="w-24 origin-top-left rounded-md bg-white py-1 shadow-lg ring-1 ring-black/5">
                    @foreach($perPageOptions as $option)
                        <button
                            type="button"
                            @click="perPage = {{ $option }}"
                            class="block w-full px-4 py-2 text-sm text-left text-gray-700 hover:bg-gray-100 focus:bg-gray-100 focus:outline-hidden"
                            :class="{ 'bg-indigo-50 text-indigo-700': perPage === {{ $option }} }"
                        >
                            {{ $option }}
                        </button>
                    @endforeach
                </el-menu>
            </el-dropdown>
            <span class="text-sm text-gray-700">筆</span>
        </div>
    @endif
</div>
