# Table Components (表格相關元件)

**文件說明**: 本文件包含所有表格相關的 Blade 元件規格
**元件數量**: 3 個
**最後更新**: 2025-11-06

---

## 元件清單

1. [item-table](#1-item-table) - 項目清單動態表格
2. [recipe-list-table](#2-recipe-list-table) - 配方列表表格
3. [version-history-table](#3-version-history-table) - 版本歷史表格

---

### 13. item-table (項目清單動態表格)

**檔案位置**: `resources/views/recipes/components/item-table.blade.php`

**說明**: 基於 Tailwind UI - Application UI > Lists > Tables 設計,用於配方表單中的項目清單管理

**Props**:
```php
@props([
    'items' => [],               // 項目陣列
    'showTotal' => true,         // 是否顯示百分比總和
    'editable' => true,          // 是否可編輯 (新增/刪除行)
])
```

**完整程式碼**:
```blade
@props([
    'items' => [],
    'showTotal' => true,
    'editable' => true,
])

@php
// 計算百分比總和
$percentageTotal = collect($items)->sum('percentage');
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

    {{-- 表格容器 --}}
    <div class="flow-root">
        <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                <div class="overflow-hidden shadow-sm outline-1 outline-black/5 sm:rounded-lg">
                    <table class="relative min-w-full divide-y divide-gray-300">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="py-3.5 pr-3 pl-4 text-left text-sm font-semibold text-gray-900 sm:pl-6">項目名稱</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">百分比 (%)</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">克數 (g)</th>
                                @if($editable)
                                    <th scope="col" class="py-3.5 pr-4 pl-3 sm:pr-6">
                                        <span class="sr-only">操作</span>
                                    </th>
                                @endif
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                            @forelse($items as $index => $item)
                                <tr>
                                    {{-- 項目名稱 --}}
                                    <td class="py-4 pr-3 pl-4 text-sm whitespace-nowrap sm:pl-6">
                                        @if($editable)
                                            <input
                                                type="text"
                                                name="items[{{ $index }}][name]"
                                                value="{{ $item['name'] ?? '' }}"
                                                placeholder="請輸入項目名稱"
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-xs ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6"
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
                                                class="block w-24 rounded-md border-0 py-1.5 text-gray-900 shadow-xs ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6"
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
                                                class="block w-24 rounded-md border-0 py-1.5 text-gray-900 shadow-xs ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6"
                                            />
                                        @else
                                            <span class="text-gray-500">{{ number_format($item['weight'] ?? 0, 2) }} g</span>
                                        @endif
                                    </td>

                                    {{-- 操作欄 --}}
                                    @if($editable)
                                        <td class="py-4 pr-4 pl-3 text-right text-sm font-medium whitespace-nowrap sm:pr-6">
                                            {{-- TODO: 使用 Alpine.js 實作刪除項目功能 --}}
                                            <button type="button" class="text-red-600 hover:text-red-900">
                                                刪除<span class="sr-only">, {{ $item['name'] ?? '項目' }}</span>
                                            </button>
                                        </td>
                                    @endif
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="{{ $editable ? 5 : 4 }}" class="px-3 py-8 text-center text-sm text-gray-500">
                                        尚無項目,請點擊「新增項目」按鈕新增
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
```

**使用範例**:

```blade
{{-- 1. 可編輯模式 (配方建立/編輯表單) --}}
@php
$items = [
    ['name' => '高筋麵粉', 'percentage' => 45.5, 'weight' => 500, 'baking_time' => '15'],
    ['name' => '低筋麵粉', 'percentage' => 30.0, 'weight' => 330, 'baking_time' => '15'],
    ['name' => '可可粉', 'percentage' => 15.5, 'weight' => 170, 'baking_time' => '15'],
    ['name' => '糖', 'percentage' => 9.0, 'weight' => 100, 'baking_time' => '-'],
];
@endphp

<form action="/recipes" method="POST">
    @csrf

    {{-- 其他表單欄位... --}}

    <div class="col-span-full">
        <x-recipes.item-table :items="$items" />
    </div>

    <div class="mt-6">
        <x-recipes.button variant="primary" type="submit" size="lg">
            提交審核
        </x-recipes.button>
    </div>
</form>

{{-- 2. 唯讀模式 (配方詳情頁面) --}}
<x-recipes.item-table
    :items="$recipe->items"
    :editable="false"
/>

{{-- 3. 空狀態 (新建配方) --}}
<x-recipes.item-table :items="[]" />

{{-- 4. 隱藏百分比總和 --}}
<x-recipes.item-table
    :items="$items"
    :showTotal="false"
/>

{{-- 5. 完整配方表單範例 --}}
@php
$sampleItems = [
    ['name' => '巧克力', 'percentage' => 40, 'weight' => 200, 'baking_time' => '10'],
    ['name' => '奶油', 'percentage' => 30, 'weight' => 150, 'baking_time' => '-'],
    ['name' => '糖', 'percentage' => 20, 'weight' => 100, 'baking_time' => '-'],
    ['name' => '雞蛋', 'percentage' => 10, 'weight' => 50, 'baking_time' => '-'],
];
@endphp

<div class="space-y-6">
    <x-recipes.form-field
        label="配方名稱"
        name="recipe_name"
        :required="true"
        placeholder="請輸入配方名稱"
    />

    <x-recipes.form-field
        label="建立日期"
        name="created_date"
        type="date"
        :required="true"
    />

    <x-recipes.item-table :items="$sampleItems" />

    <x-recipes.textarea-field
        label="注意事項"
        name="notes"
        :required="true"
        :rows="4"
    />
</div>
```

**設計說明**:

- **雙模式支援**: `editable` prop 控制是否為編輯模式(表單中使用)或唯讀模式(詳情頁使用)
- **動態表格結構**: 表頭 + 可滾動的表格內容,使用 Tailwind UI 的 shadow 和 rounded 樣式
- **內嵌輸入欄位**: 編輯模式下,每個儲存格都是獨立的 input 欄位,name 使用陣列格式 `items[0][name]`
- **百分比驗證**: 自動計算百分比總和,若非 100% 則顯示黃色警告圖示和提示
- **空狀態處理**: 當 items 陣列為空時,顯示友善的提示訊息
- **無障礙支援**: 使用 `<th scope="col">` 和 `sr-only` 提供螢幕閱讀器支援
- **響應式設計**: 使用 `overflow-x-auto` 確保小螢幕上可以水平滾動查看完整表格
- **TODO 標記**: 新增/刪除項目功能使用註解標記,待後續使用 Alpine.js 實作

**數值格式**:
- 百分比支援小數點兩位 (0.01 精度)
- 克數支援小數點兩位

---

### 14. recipe-list-table (配方列表表格)

**檔案位置**: `resources/views/recipes/components/recipe-list-table.blade.php`

**說明**: 基於 Tailwind UI - Application UI > Lists > Tables 設計,用於配方列表頁面 (index.blade.php) 顯示配方主檔列表

**Props**:
```php
@props([
    'recipes' => [],             // 配方主檔陣列
    'showCheckbox' => true,      // 是否顯示多選框
    'emptyMessage' => '尚無配方資料',
])
```

**完整程式碼**:
```blade
@props([
    'recipes' => [],
    'showCheckbox' => true,
    'emptyMessage' => '尚無配方資料',
])

<div class="flow-root">
    <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm outline-1 outline-black/5 sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-300">
                    <thead class="bg-gray-50">
                        <tr>
                            @if($showCheckbox)
                                <th scope="col" class="py-3.5 pr-3 pl-4 sm:pl-6">
                                    <input
                                        type="checkbox"
                                        class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-600 size-4"
                                        aria-label="全選"
                                    />
                                </th>
                            @endif
                            <th scope="col" class="py-3.5 pr-3 pl-4 text-left text-sm font-semibold text-gray-900 sm:pl-6">#編號</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">配方名稱</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">版本</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">建立時間</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">狀態</th>
                            <th scope="col" class="py-3.5 pr-4 pl-3 sm:pr-6">
                                <span class="sr-only">操作</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                        @forelse($recipes as $recipe)
                            <tr>
                                {{-- 多選框 --}}
                                @if($showCheckbox)
                                    <td class="py-4 pr-3 pl-4 sm:pl-6">
                                        <input
                                            type="checkbox"
                                            name="selected_recipes[]"
                                            value="{{ $recipe['id'] }}"
                                            class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-600 size-4"
                                            aria-label="選取 {{ $recipe['name'] }}"
                                        />
                                    </td>
                                @endif

                                {{-- #編號 --}}
                                <td class="py-4 pr-3 pl-4 text-sm font-medium text-gray-900 whitespace-nowrap sm:pl-6">
                                    {{ $recipe['code'] ?? '#0000' }}
                                </td>

                                {{-- 配方名稱 --}}
                                <td class="px-3 py-4 text-sm">
                                    <div class="flex items-center gap-x-3">
                                        {{-- 配方主圖縮圖 (如果有) --}}
                                        @if(!empty($recipe['image_url']))
                                            <img
                                                src="{{ $recipe['image_url'] }}"
                                                alt="{{ $recipe['name'] }}"
                                                class="rounded-md size-10 object-cover"
                                            />
                                        @endif
                                        <div>
                                            <div class="font-medium text-gray-900">{{ $recipe['name'] }}</div>
                                            @if(!empty($recipe['description']))
                                                <div class="mt-1 text-gray-500">{{ $recipe['description'] }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </td>

                                {{-- 版本號 --}}
                                <td class="px-3 py-4 text-sm whitespace-nowrap">
                                    <x-recipes.version-badge :version="$recipe['latest_version'] ?? 'v1'" />
                                </td>

                                {{-- 建立時間 --}}
                                <td class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap">
                                    {{ $recipe['created_at'] ?? '-' }}
                                </td>

                                {{-- 狀態 --}}
                                <td class="px-3 py-4 text-sm whitespace-nowrap">
                                    <x-recipes.status-badge
                                        :status="$recipe['status'] ?? 'draft'"
                                        :label="$recipe['status_label'] ?? '草稿'"
                                    />
                                </td>

                                {{-- 操作按鈕 --}}
                                <td class="py-4 pr-4 pl-3 text-sm font-medium whitespace-nowrap text-center sm:pr-6">
                                    <x-recipes.action-buttons
                                        :viewUrl="$recipe['view_url'] ?? '#'"
                                        :editUrl="$recipe['edit_url'] ?? '#'"
                                        :deleteId="$recipe['id']"
                                        :deleteName="$recipe['name']"
                                    />
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="{{ $showCheckbox ? 7 : 6 }}" class="px-3 py-8 text-center text-sm text-gray-500">
                                    {{ $emptyMessage }}
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
```

**使用範例**:

```blade
{{-- 1. 配方列表頁面 (index.blade.php) --}}
@php
$recipes = [
    [
        'id' => 1,
        'code' => '#0001',
        'name' => '紅豆湯',
        'description' => '傳統配方',
        'image_url' => '/storage/recipes/red-bean-soup.jpg',
        'latest_version' => 'v3',
        'created_at' => '2025-11-01',
        'status' => 'active',
        'status_label' => '使用中',
        'view_url' => route('recipes.show', 1),
        'versions_url' => route('recipes.versions', 1),
        'edit_url' => route('recipes.edit', 1),
    ],
    [
        'id' => 2,
        'code' => '#0002',
        'name' => '糙米粥',
        'description' => '健康養生配方',
        'image_url' => null,
        'latest_version' => 'v1',
        'created_at' => '2025-11-05',
        'status' => 'draft',
        'status_label' => '草稿',
        'view_url' => route('recipes.show', 2),
        'versions_url' => route('recipes.versions', 2),
        'edit_url' => route('recipes.edit', 2),
    ],
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

{{-- 配方列表表格 --}}
<x-recipes.recipe-list-table :recipes="$recipes" />

{{-- 2. 不顯示多選框 --}}
<x-recipes.recipe-list-table :recipes="$recipes" :showCheckbox="false" />

{{-- 3. 自訂空白訊息 --}}
<x-recipes.recipe-list-table
    :recipes="[]"
    emptyMessage="目前沒有任何配方,請點擊「新增配方」開始建立"
/>
```

**設計說明**:

- **整合元件**:
  - 使用 `status-badge` 顯示配方狀態
  - 使用 `version-badge` 顯示最新版本號
  - 使用 `action-buttons` 元件提供操作按鈕（檢視、編輯、刪除）
- **配方主圖**: 如果有主圖則顯示縮圖（10x10），沒有則只顯示文字
- **操作按鈕**: 使用 `action-buttons` 元件，提供圖示化的檢視、編輯、刪除按鈕
- **多選功能**: 支援批次操作（如批次刪除、批次匯出）
- **響應式**: 使用 `-mx-4 sm:-mx-6 lg:-mx-8` 確保在不同尺寸下的良好顯示
- **無障礙**: 提供 `sr-only` 給螢幕閱讀器,標示每個操作的對象

---

### 15. version-history-table (版本歷史表格)

**檔案位置**: `resources/views/recipes/components/version-history-table.blade.php`

**說明**: 基於 Tailwind UI - Application UI > Lists > Tables 設計,用於版本歷史頁面 (version-history.blade.php) 顯示單一配方的所有版本

**Props**:
```php
@props([
    'versions' => [],            // 版本陣列
    'showCheckbox' => true,      // 是否顯示多選框
    'emptyMessage' => '尚無版本資料',
])
```

**完整程式碼**:
```blade
@props([
    'versions' => [],
    'showCheckbox' => true,
    'emptyMessage' => '尚無版本資料',
])

<div class="flow-root">
    <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm outline-1 outline-black/5 sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-300">
                    <thead class="bg-gray-50">
                        <tr>
                            @if($showCheckbox)
                                <th scope="col" class="py-3.5 pr-3 pl-4 sm:pl-6">
                                    <input
                                        type="checkbox"
                                        class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-600 size-4"
                                        aria-label="全選"
                                    />
                                </th>
                            @endif
                            <th scope="col" class="py-3.5 pr-3 pl-4 text-left text-sm font-semibold text-gray-900 sm:pl-6">版本</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">版本名稱</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">建立日期</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">研發目的</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">樣品數</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">PH 值</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">糖度</th>
                            <th scope="col" class="py-3.5 pr-4 pl-3 sm:pr-6">
                                <span class="sr-only">操作</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                        @forelse($versions as $version)
                            <tr>
                                {{-- 多選框 --}}
                                @if($showCheckbox)
                                    <td class="py-4 pr-3 pl-4 sm:pl-6">
                                        <input
                                            type="checkbox"
                                            name="selected_versions[]"
                                            value="{{ $version['id'] }}"
                                            class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-600 size-4"
                                            aria-label="選取版本 {{ $version['version_name'] }}"
                                        />
                                    </td>
                                @endif

                                {{-- 版本 --}}
                                <td class="py-4 pr-3 pl-4 text-sm whitespace-nowrap sm:pl-6">
                                    <x-recipes.version-badge :version="$version['version_name'] ?? 'v1'" />
                                </td>

                                {{-- 版本名稱 --}}
                                <td class="px-3 py-4 text-sm">
                                    <div class="font-medium text-gray-900">{{ $version['version_label'] ?? '-' }}</div>
                                </td>

                                {{-- 建立日期 --}}
                                <td class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap">
                                    {{ $version['created_at'] ?? '-' }}
                                </td>

                                {{-- 研發目的 --}}
                                <td class="px-3 py-4 text-sm text-gray-900">
                                    <div class="max-w-xs truncate" title="{{ $version['purpose'] ?? '-' }}">
                                        {{ $version['purpose'] ?? '-' }}
                                    </div>
                                </td>

                                {{-- 樣品數 --}}
                                <td class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap">
                                    @if(!empty($version['sample_quantity']) && !empty($version['sample_unit']))
                                        {{ $version['sample_quantity'] }} {{ $version['sample_unit'] }}
                                    @else
                                        -
                                    @endif
                                </td>

                                {{-- PH 值 --}}
                                <td class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap">
                                    {{ $version['ph_value'] ?? '-' }}
                                </td>

                                {{-- 糖度 (Brix) --}}
                                <td class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap">
                                    @if(!empty($version['brix_value']))
                                        {{ $version['brix_value'] }}°Bx
                                    @else
                                        -
                                    @endif
                                </td>

                                {{-- 操作按鈕 --}}
                                <td class="py-4 pr-4 pl-3 text-sm font-medium whitespace-nowrap text-center sm:pr-6">
                                    <x-recipes.action-buttons
                                        :viewUrl="$version['view_url'] ?? '#'"
                                        :editUrl="$version['edit_url'] ?? '#'"
                                        :deleteId="$version['id']"
                                        :deleteName="$version['version_name'] ?? ''"
                                        :copyUrl="$version['copy_url'] ?? '#'"
                                        :showCopy="true"
                                    />
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="{{ $showCheckbox ? 9 : 8 }}" class="px-3 py-8 text-center text-sm text-gray-500">
                                    {{ $emptyMessage }}
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
```

**使用範例**:

```blade
{{-- 1. 版本歷史頁面 (version-history.blade.php) --}}
@php
$recipe = [
    'id' => 1,
    'code' => '#0001',
    'name' => '紅豆湯',
];

$versions = [
    [
        'id' => 1,
        'version_name' => 'v1',
        'version_label' => '傳統版',
        'created_at' => '2025-11-01',
        'purpose' => '經典配方，保留傳統風味',
        'sample_quantity' => 10,
        'sample_unit' => '罐',
        'ph_value' => '6.5',
        'brix_value' => '15.0',
        'view_url' => route('recipes.versions.show', [1, 1]),
        'edit_url' => route('recipes.versions.edit', [1, 1]),
        'copy_url' => route('recipes.versions.copy', [1, 1]),
    ],
    [
        'id' => 2,
        'version_name' => 'v2',
        'version_label' => '低糖版',
        'created_at' => '2025-11-03',
        'purpose' => '降低糖分，符合健康需求',
        'sample_quantity' => 15,
        'sample_unit' => '罐',
        'ph_value' => '6.3',
        'brix_value' => '10.5',
        'view_url' => route('recipes.versions.show', [1, 2]),
        'edit_url' => route('recipes.versions.edit', [1, 2]),
        'copy_url' => route('recipes.versions.copy', [1, 2]),
    ],
    [
        'id' => 3,
        'version_name' => 'v3',
        'version_label' => '速煮版',
        'created_at' => '2025-11-05',
        'purpose' => '縮短製程時間，提高生產效率',
        'sample_quantity' => 20,
        'sample_unit' => '罐',
        'ph_value' => '6.7',
        'brix_value' => '14.2',
        'view_url' => route('recipes.versions.show', [1, 3]),
        'edit_url' => route('recipes.versions.edit', [1, 3]),
        'copy_url' => route('recipes.versions.copy', [1, 3]),
    ],
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

{{-- 版本歷史表格 --}}
<x-recipes.version-history-table :versions="$versions" />

{{-- 2. 不顯示多選框 --}}
<x-recipes.version-history-table :versions="$versions" :showCheckbox="false" />

{{-- 3. 自訂空白訊息 --}}
<x-recipes.version-history-table
    :versions="[]"
    emptyMessage="此配方尚無版本,請點擊「新增版本」開始建立"
/>
```

**設計說明**:

- **整合元件**:
  - 使用 `version-badge` 顯示版本號
  - 使用 `action-buttons` 元件提供操作按鈕（檢視、編輯、複製、刪除）
- **研發目的欄位**: 使用 `max-w-xs truncate` 處理過長文字,並提供完整 title 提示
- **測量數據**: PH 值顯示原值,Brix 糖度加上單位 °Bx
- **操作按鈕**: 使用 `action-buttons` 元件，包含複製按鈕（`showCopy="true"`）可快速建立新版本
- **多選功能**: 支援批次操作（如批次匯出、批次比較）
- **響應式**: 使用相同的 Tailwind UI 響應式模式
- **無障礙**: 每個操作按鈕都標示清楚的對象版本

---


---

**返回**: [元件總覽](../components.md)
