@extends('layouts.app')

@section('title', '建立配方')

@section('content')
{{-- Page Header --}}
<x-recipes.page-header title="建立配方">
    <x-slot name="breadcrumb">
        <x-recipes.breadcrumb :items="[
            ['label' => '研發模組', 'url' => '/'],
            ['label' => '配方單管理', 'url' => '/recipes'],
            ['label' => '建立配方'],
        ]" />
    </x-slot>
    <x-slot name="actions">
        <div class="hidden sm:flex items-center gap-3">
            <x-recipes.button variant="secondary" size="md">
                取消
            </x-recipes.button>
            <x-recipes.button variant="primary" type="submit" form="recipe-form" size="md">
                儲存版本
            </x-recipes.button>
        </div>
    </x-slot>
</x-recipes.page-header>

{{-- Success/Error Alert (條件式顯示) --}}
@if(session('success'))
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 mt-6">
        <x-recipes.alert
            type="success"
            :title="session('success')"
        />
    </div>
@endif

@if(session('error'))
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 mt-6">
        <x-recipes.alert
            type="error"
            :title="session('error')"
            :dismissible="false"
        />
    </div>
@endif

{{-- Main Content --}}
<div class="min-h-screen bg-gradient-to-br from-gray-50 via-gray-50 to-indigo-50/20 pb-20 sm:pb-12">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-6 sm:py-12">
        <form id="recipe-form" action="/recipes" method="POST" enctype="multipart/form-data" class="space-y-4 sm:space-y-8">
        @csrf

        {{-- 【配方主檔資訊】 --}}
        <div class="group bg-white rounded-xl border border-gray-200 shadow-md hover:shadow-lg transition-shadow duration-200 overflow-hidden">
            <div class="border-l-4 border-indigo-500">
                <div class="px-6 py-5 bg-gradient-to-r from-indigo-50/50 to-transparent border-b border-gray-100">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-lg flex items-center justify-center shadow-sm">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-lg font-semibold text-gray-900">配方主檔資訊</h2>
                            <p class="mt-0.5 text-sm text-gray-600">建立配方的基本識別資訊</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="px-6 py-6">
                <div class="space-y-6">
                    {{-- 配方名稱 --}}
                    <div>
                        <x-recipes.form-field
                            label="配方名稱"
                            name="recipe_name"
                            :required="true"
                            placeholder="請輸入配方名稱（例如：紅豆湯、糙米粥）"
                            helpText="最多 100 字元"
                            :error="$errors->first('recipe_name')"
                        />
                    </div>

                    {{-- 配方說明 --}}
                    <div>
                        <x-recipes.textarea-field
                            label="配方說明"
                            name="recipe_description"
                            :rows="4"
                            placeholder="說明配方用途、特色等資訊"
                            cornerHint="選填"
                            :maxlength="200"
                        />
                    </div>

                    {{-- 配方主圖照片 --}}
                    <div>
                        <x-recipes.image-upload
                            name="recipe_main_photo"
                            label="配方主圖照片"
                            helpText="用於快速識別此配方"
                            formats="PNG, JPG"
                            maxSize="5MB"
                        />
                    </div>
                </div>
            </div>
        </div>

        {{-- 【版本資訊】 --}}
        <div class="group bg-white rounded-xl border border-gray-200 shadow-md hover:shadow-lg transition-shadow duration-200 overflow-hidden">
            <div class="border-l-4 border-purple-500">
                <div class="px-6 py-5 bg-gradient-to-r from-purple-50/50 to-transparent border-b border-gray-100">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-gradient-to-br from-purple-500 to-purple-600 rounded-lg flex items-center justify-center shadow-sm">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-lg font-semibold text-gray-900">版本資訊</h2>
                            <p class="mt-0.5 text-sm text-gray-600">此配方版本的詳細資訊</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="px-6 py-6">
                <div class="space-y-6">
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                        {{-- 版本名稱 --}}
                        <div>
                            <x-recipes.form-field
                                label="版本名稱"
                                name="version_name"
                                :required="true"
                                placeholder="請輸入版本名稱"
                                helpText="系統自動編號"
                                :error="$errors->first('version_name')"
                            />
                        </div>

                        {{-- 版本標籤 --}}
                        <div>
                            <x-recipes.form-field
                                label="版本標籤"
                                name="version_label"
                                :required="true"
                                placeholder="例如：傳統版、低糖版、速煮版"
                                helpText="最多 50 字元"
                                :error="$errors->first('version_label')"
                            />
                        </div>
                    </div>

                    {{-- 建立日期 --}}
                    <div>
                        <x-recipes.form-field
                            label="建立日期"
                            name="created_date"
                            type="date"
                            value="{{ date('Y-m-d') }}"
                            cornerHint="選填"
                        />
                    </div>

                    {{-- 研發目的 --}}
                    <div>
                        <x-recipes.textarea-field
                            label="研發目的"
                            name="purpose"
                            :required="true"
                            :rows="4"
                            placeholder="說明此版本的研發目的"
                            :maxlength="200"
                            cornerHint="最多200字"
                            :error="$errors->first('purpose')"
                        />
                    </div>

                    {{-- 條件說明 --}}
                    <div>
                        <x-recipes.textarea-field
                            label="條件說明"
                            name="conditions"
                            :rows="4"
                            placeholder="記錄殺菌條件、客戶需求等"
                            :maxlength="200"
                            cornerHint="選填"
                        />
                    </div>
                </div>
            </div>
        </div>

        {{-- 【測量數據】 --}}
        <div class="group bg-white rounded-xl border border-gray-200 shadow-md hover:shadow-lg transition-shadow duration-200 overflow-hidden">
            <div class="border-l-4 border-blue-500">
                <div class="px-6 py-5 bg-gradient-to-r from-blue-50/50 to-transparent border-b border-gray-100">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg flex items-center justify-center shadow-sm">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-lg font-semibold text-gray-900">測量數據</h2>
                            <p class="mt-0.5 text-sm text-gray-600">配方的相關測量數據</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="px-6 py-6">
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
                    {{-- PH 值 --}}
                    <div>
                        <x-recipes.form-field
                            label="PH 值"
                            name="ph_value"
                            type="number"
                            step="0.1"
                            placeholder="6.5"
                            cornerHint="選填"
                            helpText="範圍 0-14"
                        />
                    </div>

                    {{-- Brix 糖度 --}}
                    <div>
                        <x-recipes.form-field
                            label="Brix 糖度"
                            name="brix"
                            type="number"
                            step="0.1"
                            placeholder="15"
                            suffix="°Bx"
                            cornerHint="選填"
                        />
                    </div>

                    {{-- 樣品數 --}}
                    <div>
                        <x-recipes.form-field
                            label="樣品數"
                            name="sample_count"
                            type="number"
                            placeholder="10"
                            cornerHint="選填"
                        />
                    </div>

                    {{-- 樣品單位 --}}
                    <div>
                        <x-recipes.select-field
                            label="樣品單位"
                            name="sample_unit"
                            :options="[
                                'can' => '罐',
                                'cup' => '杯',
                                'bag' => '袋',
                                'bowl' => '碗'
                            ]"
                            cornerHint="選填"
                        />
                    </div>
                </div>
            </div>
        </div>

        {{-- 【配方項目】 --}}
        <div class="group bg-white rounded-xl border border-gray-200 shadow-md hover:shadow-lg transition-shadow duration-200 overflow-hidden">
            <div class="border-l-4 border-rose-500">
                <div class="px-6 py-5 bg-gradient-to-r from-rose-50/50 to-transparent border-b border-gray-100">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-gradient-to-br from-rose-500 to-rose-600 rounded-lg flex items-center justify-center shadow-sm">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                            </svg>
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center gap-2">
                                <h2 class="text-lg font-semibold text-gray-900">配方項目</h2>
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-red-100 text-red-800">必填</span>
                            </div>
                            <p class="mt-0.5 text-sm text-gray-600">至少需要一個項目，百分比總和建議為 100%</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="px-6 py-6">
                @php
                $sampleItems = old('items', [
                    ['name' => '', 'percentage' => '', 'weight' => '', 'baking_time' => ''],
                ]);
                @endphp
                <x-recipes.item-table :items="$sampleItems" />
            </div>
        </div>

        {{-- 【穀物專用資訊】 --}}
        <div class="group bg-white rounded-xl border border-gray-200 shadow-md hover:shadow-lg transition-shadow duration-200 overflow-hidden">
            <div class="border-l-4 border-amber-500">
                <div class="px-6 py-5 bg-gradient-to-r from-amber-50/50 to-transparent border-b border-gray-100">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-gradient-to-br from-amber-500 to-amber-600 rounded-lg flex items-center justify-center shadow-sm">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-lg font-semibold text-gray-900">穀物專用資訊</h2>
                            <p class="mt-0.5 text-sm text-gray-600">適用於穀物類產品（選填區塊）</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="px-6 py-6">
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                    {{-- 洗豆時間 --}}
                    <div>
                        <x-recipes.form-field
                            label="洗豆時間"
                            name="bean_wash_time"
                            type="number"
                            placeholder="30"
                            suffix="分鐘"
                            cornerHint="選填"
                        />
                    </div>

                    {{-- 洗豆水量 --}}
                    <div>
                        <x-recipes.form-field
                            label="洗豆水量"
                            name="bean_wash_water"
                            type="number"
                            placeholder="500"
                            suffix="ml"
                            cornerHint="選填"
                        />
                    </div>

                    {{-- 每包投料量 --}}
                    <div>
                        <x-recipes.form-field
                            label="每包投料量"
                            name="package_weight"
                            type="number"
                            placeholder="1000"
                            suffix="g"
                            cornerHint="選填"
                        />
                    </div>

                    {{-- 膨脹率 --}}
                    <div>
                        <x-recipes.form-field
                            label="膨脹率"
                            name="expansion_rate"
                            type="number"
                            step="0.1"
                            placeholder="2.5"
                            suffix="倍"
                            cornerHint="選填"
                        />
                    </div>
                </div>
            </div>
        </div>

        {{-- 【照片與備註】 --}}
        <div class="group bg-white rounded-xl border border-gray-200 shadow-md hover:shadow-lg transition-shadow duration-200 overflow-hidden">
            <div class="border-l-4 border-emerald-500">
                <div class="px-6 py-5 bg-gradient-to-r from-emerald-50/50 to-transparent border-b border-gray-100">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-lg flex items-center justify-center shadow-sm">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-lg font-semibold text-gray-900">照片與備註</h2>
                            <p class="mt-0.5 text-sm text-gray-600">上傳照片和記錄重要注意事項</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="px-6 py-6">
                <div class="space-y-6">
                    {{-- 上傳照片 --}}
                    <div>
                        <x-recipes.image-upload
                            name="photos[]"
                            label="上傳照片"
                            helpText="支援多張上傳"
                            formats="PNG, JPG"
                            maxSize="5MB"
                        />
                    </div>

                    {{-- 注意事項 --}}
                    <div>
                        <x-recipes.textarea-field
                            label="注意事項"
                            name="notes"
                            :rows="6"
                            placeholder="記錄重要注意事項"
                            :maxlength="500"
                            cornerHint="選填"
                        />
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

{{-- 手機版固定底部按鈕列 --}}
<x-recipes.mobile-action-bar
    cancelUrl="/recipes"
    cancelText="取消"
    submitText="儲存版本"
    submitForm="recipe-form"
/>

{{-- 返回頂部按鈕 --}}
<x-scroll-to-top />

@endsection
