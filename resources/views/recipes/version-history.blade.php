@extends('layouts.app')

@section('title', '版本歷史')

@section('content')

{{-- 假資料：配方基本資訊 --}}
@php
$recipe = [
    'id' => 1,
    'code' => '#0001',
    'name' => '紅豆湯',
    'description' => '經典紅豆湯系列，多種口味選擇',
];

$versions = [
    [
        'id' => 3,
        'version_name' => 'v3',
        'version_label' => '低糖版',
        'created_at' => '2024-03-15',
        'purpose' => '因應健康需求，降低糖分含量至原配方的 70%，同時保持口感',
        'sample_quantity' => 15,
        'sample_unit' => '罐',
        'ph_value' => '6.5',
        'brix_value' => '12.5',
        'view_url' => '/recipes/1/versions/3',
        'edit_url' => '/recipes/1/versions/3/edit',
        'copy_url' => '/recipes/1/versions/create?copy_from=3',
    ],
    [
        'id' => 2,
        'version_name' => 'v2',
        'version_label' => '改良版',
        'created_at' => '2024-02-10',
        'purpose' => '改良口感，增加紅豆顆粒完整度，調整甜度平衡',
        'sample_quantity' => 12,
        'sample_unit' => '罐',
        'ph_value' => '6.3',
        'brix_value' => '15.0',
        'view_url' => '/recipes/1/versions/2',
        'edit_url' => '/recipes/1/versions/2/edit',
        'copy_url' => '/recipes/1/versions/create?copy_from=2',
    ],
    [
        'id' => 1,
        'version_name' => 'v1',
        'version_label' => '傳統版',
        'created_at' => '2024-01-05',
        'purpose' => '經典傳統配方，保留原始風味，作為基準版本',
        'sample_quantity' => 10,
        'sample_unit' => '罐',
        'ph_value' => '6.2',
        'brix_value' => '18.0',
        'view_url' => '/recipes/1/versions/1',
        'edit_url' => '/recipes/1/versions/1/edit',
        'copy_url' => '/recipes/1/versions/create?copy_from=1',
    ],
];
@endphp

{{-- Page Header --}}
<x-recipes.page-header :title="$recipe['name'] . ' - 版本管理'">
    <x-slot name="breadcrumb">
        <x-recipes.breadcrumb :items="[
            ['label' => '研發模組', 'url' => '/'],
            ['label' => '配方單管理', 'url' => '/recipes'],
            ['label' => $recipe['name'], 'url' => '/recipes/' . $recipe['id']],
            ['label' => '版本歷史'],
        ]" />
    </x-slot>
    <x-slot name="actions">
        {{-- 返回列表 --}}
        <a href="/recipes" class="inline-flex items-center justify-center gap-x-1.5 sm:gap-x-2 rounded-md bg-white px-3 sm:px-3.5 py-2 sm:py-2.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 transition-colors duration-200 whitespace-nowrap">
            <svg class="size-4 sm:size-5 sm:-ml-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            <span class="hidden xs:inline sm:inline">返回列表</span>
            <span class="inline xs:hidden sm:hidden">返回</span>
        </a>

        {{-- 新增版本 --}}
        <a href="/recipes/{{ $recipe['id'] }}/versions/create" class="inline-flex items-center justify-center gap-x-1.5 sm:gap-x-2 rounded-md bg-indigo-600 px-3 sm:px-3.5 py-2 sm:py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 transition-colors duration-200 whitespace-nowrap">
            <svg viewBox="0 0 20 20" fill="currentColor" data-slot="icon" aria-hidden="true" class="size-4 sm:size-5 sm:-ml-0.5">
                <path d="M10.75 4.75a.75.75 0 0 0-1.5 0v4.5h-4.5a.75.75 0 0 0 0 1.5h4.5v4.5a.75.75 0 0 0 1.5 0v-4.5h4.5a.75.75 0 0 0 0-1.5h-4.5v-4.5Z" />
            </svg>
            <span class="hidden xs:inline sm:inline">新增版本</span>
            <span class="inline xs:hidden sm:hidden">新增</span>
        </a>
    </x-slot>
</x-recipes.page-header>

{{-- Main Content --}}
<div class="min-h-screen bg-gradient-to-br from-gray-50 via-gray-50 to-indigo-50/20">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-12">
        <div class="space-y-6">

            {{-- 配方資訊卡片 --}}
            <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
                <div class="bg-gradient-to-r from-indigo-50/50 via-purple-50/30 to-pink-50/20 px-6 py-4 border-b border-gray-100">
                    <div class="flex items-start justify-between">
                        <div>
                            <h2 class="text-xl font-bold text-gray-900">{{ $recipe['name'] }}</h2>
                            @if(!empty($recipe['description']))
                                <p class="mt-1 text-sm text-gray-600">{{ $recipe['description'] }}</p>
                            @endif
                        </div>
                        <span class="inline-flex items-center px-3 py-1 rounded-lg bg-gradient-to-r from-purple-100 to-indigo-100 text-purple-800 font-mono text-xs font-bold shadow-sm ring-1 ring-purple-200/50">
                            {{ $recipe['code'] }}
                        </span>
                    </div>
                </div>

                <div class="px-6 py-4">
                    <div class="flex items-center gap-x-6 text-sm text-gray-600">
                        <div class="flex items-center gap-x-2">
                            <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2.994 2.994 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                            </svg>
                            <span class="font-medium">版本總數：</span>
                            <span class="font-semibold text-indigo-600">{{ count($versions) }} 個版本</span>
                        </div>
                        <div class="flex items-center gap-x-2">
                            <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span class="font-medium">最新版本：</span>
                            <x-recipes.version-badge :version="$versions[0]['version_name']" />
                        </div>
                    </div>
                </div>
            </div>

            {{-- Filter Panel --}}
            @php
            $sortOptions = [
                ['value' => 'version_desc', 'label' => '版本號 (新→舊)'],
                ['value' => 'version_asc', 'label' => '版本號 (舊→新)'],
                ['value' => 'created_at_desc', 'label' => '建立時間 (新→舊)'],
                ['value' => 'created_at_asc', 'label' => '建立時間 (舊→新)'],
            ];
            @endphp

            <x-recipes.filter-panel
                action="/recipes/{{ $recipe['id'] }}/versions"
                searchPlaceholder="搜尋版本名稱或研發目的..."
                :searchValue="request('search', '')"
                :sortOptions="$sortOptions"
                :sortValue="request('sort', '')"
                exportUrl="/recipes/{{ $recipe['id'] }}/versions/export"
            />

            {{-- 筆數顯示與每頁選擇 --}}
            <x-recipes.pagination-info
                :from="1"
                :to="count($versions)"
                :total="count($versions)"
                :perPage="20"
            />

            {{-- Version History Table --}}
            <x-recipes.version-history-table
                :versions="$versions"
                :recipeId="$recipe['id']"
            />

        </div>
    </div>
</div>

{{-- 返回頂部按鈕 --}}
<x-scroll-to-top />

@endsection
