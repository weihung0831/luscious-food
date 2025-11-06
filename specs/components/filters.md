# Filter Components (篩選相關元件)

**文件說明**: 本文件包含所有篩選相關的 Blade 元件規格
**元件數量**: 1 個
**最後更新**: 2025-11-06

---

## 元件清單

1. [filter-panel](#1-filter-panel) - 篩選面板

---

### 16. filter-panel (篩選面板)

**檔案位置**: `resources/views/recipes/components/filter-panel.blade.php`

**說明**: 基於 Tailwind UI - Application UI > Forms > Form Layouts 設計,用於 index.blade.php 和 version-history.blade.php 的篩選面板,提供搜尋、篩選、排序功能

**Props**:
```php
@props([
    'action' => '',              // 表單提交路徑
    'method' => 'GET',           // 請求方法 (GET/POST)
    'searchPlaceholder' => '搜尋...', // 搜尋框佔位文字
    'searchValue' => '',         // 搜尋關鍵字預設值
    'statusOptions' => [],       // 狀態選項 [['value' => 'draft', 'label' => '草稿'], ...]
    'statusValue' => '',         // 狀態預設值
    'sortOptions' => [],         // 排序選項
    'sortValue' => '',           // 排序預設值
    'dateFrom' => '',            // 開始日期
    'dateTo' => '',              // 結束日期
    'showAdvanced' => false,     // 是否顯示進階篩選區
])
```

**完整程式碼**:
```blade
@props([
    'action' => '',
    'method' => 'GET',
    'searchPlaceholder' => '搜尋...',
    'searchValue' => '',
    'statusOptions' => [],
    'statusValue' => '',
    'sortOptions' => [],
    'sortValue' => '',
    'dateFrom' => '',
    'dateTo' => '',
    'showAdvanced' => false,
])

<div class="bg-white shadow-sm outline-1 outline-black/5 rounded-lg">
    <form action="{{ $action }}" method="{{ $method }}" class="p-6">
        @if($method === 'POST')
            @csrf
        @endif

        {{-- 基礎篩選區 --}}
        <div class="grid grid-cols-1 gap-x-6 gap-y-4 sm:grid-cols-6">
            {{-- 搜尋框 --}}
            <div class="sm:col-span-3">
                <label for="search" class="block text-sm/6 font-medium text-gray-900">關鍵字搜尋</label>
                <div class="mt-2">
                    <div class="grid grid-cols-1">
                        <input
                            type="text"
                            name="search"
                            id="search"
                            value="{{ $searchValue }}"
                            placeholder="{{ $searchPlaceholder }}"
                            class="col-start-1 row-start-1 block w-full rounded-md bg-white py-1.5 pr-10 pl-3 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:pl-9 sm:text-sm/6"
                        />
                        {{-- 搜尋圖示 --}}
                        <svg
                            viewBox="0 0 20 20"
                            fill="currentColor"
                            aria-hidden="true"
                            data-slot="icon"
                            class="pointer-events-none col-start-1 row-start-1 ml-3 size-5 self-center text-gray-400 sm:size-4"
                        >
                            <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 1 0 0 11 5.5 5.5 0 0 0 0-11ZM2 9a7 7 0 1 1 12.452 4.391l3.328 3.329a.75.75 0 1 1-1.06 1.06l-3.329-3.328A7 7 0 0 1 2 9Z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
            </div>

            {{-- 狀態篩選 --}}
            @if(count($statusOptions) > 0)
                <div class="sm:col-span-2">
                    <x-recipes.select-field
                        label="狀態"
                        name="status"
                        :value="$statusValue"
                        :options="$statusOptions"
                        placeholder="全部狀態"
                    />
                </div>
            @endif

            {{-- 排序選項 --}}
            @if(count($sortOptions) > 0)
                <div class="sm:col-span-1">
                    <x-recipes.select-field
                        label="排序"
                        name="sort"
                        :value="$sortValue"
                        :options="$sortOptions"
                        placeholder="預設排序"
                    />
                </div>
            @endif
        </div>

        {{-- 進階篩選區 (可選) --}}
        @if($showAdvanced)
            <div class="mt-6 border-t border-gray-200 pt-6">
                <h3 class="mb-4 text-sm font-semibold text-gray-900">進階篩選</h3>
                <div class="grid grid-cols-1 gap-x-6 gap-y-4 sm:grid-cols-6">
                    {{-- 日期範圍 --}}
                    <div class="sm:col-span-3">
                        <x-recipes.form-field
                            label="建立日期（起）"
                            name="date_from"
                            type="date"
                            :value="$dateFrom"
                        />
                    </div>

                    <div class="sm:col-span-3">
                        <x-recipes.form-field
                            label="建立日期（迄）"
                            name="date_to"
                            type="date"
                            :value="$dateTo"
                        />
                    </div>

                    {{-- 自訂插槽：其他進階篩選欄位 --}}
                    {{ $advanced ?? '' }}
                </div>
            </div>
        @endif

        {{-- 操作按鈕區 --}}
        <div class="mt-6 flex items-center justify-end gap-x-3">
            {{-- 重置按鈕 --}}
            <x-recipes.button
                type="button"
                variant="secondary"
                size="md"
                onclick="window.location.href='{{ $action }}'"
            >
                重置
            </x-recipes.button>

            {{-- 套用篩選按鈕 --}}
            <x-recipes.button
                type="submit"
                variant="primary"
                size="md"
            >
                <svg viewBox="0 0 20 20" fill="currentColor" data-slot="icon" aria-hidden="true" class="-ml-0.5 size-5">
                    <path fill-rule="evenodd" d="M2.628 1.601C5.028 1.206 7.49 1 10 1s4.973.206 7.372.601a.75.75 0 0 1 .628.74v2.288a2.25 2.25 0 0 1-.659 1.59l-4.682 4.683a2.25 2.25 0 0 0-.659 1.59v3.037c0 .684-.31 1.33-.844 1.757l-1.937 1.55A.75.75 0 0 1 8 18.25v-5.757a2.25 2.25 0 0 0-.659-1.591L2.659 6.22A2.25 2.25 0 0 1 2 4.629V2.34a.75.75 0 0 1 .628-.74Z" clip-rule="evenodd" />
                </svg>
                套用篩選
            </x-recipes.button>
        </div>
    </form>
</div>
```

**使用範例**:

```blade
{{-- 1. 配方列表頁面 (index.blade.php) - 基本篩選 --}}
@php
$statusOptions = [
    ['value' => 'draft', 'label' => '草稿'],
    ['value' => 'active', 'label' => '使用中'],
    ['value' => 'archived', 'label' => '已封存'],
];

$sortOptions = [
    ['value' => 'created_at_desc', 'label' => '建立時間 (新→舊)'],
    ['value' => 'created_at_asc', 'label' => '建立時間 (舊→新)'],
    ['value' => 'name_asc', 'label' => '名稱 (A→Z)'],
    ['value' => 'name_desc', 'label' => '名稱 (Z→A)'],
];
@endphp

<x-recipes.page-header
    title="配方列表"
    subtitle="管理所有配方主檔"
>
    <x-recipes.button variant="primary" :href="route('recipes.create')">
        新增配方
    </x-recipes.button>
</x-recipes.page-header>

{{-- 篩選面板 --}}
<div class="mb-6">
    <x-recipes.filter-panel
        :action="route('recipes.index')"
        searchPlaceholder="搜尋配方名稱或編號..."
        :searchValue="request('search')"
        :statusOptions="$statusOptions"
        :statusValue="request('status')"
        :sortOptions="$sortOptions"
        :sortValue="request('sort')"
    />
</div>

{{-- 配方列表 --}}
<x-recipes.recipe-list-table :recipes="$recipes" />

{{-- 2. 版本歷史頁面 (version-history.blade.php) - 含進階篩選 --}}
@php
$sortOptions = [
    ['value' => 'version_desc', 'label' => '版本號 (新→舊)'],
    ['value' => 'version_asc', 'label' => '版本號 (舊→新)'],
    ['value' => 'created_at_desc', 'label' => '建立時間 (新→舊)'],
    ['value' => 'created_at_asc', 'label' => '建立時間 (舊→新)'],
];
@endphp

<x-recipes.page-header
    title="版本歷史"
    :subtitle="$recipe['name'] . ' (' . $recipe['code'] . ')'"
>
    <x-recipes.button variant="primary" :href="route('recipes.versions.create', $recipe['id'])">
        新增版本
    </x-recipes.button>
</x-recipes.page-header>

{{-- 篩選面板 (含進階篩選) --}}
<div class="mb-6">
    <x-recipes.filter-panel
        :action="route('recipes.versions', $recipe['id'])"
        searchPlaceholder="搜尋版本名稱或研發目的..."
        :searchValue="request('search')"
        :sortOptions="$sortOptions"
        :sortValue="request('sort')"
        :showAdvanced="true"
        :dateFrom="request('date_from')"
        :dateTo="request('date_to')"
    >
        {{-- 進階篩選的自訂欄位 --}}
        <x-slot name="advanced">
            {{-- PH 值範圍 --}}
            <div class="sm:col-span-3">
                <x-recipes.form-field
                    label="PH 值（最小）"
                    name="ph_min"
                    type="number"
                    step="0.1"
                    min="0"
                    max="14"
                    :value="request('ph_min')"
                    placeholder="0.0"
                />
            </div>

            <div class="sm:col-span-3">
                <x-recipes.form-field
                    label="PH 值（最大）"
                    name="ph_max"
                    type="number"
                    step="0.1"
                    min="0"
                    max="14"
                    :value="request('ph_max')"
                    placeholder="14.0"
                />
            </div>

            {{-- Brix 糖度範圍 --}}
            <div class="sm:col-span-3">
                <x-recipes.form-field
                    label="糖度（最小）"
                    name="brix_min"
                    type="number"
                    step="0.1"
                    :value="request('brix_min')"
                    suffix="°Bx"
                    placeholder="0.0"
                />
            </div>

            <div class="sm:col-span-3">
                <x-recipes.form-field
                    label="糖度（最大）"
                    name="brix_max"
                    type="number"
                    step="0.1"
                    :value="request('brix_max')"
                    suffix="°Bx"
                    placeholder="100.0"
                />
            </div>
        </x-slot>
    </x-recipes.filter-panel>
</div>

{{-- 版本歷史列表 --}}
<x-recipes.version-history-table :versions="$versions" />

{{-- 3. 簡化版篩選面板 (僅搜尋框) --}}
<x-recipes.filter-panel
    :action="route('recipes.index')"
    searchPlaceholder="快速搜尋配方..."
    :searchValue="request('search')"
/>
```

**設計說明**:

- **整合元件**: 使用 `select-field` 和 `form-field` 基礎元件構建篩選欄位
- **搜尋框設計**: 使用 Tailwind UI 的搜尋圖示樣式,提供視覺提示
- **響應式佈局**: 使用 `sm:grid-cols-6` 在桌面顯示多欄,行動裝置自動堆疊
- **進階篩選**: 使用 `showAdvanced` 開關控制是否顯示進階篩選區
- **自訂插槽**: 透過 `$advanced` slot 允許頁面自訂額外的進階篩選欄位
- **重置功能**: 重置按鈕導向原始 action URL (清除所有參數)
- **套用篩選**: 提交表單,使用 GET 方法讓 URL 包含篩選參數,方便分享和書籤
- **視覺層次**: 使用邊框和間距區分基礎篩選和進階篩選區域

**使用情境**:
1. **配方列表**: 按狀態、名稱、建立時間篩選
2. **版本歷史**: 按版本號、PH 值、Brix 糖度範圍篩選
3. **快速搜尋**: 僅使用搜尋框的簡化模式


---

**返回**: [元件總覽](../components.md)
