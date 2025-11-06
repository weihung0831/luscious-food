@extends('layouts.app')

@section('title', '配方單管理')

@section('content')

{{-- Page Header --}}
<x-recipes.page-header title="配方單管理">
    <x-slot name="breadcrumb">
        <x-recipes.breadcrumb :items="[
            ['label' => '研發模組', 'url' => '/'],
            ['label' => '配方單管理'],
        ]" />
    </x-slot>
    <x-slot name="actions">
        <a href="/recipes/create" class="inline-flex items-center justify-center gap-x-1.5 sm:gap-x-2 rounded-md bg-indigo-600 px-3 sm:px-3.5 py-2 sm:py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 transition-colors duration-200 whitespace-nowrap">
            <svg viewBox="0 0 20 20" fill="currentColor" data-slot="icon" aria-hidden="true" class="size-4 sm:size-5 sm:-ml-0.5">
                <path d="M10.75 4.75a.75.75 0 0 0-1.5 0v4.5h-4.5a.75.75 0 0 0 0 1.5h4.5v4.5a.75.75 0 0 0 1.5 0v-4.5h4.5a.75.75 0 0 0 0-1.5h-4.5v-4.5Z" />
            </svg>
            <span class="hidden sm:inline">建立配方</span>
            <span class="inline sm:hidden">建立</span>
        </a>
    </x-slot>
</x-recipes.page-header>

{{-- Main Content --}}
<div class="min-h-screen bg-gradient-to-br from-gray-50 via-gray-50 to-indigo-50/20">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-12">
        <div class="space-y-6">

            {{-- Filter Panel --}}
            @php
            $sortOptions = [
                ['value' => 'created_at_desc', 'label' => '建立時間 (新→舊)'],
                ['value' => 'created_at_asc', 'label' => '建立時間 (舊→新)'],
                ['value' => 'name_asc', 'label' => '名稱 (A→Z)'],
                ['value' => 'name_desc', 'label' => '名稱 (Z→A)'],
            ];
            @endphp

            <x-recipes.filter-panel
                action="/recipes"
                searchPlaceholder="搜尋配方名稱或編號..."
                :searchValue="request('search', '')"
                :sortOptions="$sortOptions"
                :sortValue="request('sort', '')"
                exportUrl="/recipes/export"
            />

            {{-- 筆數顯示與每頁選擇 --}}
            <x-recipes.pagination-info
                :from="1"
                :to="5"
                :total="5"
                :perPage="20"
            />

            {{-- Recipe List Table --}}
            @php
            $recipes = [
                [
                    'id' => 1,
                    'code' => '#0001',
                    'name' => '紅豆湯',
                    'description' => '經典紅豆湯系列，多種口味選擇',
                    'image_url' => null,
                    'version_count' => 3,
                    'latest_version' => 'v3',
                    'updated_at' => '2024-03-15',
                    'view_url' => '/recipes/1',
                    'versions_url' => '/recipes/1/versions',
                    'edit_url' => '/recipes/1/edit',
                ],
                [
                    'id' => 2,
                    'code' => '#0002',
                    'name' => '綠豆沙',
                    'description' => '清涼解暑綠豆沙配方',
                    'image_url' => null,
                    'version_count' => 2,
                    'latest_version' => 'v2',
                    'updated_at' => '2024-04-10',
                    'view_url' => '/recipes/2',
                    'versions_url' => '/recipes/2/versions',
                    'edit_url' => '/recipes/2/edit',
                ],
                [
                    'id' => 3,
                    'code' => '#0003',
                    'name' => '燕麥奶',
                    'description' => '植物奶系列產品',
                    'image_url' => null,
                    'version_count' => 1,
                    'latest_version' => 'v1',
                    'updated_at' => '2024-05-05',
                    'view_url' => '/recipes/3',
                    'versions_url' => '/recipes/3/versions',
                    'edit_url' => '/recipes/3/edit',
                ],
                [
                    'id' => 4,
                    'code' => '#0004',
                    'name' => '黑豆漿',
                    'description' => '營養黑豆漿配方',
                    'image_url' => null,
                    'version_count' => 2,
                    'latest_version' => 'v2',
                    'updated_at' => '2024-02-20',
                    'view_url' => '/recipes/4',
                    'versions_url' => '/recipes/4/versions',
                    'edit_url' => '/recipes/4/edit',
                ],
                [
                    'id' => 5,
                    'code' => '#0005',
                    'name' => '薏仁湯',
                    'description' => '養生薏仁湯配方',
                    'image_url' => null,
                    'version_count' => 4,
                    'latest_version' => 'v4',
                    'updated_at' => '2024-03-28',
                    'view_url' => '/recipes/5',
                    'versions_url' => '/recipes/5/versions',
                    'edit_url' => '/recipes/5/edit',
                ],
            ];
            @endphp

            <x-recipes.recipe-list-table :recipes="$recipes" />

        </div>
    </div>
</div>

{{-- 返回頂部按鈕 --}}
<x-scroll-to-top />

@endsection
