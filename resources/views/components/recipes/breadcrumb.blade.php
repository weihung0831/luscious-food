@props([
    'items' => [],
])

{{--
使用範例：
<x-recipes.breadcrumb :items="[
    ['label' => '研發模組', 'url' => '/'],
    ['label' => '配方單管理', 'url' => '/recipes'],
    ['label' => '紅豆湯', 'url' => '/recipes/1'],
    ['label' => '版本歷史'],
]" />
--}}

<nav class="flex mb-6" aria-label="Breadcrumb">
    <ol class="inline-flex items-center space-x-1">
        {{-- 首頁圖標 --}}
        <li class="inline-flex items-center">
            <a href="/" class="inline-flex items-center text-sm font-medium text-indigo-600 hover:text-indigo-700 transition-colors duration-200">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                </svg>
                <span class="sr-only">首頁</span>
            </a>
        </li>

        {{-- 動態麵包屑項目 --}}
        @foreach($items as $index => $item)
            <li>
                <div class="flex items-center">
                    {{-- 分隔符號 --}}
                    <svg class="w-5 h-5 text-gray-400 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>

                    {{-- 如果有 URL 則顯示為連結，否則顯示為文字（最後一項） --}}
                    @if(isset($item['url']))
                        <a href="{{ $item['url'] }}" class="ml-1 text-sm font-medium text-indigo-600 hover:text-indigo-700 transition-colors duration-200">
                            {{ $item['label'] }}
                        </a>
                    @else
                        <span class="ml-1 text-sm font-medium text-gray-600" aria-current="page">
                            {{ $item['label'] }}
                        </span>
                    @endif
                </div>
            </li>
        @endforeach
    </ol>
</nav>
