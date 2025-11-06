@props([
    'action' => '',
    'method' => 'GET',
    'searchPlaceholder' => '搜尋...',
    'searchValue' => '',
    'sortOptions' => [],
    'sortValue' => '',
    'exportUrl' => '',  // 匯出網址
])

<div class="bg-gradient-to-br from-white to-gray-50/30 shadow-md outline-1 outline-black/5 rounded-xl border border-gray-100">
    <form action="{{ $action }}" method="{{ $method }}" class="p-4 sm:p-6">
        @if($method === 'POST')
            @csrf
        @endif

        {{-- 手機版：堆疊式佈局 / 桌面版：單行佈局 --}}
        <div class="space-y-3 sm:space-y-0 sm:flex sm:items-center sm:gap-x-4">
            {{-- 搜尋框 --}}
            <div class="w-full sm:w-96">
                <div class="relative">
                    <input
                        type="text"
                        name="search"
                        id="search"
                        value="{{ $searchValue }}"
                        placeholder="{{ $searchPlaceholder }}"
                        class="block w-full rounded-md bg-white py-2 sm:py-1.5 pr-3 pl-10 text-sm text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600"
                    />
                    {{-- 搜尋圖示 --}}
                    <svg
                        viewBox="0 0 20 20"
                        fill="currentColor"
                        aria-hidden="true"
                        data-slot="icon"
                        class="pointer-events-none absolute left-3 top-1/2 -translate-y-1/2 size-4 text-gray-400"
                    >
                        <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 1 0 0 11 5.5 5.5 0 0 0 0-11ZM2 9a7 7 0 1 1 12.452 4.391l3.328 3.329a.75.75 0 1 1-1.06 1.06l-3.329-3.328A7 7 0 0 1 2 9Z" clip-rule="evenodd" />
                    </svg>
                </div>
            </div>

            {{-- 排序選項 --}}
            @if(count($sortOptions) > 0)
                <div class="w-full sm:w-48">
                    <el-dropdown class="w-full" x-data="{ sortValue: '{{ $sortValue }}' }">
                        <input type="hidden" name="sort" id="sort" value="{{ $sortValue }}">
                        <button type="button" class="block w-full rounded-md bg-white py-2 pr-10 pl-3 text-sm text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 text-left relative">
                            <span x-text="sortValue === '' ? '預設排序' : ({{ json_encode(array_column($sortOptions, 'label', 'value')) }}[sortValue] || '預設排序')"></span>
                            <svg class="absolute right-3 top-1/2 -translate-y-1/2 size-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                            </svg>
                        </button>
                        <el-menu anchor="bottom start" popover class="w-48 origin-top-left rounded-md bg-white py-1 shadow-lg ring-1 ring-black/5 max-h-60 overflow-auto">
                            <button type="button" @click="sortValue = ''; document.getElementById('sort').value = ''" class="block w-full px-4 py-2 text-sm text-left text-gray-700 hover:bg-gray-100 focus:bg-gray-100 focus:outline-hidden" :class="{ 'bg-indigo-50 text-indigo-700': sortValue === '' }">
                                預設排序
                            </button>
                            @foreach($sortOptions as $option)
                                <button type="button" @click="sortValue = '{{ $option['value'] }}'; document.getElementById('sort').value = '{{ $option['value'] }}'" class="block w-full px-4 py-2 text-sm text-left text-gray-700 hover:bg-gray-100 focus:bg-gray-100 focus:outline-hidden" :class="{ 'bg-indigo-50 text-indigo-700': sortValue === '{{ $option['value'] }}' }">
                                    {{ $option['label'] }}
                                </button>
                            @endforeach
                        </el-menu>
                    </el-dropdown>
                </div>
            @endif

            {{-- 操作按鈕 --}}
            <div class="flex items-center gap-x-2 sm:gap-x-3 sm:ml-auto">
                {{-- 匯出按鈕 --}}
                @if($exportUrl)
                    <x-recipes.button
                        type="button"
                        variant="secondary"
                        size="md"
                        title="匯出"
                    >
                        <svg viewBox="0 0 20 20" fill="currentColor" data-slot="icon" aria-hidden="true" class="size-5 sm:-ml-0.5">
                            <path d="M10.75 2.75a.75.75 0 0 0-1.5 0v8.614L6.295 8.235a.75.75 0 1 0-1.09 1.03l4.25 4.5a.75.75 0 0 0 1.09 0l4.25-4.5a.75.75 0 0 0-1.09-1.03l-2.955 3.129V2.75Z" />
                            <path d="M3.5 12.75a.75.75 0 0 0-1.5 0v2.5A2.75 2.75 0 0 0 4.75 18h10.5A2.75 2.75 0 0 0 18 15.25v-2.5a.75.75 0 0 0-1.5 0v2.5c0 .69-.56 1.25-1.25 1.25H4.75c-.69 0-1.25-.56-1.25-1.25v-2.5Z" />
                        </svg>
                        <span class="hidden sm:inline">匯出</span>
                    </x-recipes.button>
                @endif

                {{-- 重置按鈕 --}}
                <x-recipes.button
                    type="button"
                    variant="secondary"
                    size="md"
                    onclick="window.location.href='{{ $action }}'"
                    title="重置"
                >
                    <svg viewBox="0 0 20 20" fill="currentColor" data-slot="icon" aria-hidden="true" class="size-5 sm:-ml-0.5">
                        <path fill-rule="evenodd" d="M15.312 11.424a5.5 5.5 0 0 1-9.201 2.466l-.312-.311h2.433a.75.75 0 0 0 0-1.5H3.989a.75.75 0 0 0-.75.75v4.242a.75.75 0 0 0 1.5 0v-2.43l.31.31a7 7 0 0 0 11.712-3.138.75.75 0 0 0-1.449-.39Zm1.23-3.723a.75.75 0 0 0 .219-.53V2.929a.75.75 0 0 0-1.5 0V5.36l-.31-.31A7 7 0 0 0 3.239 8.188a.75.75 0 1 0 1.448.389A5.5 5.5 0 0 1 13.89 6.11l.311.31h-2.432a.75.75 0 0 0 0 1.5h4.243a.75.75 0 0 0 .53-.219Z" clip-rule="evenodd" />
                    </svg>
                    <span class="hidden sm:inline">重置</span>
                </x-recipes.button>

                {{-- 套用篩選按鈕 --}}
                <x-recipes.button
                    type="submit"
                    variant="primary"
                    size="md"
                    title="套用篩選"
                >
                    <svg viewBox="0 0 20 20" fill="currentColor" data-slot="icon" aria-hidden="true" class="size-5 sm:-ml-0.5">
                        <path fill-rule="evenodd" d="M2.628 1.601C5.028 1.206 7.49 1 10 1s4.973.206 7.372.601a.75.75 0 0 1 .628.74v2.288a2.25 2.25 0 0 1-.659 1.59l-4.682 4.683a2.25 2.25 0 0 0-.659 1.59v3.037c0 .684-.31 1.33-.844 1.757l-1.937 1.55A.75.75 0 0 1 8 18.25v-5.757a2.25 2.25 0 0 0-.659-1.591L2.659 6.22A2.25 2.25 0 0 1 2 4.629V2.34a.75.75 0 0 1 .628-.74Z" clip-rule="evenodd" />
                    </svg>
                    <span class="hidden sm:inline">套用篩選</span>
                </x-recipes.button>
            </div>
        </div>
    </form>
</div>
