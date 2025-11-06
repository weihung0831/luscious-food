# Feedback Components (回饋/提示相關元件)

**文件說明**: 本文件包含所有回饋、提示、徽章相關的 Blade 元件規格
**元件數量**: 6 個
**最後更新**: 2025-11-07

---

## 元件清單

1. [status-badge](#1-status-badge) - 狀態徽章
2. [version-badge](#2-version-badge) - 版本號徽章
3. [alert](#3-alert) - 提示訊息元件
4. [button](#4-button) - 按鈕元件
5. [action-buttons](#5-action-buttons) - 操作按鈕組（桌面版表格用）
   - [mobile-action-buttons](#5-2-mobile-action-buttons) - 操作按鈕組（手機版表格用）
6. [confirm-modal](#6-confirm-modal) - 確認對話框
7. [modal](#7-modal) - 彈出視窗元件

---

### 8. status-badge (狀態徽章)

**檔案位置**: `resources/views/recipes/components/status-badge.blade.php`

**說明**: 基於 Tailwind UI - Application UI > Elements > Badges (Flat pill 樣式)

**Props**:
```php
@props([
    'status' => 'pending',   // pending, approved, rejected, archived
])
```

**完整程式碼**:
```blade
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
```

**使用範例**:
```blade
{{-- 配方列表中顯示狀態 --}}
<x-recipes.status-badge status="pending" />
<x-recipes.status-badge status="approved" />
<x-recipes.status-badge status="rejected" />
<x-recipes.status-badge status="archived" />

{{-- 在表格中使用 --}}
<td class="px-6 py-4">
    <x-recipes.status-badge :status="$recipe->status" />
</td>

{{-- 在詳情頁面使用 --}}
<div class="flex items-center gap-2">
    <span class="text-sm text-gray-600">狀態:</span>
    <x-recipes.status-badge status="approved" />
</div>
```

**設計說明**:
- **來源**: Tailwind UI - Application UI > Elements > Badges (Flat pill)
- **藥丸形狀**: 圓潤的 `rounded-full` 設計
- **顏色系統**:
  - 🟡 待審核 (pending): 黃色背景 + 深黃色文字
  - 🟢 已核准 (approved): 綠色背景 + 深綠色文字
  - 🔴 已退回 (rejected): 紅色背景 + 深紅色文字
  - ⚫ 已歸檔 (archived): 灰色背景 + 深灰色文字
- **尺寸**: 緊湊的 `text-xs` 適合表格和列表

---

### 9. version-badge (版本號徽章)

**檔案位置**: `resources/views/recipes/components/version-badge.blade.php`

**說明**: 基於 Tailwind UI - Application UI > Elements > Badges (Flat pill 樣式)

**Props**:
```php
@props([
    'version' => 'A1',
])
```

**完整程式碼**:
```blade
@props([
    'version' => 'v1',
])

@php
// 支援兩種格式：
// 1. 字母+數字格式 (A1, B2, C5) - 根據字母選擇顏色
// 2. v+數字格式 (v1, v2, v3) - 根據數字選擇顏色

$firstChar = substr($version, 0, 1);

// 判斷是哪種格式
if ($firstChar === 'v' || $firstChar === 'V') {
    // v+數字格式：根據版本號選擇顏色
    $versionNumber = (int) substr($version, 1);
    $colorIndex = ($versionNumber - 1) % 6; // 0-5 循環
    $colors = [
        'bg-blue-100 text-blue-700',      // v1, v7, v13...
        'bg-purple-100 text-purple-700',  // v2, v8, v14...
        'bg-pink-100 text-pink-700',      // v3, v9, v15...
        'bg-indigo-100 text-indigo-700',  // v4, v10, v16...
        'bg-green-100 text-green-700',    // v5, v11, v17...
        'bg-yellow-100 text-yellow-800',  // v6, v12, v18...
    ];
    $colorClass = $colors[$colorIndex];
} else {
    // 字母+數字格式：根據字母選擇顏色
    $colorMap = [
        'A' => 'bg-blue-100 text-blue-700',
        'B' => 'bg-purple-100 text-purple-700',
        'C' => 'bg-pink-100 text-pink-700',
        'D' => 'bg-indigo-100 text-indigo-700',
        'E' => 'bg-green-100 text-green-700',
        'F' => 'bg-yellow-100 text-yellow-800',
    ];
    $colorClass = $colorMap[$firstChar] ?? 'bg-gray-100 text-gray-600';
}
@endphp

<span class="inline-flex items-center rounded-full {{ $colorClass }} px-2 py-1 text-xs font-semibold font-mono">
    {{ $version }}
</span>
```

**使用範例**:
```blade
{{-- v+數字格式 (常用於配方版本) --}}
<x-recipes.version-badge version="v1" />
<x-recipes.version-badge version="v2" />
<x-recipes.version-badge version="v3" />

{{-- 字母+數字格式 (適用於其他場景) --}}
<x-recipes.version-badge version="A1" />
<x-recipes.version-badge version="B2" />
<x-recipes.version-badge version="C5" />

{{-- 在表格中使用 --}}
<td class="px-6 py-4">
    <x-recipes.version-badge :version="$recipe->version" />
</td>

{{-- 在詳情頁面使用 --}}
<div class="flex items-center gap-2">
    <span class="text-sm text-gray-600">版本:</span>
    <x-recipes.version-badge version="A3" />
</div>

{{-- 版本歷史列表 --}}
@foreach($versions as $version)
    <div class="flex items-center gap-3">
        <x-recipes.version-badge :version="$version->number" />
        <span>{{ $version->created_at }}</span>
    </div>
@endforeach
```

**設計說明**:
- **來源**: Tailwind UI - Application UI > Elements > Badges (Flat pill)
- **藥丸形狀**: 圓潤的 `rounded-full` 設計
- **雙格式支援**:
  - **v+數字格式** (v1, v2, v3...): 根據版本號循環選擇顏色
    - 🔵 v1, v7, v13: 藍色
    - 🟣 v2, v8, v14: 紫色
    - 🩷 v3, v9, v15: 粉色
    - 🟦 v4, v10, v16: Indigo
    - 🟢 v5, v11, v17: 綠色
    - 🟡 v6, v12, v18: 黃色
  - **字母+數字格式** (A1, B2, C5...): 根據字母選擇顏色
    - 🔵 A 系列: 藍色
    - 🟣 B 系列: 紫色
    - 🩷 C 系列: 粉色
    - 🟦 D 系列: Indigo
    - 🟢 E 系列: 綠色
    - 🟡 F 系列: 黃色
    - ⚫ 其他: 灰色 (fallback)
- **字體**: 使用 `font-mono` (等寬字體) 讓版本號更清楚
- **字重**: `font-semibold` 強調版本號

---

### 11. alert (提示訊息元件)

**檔案位置**: `resources/views/recipes/components/alert.blade.php`

**說明**: 基於 Tailwind UI - Application UI > Overlays > Notifications 設計

**Props**:
```php
@props([
    'type' => 'success',     // success, error, warning, info
    'title' => '',           // 主要訊息
    'message' => '',         // 副訊息/描述 (選填)
    'dismissible' => true,   // 是否可關閉
])
```

**完整程式碼**:
```blade
@props([
    'type' => 'success',
    'title' => '',
    'message' => '',
    'dismissible' => true,
])

@php
$typeConfig = [
    'success' => [
        'icon' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" data-slot="icon" aria-hidden="true" class="size-6 text-green-400">
                    <path d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" stroke-linecap="round" stroke-linejoin="round" />
                  </svg>',
    ],
    'error' => [
        'icon' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" data-slot="icon" aria-hidden="true" class="size-6 text-red-400">
                    <path d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" stroke-linecap="round" stroke-linejoin="round" />
                  </svg>',
    ],
    'warning' => [
        'icon' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" data-slot="icon" aria-hidden="true" class="size-6 text-yellow-400">
                    <path d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" stroke-linecap="round" stroke-linejoin="round" />
                  </svg>',
    ],
    'info' => [
        'icon' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" data-slot="icon" aria-hidden="true" class="size-6 text-blue-400">
                    <path d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" stroke-linecap="round" stroke-linejoin="round" />
                  </svg>',
    ],
];

$config = $typeConfig[$type] ?? $typeConfig['success'];
@endphp

<div class="pointer-events-auto w-full max-w-sm rounded-lg bg-white shadow-lg outline-1 outline-black/5">
    <div class="p-4">
        <div class="flex items-start">
            {{-- 圖示 --}}
            <div class="shrink-0">
                {!! $config['icon'] !!}
            </div>

            {{-- 訊息內容 --}}
            <div class="ml-3 w-0 flex-1 pt-0.5">
                <p class="text-sm font-medium text-gray-900">{{ $title }}</p>
                @if($message)
                    <p class="mt-1 text-sm text-gray-500">{{ $message }}</p>
                @endif
            </div>

            {{-- 關閉按鈕 --}}
            @if($dismissible)
                <div class="ml-4 flex shrink-0">
                    <button type="button" class="inline-flex rounded-md text-gray-400 hover:text-gray-500 focus:outline-2 focus:outline-offset-2 focus:outline-indigo-600">
                        <span class="sr-only">關閉</span>
                        <svg viewBox="0 0 20 20" fill="currentColor" data-slot="icon" aria-hidden="true" class="size-5">
                            <path d="M6.28 5.22a.75.75 0 0 0-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 1 0 1.06 1.06L10 11.06l3.72 3.72a.75.75 0 1 0 1.06-1.06L11.06 10l3.72-3.72a.75.75 0 0 0-1.06-1.06L10 8.94 6.28 5.22Z" />
                        </svg>
                    </button>
                </div>
            @endif
        </div>
    </div>
</div>
```

**使用範例**:
```blade
{{-- 1. 成功訊息 --}}
<x-recipes.alert
    type="success"
    title="配方已成功提交!"
    message="審核通過後將自動發送通知"
/>

{{-- 2. 錯誤訊息 (不可關閉) --}}
<x-recipes.alert
    type="error"
    title="提交失敗"
    message="請檢查所有必填欄位是否填寫完整"
    :dismissible="false"
/>

{{-- 3. 警告訊息 --}}
<x-recipes.alert
    type="warning"
    title="注意"
    message="百分比總和為 95%,建議調整為 100%"
/>

{{-- 4. 資訊訊息 (僅標題) --}}
<x-recipes.alert
    type="info"
    title="此配方已進入審核流程"
/>

{{-- 5. 在頁面頂部顯示通知 --}}
@if(session('success'))
    <div class="mb-4">
        <x-recipes.alert
            type="success"
            :title="session('success')"
        />
    </div>
@endif

@if($errors->any())
    <div class="mb-4">
        <x-recipes.alert
            type="error"
            title="表單驗證失敗"
            message="{{ $errors->first() }}"
        />
    </div>
@endif

{{-- 6. 使用 fixed 定位顯示在右上角 --}}
<div class="fixed top-4 right-4 z-50">
    <x-recipes.alert
        type="success"
        title="儲存成功!"
    />
</div>
```

**設計說明**:
- **來源**: Tailwind UI - Application UI > Overlays > Notifications
- **四種類型**: success (綠色)、error (紅色)、warning (黃色)、info (藍色)
- **圖示**: 每種類型有對應的圓形圖示
- **兩層訊息**: title (粗體) + message (細節說明,選填)
- **可關閉**: 右上角 X 按鈕 (可選)
- **陰影效果**: 使用 shadow-lg 提供深度感
- **靈活定位**: 預設為相對定位,可用容器控制位置

**進階用法 (固定定位通知區)**:
```blade
{{-- 在主 layout 中加入通知容器 --}}
<div aria-live="assertive" class="pointer-events-none fixed inset-0 flex items-end px-4 py-6 sm:items-start sm:p-6 z-50">
    <div class="flex w-full flex-col items-center space-y-4 sm:items-end">
        {{-- 動態插入通知 --}}
        @if(session('notification'))
            <x-recipes.alert
                :type="session('notification.type')"
                :title="session('notification.title')"
                :message="session('notification.message')"
            />
        @endif
    </div>
</div>
```

**TODO: 進階功能 (使用 Alpine.js 實作)**:
- 自動消失 (3-5秒後自動關閉)
- 淡入淡出動畫
- 堆疊多個通知
- 點擊關閉按鈕時的動畫效果

---

### 12. button (按鈕元件)

**檔案位置**: `resources/views/recipes/components/button.blade.php`

**說明**: 基於 Tailwind UI - Application UI > Elements > Buttons 設計

**Props**:
```php
@props([
    'type' => 'button',      // button, submit, reset
    'variant' => 'primary',  // primary, secondary, danger
    'size' => 'md',          // xs, sm, md, lg, xl
    'disabled' => false,
])
```

**完整程式碼**:
```blade
@props([
    'type' => 'button',
    'variant' => 'primary',
    'size' => 'md',
    'disabled' => false,
])

@php
// 變體配色
$variantClasses = [
    'primary' => 'bg-indigo-600 text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-indigo-600',
    'secondary' => 'bg-white text-gray-900 shadow-xs inset-ring inset-ring-gray-300 hover:bg-gray-50',
    'danger' => 'bg-red-600 text-white shadow-xs hover:bg-red-500 focus-visible:outline-red-600',
];

// 尺寸系統 (根據 Tailwind UI 規格)
$sizeClasses = [
    'xs' => 'rounded-sm px-2 py-1 text-xs',
    'sm' => 'rounded-sm px-2 py-1 text-sm',
    'md' => 'rounded-md px-2.5 py-1.5 text-sm',
    'lg' => 'rounded-md px-3 py-2 text-sm',
    'xl' => 'rounded-md px-3.5 py-2.5 text-sm',
];

// 圖示間距 (根據尺寸調整)
$iconGapClasses = [
    'xs' => 'gap-x-1.5',
    'sm' => 'gap-x-1.5',
    'md' => 'gap-x-1.5',
    'lg' => 'gap-x-1.5',
    'xl' => 'gap-x-2',
];

$variantClass = $variantClasses[$variant] ?? $variantClasses['primary'];
$sizeClass = $sizeClasses[$size] ?? $sizeClasses['md'];
$iconGapClass = $iconGapClasses[$size] ?? $iconGapClasses['md'];

// Disabled 狀態樣式
$disabledClass = $disabled ? 'opacity-50 cursor-not-allowed' : '';

// 基礎樣式
$baseClasses = 'inline-flex items-center font-semibold focus-visible:outline-2 focus-visible:outline-offset-2';

// 檢查是否有 slot 內容包含 SVG (判斷是否為帶圖示的按鈕)
$hasIcon = $slot && str_contains($slot, '<svg');
$gapClass = $hasIcon ? $iconGapClass : '';
@endphp

<button
    type="{{ $type }}"
    @if($disabled) disabled @endif
    {{ $attributes->merge(['class' => trim("$baseClasses $variantClass $sizeClass $gapClass $disabledClass")]) }}
>
    {{ $slot }}
</button>
```

**使用範例**:

```blade
{{-- 1. 基本 Primary 按鈕 (不同尺寸) --}}
<x-recipes.button variant="primary" size="xs">Button text</x-recipes.button>
<x-recipes.button variant="primary" size="sm">Button text</x-recipes.button>
<x-recipes.button variant="primary" size="md">Button text</x-recipes.button>
<x-recipes.button variant="primary" size="lg">Button text</x-recipes.button>
<x-recipes.button variant="primary" size="xl">Button text</x-recipes.button>

{{-- 2. Secondary 按鈕 --}}
<x-recipes.button variant="secondary" size="md">取消</x-recipes.button>
<x-recipes.button variant="secondary" size="lg">返回列表</x-recipes.button>

{{-- 3. Danger 按鈕 (危險操作) --}}
<x-recipes.button variant="danger" size="md">刪除配方</x-recipes.button>
<x-recipes.button variant="danger" size="lg">退回審核</x-recipes.button>

{{-- 4. 帶前置圖示的按鈕 --}}
<x-recipes.button variant="primary" size="md">
    <svg viewBox="0 0 20 20" fill="currentColor" data-slot="icon" aria-hidden="true" class="-ml-0.5 size-5">
        <path d="M10.75 4.75a.75.75 0 0 0-1.5 0v4.5h-4.5a.75.75 0 0 0 0 1.5h4.5v4.5a.75.75 0 0 0 1.5 0v-4.5h4.5a.75.75 0 0 0 0-1.5h-4.5v-4.5Z" />
    </svg>
    新增項目
</x-recipes.button>

<x-recipes.button variant="primary" size="xl">
    <svg viewBox="0 0 20 20" fill="currentColor" data-slot="icon" aria-hidden="true" class="-ml-0.5 size-5">
        <path d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm3.857-9.809a.75.75 0 0 0-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 1 0-1.06 1.061l2.5 2.5a.75.75 0 0 0 1.137-.089l4-5.5Z" clip-rule="evenodd" fill-rule="evenodd" />
    </svg>
    建立配方
</x-recipes.button>

{{-- 5. Submit 表單按鈕 --}}
<x-recipes.button variant="primary" type="submit" size="lg">
    提交審核
</x-recipes.button>

{{-- 6. Disabled 狀態 --}}
<x-recipes.button variant="primary" size="md" :disabled="true">
    處理中...
</x-recipes.button>

{{-- 7. 實際應用範例 - 表單操作區 --}}
<div class="mt-6 flex items-center justify-end gap-x-4">
    <x-recipes.button variant="secondary" size="lg">
        取消
    </x-recipes.button>
    <x-recipes.button variant="primary" type="submit" size="lg">
        儲存配方
    </x-recipes.button>
</div>

{{-- 8. 實際應用範例 - 列表操作 --}}
<div class="flex items-center gap-x-3">
    <x-recipes.button variant="primary" size="sm">
        <svg viewBox="0 0 20 20" fill="currentColor" data-slot="icon" aria-hidden="true" class="-ml-0.5 size-5">
            <path d="M10.75 4.75a.75.75 0 0 0-1.5 0v4.5h-4.5a.75.75 0 0 0 0 1.5h4.5v4.5a.75.75 0 0 0 1.5 0v-4.5h4.5a.75.75 0 0 0 0-1.5h-4.5v-4.5Z" />
        </svg>
        建立新配方
    </x-recipes.button>
    <x-recipes.button variant="secondary" size="sm">
        匯出 Excel
    </x-recipes.button>
</div>
```

**設計說明**:

- **三種變體**: primary (藍紫色)、secondary (白色帶邊框)、danger (紅色)
- **五種尺寸**: xs, sm, md, lg, xl,完全遵循 Tailwind UI 規格
- **圖示支援**: 在 slot 中直接插入 SVG 圖示,元件會自動調整間距
- **圖示規格**: 使用 `class="-ml-0.5 size-5"` 來確保圖示對齊和大小一致
- **Disabled 狀態**: 支援 disabled 屬性,會降低透明度並禁用點擊
- **Focus 樣式**: 使用 `focus-visible:outline` 提供清晰的鍵盤導航提示
- **Shadow 效果**: 使用 `shadow-xs` 提供細微的陰影效果

---

### 5. action-buttons (操作按鈕組 - 桌面版)

**檔案位置**: `resources/views/recipes/components/action-buttons.blade.php`

**說明**: 用於桌面版表格中的操作按鈕組，圓形圖示按鈕設計，提供檢視、編輯、複製、刪除等常用操作

**Props**:
```php
@props([
    'viewUrl' => '#',
    'editUrl' => '#',
    'deleteId' => null,
    'deleteName' => '',
    'copyUrl' => null,
    'showCopy' => false,
])
```

**完整程式碼**: 見 `resources/views/components/recipes/action-buttons.blade.php`

**使用範例**:
```blade
{{-- 1. 配方列表表格中使用（基本三個按鈕）--}}
<x-recipes.action-buttons
    :viewUrl="$recipe['view_url']"
    :editUrl="$recipe['edit_url']"
    :deleteId="$recipe['id']"
    :deleteName="$recipe['name']"
/>

{{-- 2. 版本歷史表格中使用（包含複製按鈕）--}}
<x-recipes.action-buttons
    :viewUrl="$version['view_url']"
    :editUrl="$version['edit_url']"
    :deleteId="$version['id']"
    :deleteName="$version['version_name']"
    :copyUrl="$version['copy_url']"
    :showCopy="true"
/>

{{-- 3. 在表格 <td> 中使用 --}}
<td class="py-4 pr-4 pl-3 text-sm font-medium whitespace-nowrap text-center sm:pr-6">
    <x-recipes.action-buttons
        viewUrl="/recipes/{{ $recipe->id }}"
        editUrl="/recipes/{{ $recipe->id }}/edit"
        :deleteId="$recipe->id"
        :deleteName="$recipe->name"
    />
</td>
```

**設計說明**:
- **漸層按鈕**: 每個按鈕使用雙色漸層背景，hover 時轉為深色漸層
- **顏色語意化**:
  - 🔵 檢視: 藍色系 (`blue-cyan`)
  - 🟠 編輯: 橘色系 (`orange-amber`)
  - 🟢 複製: 綠色系 (`green-emerald`)
  - 🔴 刪除: 紅色系 (`red-pink`)
- **尺寸**: 固定 `w-9 h-9` 正方形按鈕
- **圓角**: 使用 `rounded-xl` 提供現代感
- **互動效果**:
  - hover 時背景漸層變深、文字變白
  - hover 時縮放 1.1 倍 (`scale-110`)
  - hover 時圖示額外縮放 1.1 倍
  - 陰影效果 (`shadow-lg`)
- **無障礙**: 使用 `sr-only` 提供螢幕閱讀器文字
- **刪除確認**: 刪除按鈕使用 Alpine.js 的 `@click` 事件觸發確認對話框

**技術需求**:
- 需要 Alpine.js 支援刪除確認功能
- 父層需要定義 `confirmDelete` 函數

**使用場景**: 桌面版表格(hidden md:block)

---

### 5-2. mobile-action-buttons (操作按鈕組 - 手機版)

**檔案位置**: `resources/views/recipes/components/mobile-action-buttons.blade.php`

**說明**: 用於手機版表格卡片中的操作按鈕組，只顯示圖示不顯示文字，提供檢視、編輯、複製、刪除等常用操作

**Props**:
```php
@props([
    'viewUrl' => '#',
    'editUrl' => '#',
    'deleteId' => null,
    'deleteName' => '',
    'copyUrl' => null,
    'showCopy' => false,
])
```

**完整程式碼**: 見 `resources/views/components/recipes/mobile-action-buttons.blade.php`

**使用範例**:
```blade
{{-- 1. 配方列表手機版卡片中使用（基本三個按鈕）--}}
<x-recipes.mobile-action-buttons
    :viewUrl="$recipe['view_url']"
    :editUrl="$recipe['edit_url']"
    :deleteId="$recipe['id']"
    :deleteName="$recipe['name']"
/>

{{-- 2. 版本歷史手機版卡片中使用（包含複製按鈕）--}}
<x-recipes.mobile-action-buttons
    :viewUrl="$version['view_url']"
    :editUrl="$version['edit_url']"
    :deleteId="$version['id']"
    :deleteName="$version['version_name']"
    :copyUrl="$version['copy_url']"
    :showCopy="true"
/>
```

**設計說明**:
- **只顯示圖示**: 手機版螢幕空間有限,按鈕只顯示圖示不顯示文字
- **顏色語意化**:
  - 🔵 檢視: 藍色系 (`blue-50` 背景, `blue-600` 文字)
  - 🟠 編輯: 橘色系 (`orange-50` 背景, `orange-600` 文字)
  - 🟢 複製: 綠色系 (`green-50` 背景, `green-600` 文字)
  - 🔴 刪除: 紅色系 (`red-50` 背景, `red-600` 文字)
- **尺寸**: 圖示大小 `w-5 h-5`，按鈕內距 `px-3 py-2`
- **圓角**: 使用 `rounded-lg` 提供適中的圓角
- **互動效果**:
  - hover 時背景色加深 (例如 `blue-50` → `blue-100`)
  - 使用 `transition-all duration-200` 提供平滑過渡效果
- **無障礙**: 使用 `title` 屬性提供 hover 時的功能說明
- **刪除確認**: 刪除按鈕使用 Alpine.js 的 `@click` 事件觸發確認對話框

**技術需求**:
- 需要 Alpine.js 支援刪除確認功能
- 父層需要定義 `confirmDelete` 函數

**使用場景**: 手機版卡片(md:hidden)

**與桌面版的差異**:
| 特性 | 桌面版 (action-buttons) | 手機版 (mobile-action-buttons) |
|------|------------------------|-------------------------------|
| 按鈕形狀 | 正方形 (w-9 h-9) | 矩形 (px-3 py-2) |
| 圓角 | rounded-xl | rounded-lg |
| 背景 | 雙色漸層 | 單色淺色背景 |
| 圖示大小 | w-4.5 h-4.5 | w-5 h-5 |
| hover 效果 | 背景變深色+縮放+陰影 | 背景加深 |
| 文字說明 | sr-only (螢幕閱讀器) | title (hover 提示) |

---

### 6. confirm-modal (確認對話框)

**檔案位置**: `resources/views/recipes/components/confirm-modal.blade.php`

**說明**: 簡化版的確認對話框，用於刪除等危險操作的二次確認

**Props**:
```php
@props([
    'show' => 'showModal',           // Alpine.js 變數名稱
    'title' => '確認操作',
    'itemName' => 'itemName',        // Alpine.js 變數名稱（項目名稱）
    'confirmText' => '確認',
    'cancelText' => '取消',
    'confirmVariant' => 'danger',    // primary, danger
])
```

**使用範例**:
```blade
{{-- 1. 在表格元件中使用 --}}
<div x-data="{
    showDeleteModal: false,
    deleteItemId: null,
    deleteItemName: '',
    confirmDelete(id, name) {
        this.deleteItemId = id;
        this.deleteItemName = name;
        this.showDeleteModal = true;
    },
    handleDelete() {
        console.log('刪除項目 ID:', this.deleteItemId);
        this.showDeleteModal = false;
    }
}">
    {{-- 表格內容 --}}
    <x-recipes.action-buttons ... />

    {{-- 確認對話框 --}}
    <x-recipes.confirm-modal
        show="showDeleteModal"
        title="確認刪除配方"
        itemName="deleteItemName"
        confirmText="確認刪除"
        cancelText="取消"
        confirmVariant="danger"
        @click="handleDelete()"
    />
</div>
```

**設計說明**:
- **輕量級**: 相比完整的 modal 元件更簡潔
- **Alpine.js 整合**: 使用 `x-show` 控制顯示/隱藏
- **背景遮罩**: 半透明黑色背景
- **動態內容**: 支援動態顯示項目名稱
- **雙按鈕**: 確認/取消按鈕，確認按鈕可選擇 primary 或 danger 樣式

---

### 7. modal (彈出視窗元件)

**檔案位置**: `resources/views/recipes/components/modal.blade.php`

**說明**: 基於 Tailwind UI - Application UI > Overlays > Modal Dialogs 設計,用於確認對話框、警告訊息等

**Props**:
```php
@props([
    'id' => 'modal',             // Modal 的唯一 ID
    'type' => 'success',         // success, danger, info
    'title' => '',               // 標題文字
    'message' => '',             // 訊息內容
    'confirmText' => '確認',     // 確認按鈕文字
    'cancelText' => '取消',      // 取消按鈕文字
    'confirmAction' => '',       // 確認按鈕的 action (URL 或 JavaScript)
    'showCancel' => true,        // 是否顯示取消按鈕
])
```

**完整程式碼**:
```blade
@props([
    'id' => 'modal',
    'type' => 'success',
    'title' => '',
    'message' => '',
    'confirmText' => '確認',
    'cancelText' => '取消',
    'confirmAction' => '',
    'showCancel' => true,
])

@php
// 類型配置
$typeConfig = [
    'success' => [
        'iconBg' => 'bg-green-100',
        'iconColor' => 'text-green-600',
        'icon' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" data-slot="icon" aria-hidden="true" class="size-6 text-green-600">
                      <path d="m4.5 12.75 6 6 9-13.5" stroke-linecap="round" stroke-linejoin="round" />
                  </svg>',
        'buttonClass' => 'bg-indigo-600 hover:bg-indigo-500 focus-visible:outline-indigo-600',
        'layout' => 'centered', // 居中顯示
    ],
    'danger' => [
        'iconBg' => 'bg-red-100',
        'iconColor' => 'text-red-600',
        'icon' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" data-slot="icon" aria-hidden="true" class="size-6 text-red-600">
                      <path d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" stroke-linecap="round" stroke-linejoin="round" />
                  </svg>',
        'buttonClass' => 'bg-red-600 hover:bg-red-500',
        'layout' => 'left-aligned', // 左對齊
    ],
    'info' => [
        'iconBg' => 'bg-blue-100',
        'iconColor' => 'text-blue-600',
        'icon' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" data-slot="icon" aria-hidden="true" class="size-6 text-blue-600">
                      <path d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" stroke-linecap="round" stroke-linejoin="round" />
                  </svg>',
        'buttonClass' => 'bg-indigo-600 hover:bg-indigo-500 focus-visible:outline-indigo-600',
        'layout' => 'centered',
    ],
];

$config = $typeConfig[$type] ?? $typeConfig['success'];
$isCentered = $config['layout'] === 'centered';
@endphp

<el-dialog>
    <dialog id="{{ $id }}" aria-labelledby="{{ $id }}-title" class="fixed inset-0 size-auto max-h-none max-w-none overflow-y-auto bg-transparent backdrop:bg-transparent">
        {{-- 背景遮罩 --}}
        <el-dialog-backdrop class="fixed inset-0 bg-gray-500/75 transition-opacity data-closed:opacity-0 data-enter:duration-300 data-enter:ease-out data-leave:duration-200 data-leave:ease-in"></el-dialog-backdrop>

        <div tabindex="0" class="flex min-h-full items-end justify-center p-4 text-center focus:outline-none sm:items-center sm:p-0">
            <el-dialog-panel class="relative transform overflow-hidden rounded-lg bg-white px-4 pt-5 pb-4 text-left shadow-xl transition-all data-closed:translate-y-4 data-closed:opacity-0 data-enter:duration-300 data-enter:ease-out data-leave:duration-200 data-leave:ease-in sm:my-8 sm:w-full sm:max-w-lg sm:p-6 data-closed:sm:translate-y-0 data-closed:sm:scale-95">

                @if($isCentered)
                    {{-- 居中佈局 (success, info) --}}
                    <div>
                        <div class="mx-auto flex size-12 items-center justify-center rounded-full {{ $config['iconBg'] }}">
                            {!! $config['icon'] !!}
                        </div>
                        <div class="mt-3 text-center sm:mt-5">
                            <h3 id="{{ $id }}-title" class="text-base font-semibold text-gray-900">{{ $title }}</h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500">{{ $message }}</p>
                                {{ $slot }}
                            </div>
                        </div>
                    </div>

                    {{-- 按鈕區 (居中佈局) --}}
                    <div class="mt-5 sm:mt-6 sm:grid sm:grid-flow-row-dense sm:grid-cols-2 sm:gap-3">
                        <button
                            type="button"
                            command="close"
                            commandfor="{{ $id }}"
                            @if($confirmAction) onclick="{{ $confirmAction }}" @endif
                            class="inline-flex w-full justify-center rounded-md {{ $config['buttonClass'] }} px-3 py-2 text-sm font-semibold text-white shadow-xs focus-visible:outline-2 focus-visible:outline-offset-2 sm:col-start-2"
                        >
                            {{ $confirmText }}
                        </button>

                        @if($showCancel)
                            <button
                                type="button"
                                command="close"
                                commandfor="{{ $id }}"
                                class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-xs inset-ring-1 inset-ring-gray-300 hover:bg-gray-50 sm:col-start-1 sm:mt-0"
                            >
                                {{ $cancelText }}
                            </button>
                        @endif
                    </div>
                @else
                    {{-- 左對齊佈局 (danger) --}}
                    <div class="sm:flex sm:items-start">
                        <div class="mx-auto flex size-12 shrink-0 items-center justify-center rounded-full {{ $config['iconBg'] }} sm:mx-0 sm:size-10">
                            {!! $config['icon'] !!}
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 id="{{ $id }}-title" class="text-base font-semibold text-gray-900">{{ $title }}</h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500">{{ $message }}</p>
                                {{ $slot }}
                            </div>
                        </div>
                    </div>

                    {{-- 按鈕區 (左對齊佈局) --}}
                    <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                        <button
                            type="button"
                            command="close"
                            commandfor="{{ $id }}"
                            @if($confirmAction) onclick="{{ $confirmAction }}" @endif
                            class="inline-flex w-full justify-center rounded-md {{ $config['buttonClass'] }} px-3 py-2 text-sm font-semibold text-white shadow-xs sm:ml-3 sm:w-auto"
                        >
                            {{ $confirmText }}
                        </button>

                        @if($showCancel)
                            <button
                                type="button"
                                command="close"
                                commandfor="{{ $id }}"
                                class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-xs inset-ring-1 inset-ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto"
                            >
                                {{ $cancelText }}
                            </button>
                        @endif
                    </div>
                @endif

            </el-dialog-panel>
        </div>
    </dialog>
</el-dialog>
```

**觸發按鈕範例**:
```blade
{{-- 使用 command 屬性觸發 Modal --}}
<button
    command="show-modal"
    commandfor="delete-confirm-modal"
    class="rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white hover:bg-red-500"
>
    刪除配方
</button>
```

**使用範例**:

```blade
{{-- 1. 成功訊息 Modal (居中顯示) --}}
<x-recipes.modal
    id="success-modal"
    type="success"
    title="提交成功"
    message="您的配方已成功提交審核,請等待主管審核。"
    confirmText="返回列表"
    :showCancel="false"
/>

{{-- 觸發按鈕 --}}
<button command="show-modal" commandfor="success-modal" class="...">
    提交配方
</button>

{{-- 2. 刪除確認 Modal (危險操作) --}}
<x-recipes.modal
    id="delete-confirm-modal"
    type="danger"
    title="刪除配方"
    message="確定要刪除此配方嗎?所有資料將永久移除且無法復原。"
    confirmText="確認刪除"
    cancelText="取消"
    confirmAction="document.getElementById('delete-form').submit();"
/>

{{-- 觸發按鈕 --}}
<button command="show-modal" commandfor="delete-confirm-modal" class="...">
    <svg><!-- 垃圾桶圖示 --></svg>
    刪除
</button>

{{-- 隱藏的刪除表單 --}}
<form id="delete-form" action="/recipes/{{ $recipe->id }}" method="POST" class="hidden">
    @csrf
    @method('DELETE')
</form>

{{-- 3. 審核意見 Modal (自訂內容) --}}
<x-recipes.modal
    id="review-modal"
    type="info"
    title="審核配方"
    confirmText="送出審核"
    cancelText="取消"
>
    <form id="review-form" action="/recipes/{{ $recipe->id }}/review" method="POST" class="mt-4">
        @csrf
        <x-recipes.textarea-field
            label="審核意見"
            name="review_comment"
            :required="true"
            :rows="4"
            placeholder="請輸入審核意見..."
        />
    </form>
</x-recipes.modal>

{{-- 4. 退回配方 Modal --}}
<x-recipes.modal
    id="reject-modal"
    type="danger"
    title="退回配方"
    message="請說明退回原因,以便研發人員修正。"
    confirmText="確認退回"
    cancelText="取消"
>
    <form id="reject-form" action="/recipes/{{ $recipe->id }}/reject" method="POST" class="mt-4 text-left">
        @csrf
        <x-recipes.textarea-field
            label="退回原因"
            name="reject_reason"
            :required="true"
            :rows="3"
            placeholder="請輸入退回原因..."
        />
    </form>
</x-recipes.modal>

{{-- 5. 完整頁面範例 - 配方詳情頁操作 --}}
<div class="flex gap-x-3">
    {{-- 編輯按鈕 --}}
    <x-recipes.button variant="secondary" size="md">
        <a href="/recipes/{{ $recipe->id }}/edit">編輯配方</a>
    </x-recipes.button>

    {{-- 刪除按鈕 (觸發 Modal) --}}
    <button
        command="show-modal"
        commandfor="delete-modal"
        class="inline-flex items-center gap-x-1.5 rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-red-500"
    >
        <svg viewBox="0 0 20 20" fill="currentColor" class="-ml-0.5 size-5">
            <path d="M6.28 5.22a.75.75 0 0 0-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 1 0 1.06 1.06L10 11.06l3.72 3.72a.75.75 0 1 0 1.06-1.06L11.06 10l3.72-3.72a.75.75 0 0 0-1.06-1.06L10 8.94 6.28 5.22Z" />
        </svg>
        刪除配方
    </button>
</div>

{{-- Modal 定義 --}}
<x-recipes.modal
    id="delete-modal"
    type="danger"
    title="刪除配方"
    message="確定要刪除配方「{{ $recipe->name }}」(版本 {{ $recipe->version }})嗎?此操作無法復原。"
    confirmText="確認刪除"
    confirmAction="document.getElementById('delete-recipe-form').submit();"
/>

<form id="delete-recipe-form" action="/recipes/{{ $recipe->id }}" method="POST" class="hidden">
    @csrf
    @method('DELETE')
</form>
```

**設計說明**:

- **三種類型**: success (成功/綠色)、danger (危險/紅色)、info (資訊/藍色)
- **雙佈局模式**:
  - **居中佈局**: success 和 info 類型,適合一般確認訊息
  - **左對齊佈局**: danger 類型,適合危險操作確認
- **彈性內容**: 支援 `message` prop 或使用 `$slot` 自訂 HTML 內容(如表單)
- **按鈕配置**:
  - 雙按鈕模式:取消 + 確認
  - 單按鈕模式:設定 `:showCancel="false"`
- **動作綁定**: `confirmAction` prop 可綁定 JavaScript 或表單提交
- **響應式動畫**: 使用 Tailwind UI 的 data-* 狀態類別實現淡入淡出和縮放效果
- **無障礙支援**: 使用 `aria-labelledby` 和 `dialog` 元素確保螢幕閱讀器支援

**技術需求**:
```html
<!-- 需要在 layout 主檔案的 <head> 中引入 -->
<script src="https://cdn.jsdelivr.net/npm/@tailwindplus/elements@1" type="module"></script>
```

**觸發方式**:
- 使用 `command="show-modal"` 和 `commandfor="modal-id"` 屬性打開 Modal
- 使用 `command="close"` 和 `commandfor="modal-id"` 屬性關閉 Modal
- 點擊背景遮罩或按 ESC 鍵也會自動關閉 Modal

---

## 使用說明

### 1. 元件命名空間

所有配方管理相關元件使用 `recipes.` 命名空間:

```blade
<x-recipes.form-field />
<x-recipes.status-badge />
<x-recipes.item-table />
```

### 2. 屬性傳遞

**布林值屬性**:
```blade
{{-- 正確 --}}
<x-recipes.form-field :required="true" />
<x-recipes.form-field :required="false" />

{{-- 錯誤 --}}
<x-recipes.form-field required="true" />  {{-- 會被視為字串 --}}
```

**陣列屬性**:
```blade
<x-recipes.select-field
    :options="['can' => '罐', 'cup' => '杯']"
/>
```

### 3. Slots 使用

```blade
{{-- 預設 slot --}}
<x-recipes.alert type="warning">
    這是警告訊息內容
</x-recipes.alert>

{{-- 命名 slot --}}
<x-recipes.modal title="標題">
    這是內容

    <x-slot name="footer">
        <button>確認</button>
    </x-slot>
</x-recipes.modal>
```

### 4. 合併屬性

元件會自動合併額外的 HTML 屬性:

```blade
<x-recipes.form-field
    name="recipe_name"
    class="my-custom-class"
    data-test="input-field"
/>
```

---

## 開發注意事項

### 1. 假資料使用

在靜態原型階段,所有資料應在 Blade 模板中硬編碼:

```blade
@php
$recipes = [
    ['id' => 1, 'name' => '巧克力布朗尼', 'version' => 'A1', 'status' => 'pending'],
    ['id' => 2, 'name' => '抹茶蛋糕', 'version' => 'B2', 'status' => 'approved'],
];
@endphp

@foreach($recipes as $recipe)
    {{-- 顯示配方 --}}
@endforeach
```

### 2. 互動邏輯標記

使用註解標記未來需要加入的互動邏輯:

```blade
{{-- TODO: 使用 Alpine.js 實作動態新增項目 --}}
<button type="button">新增項目</button>

{{-- TODO: 使用 Alpine.js 計算百分比總和 --}}
<p>百分比總和: <span>0</span>%</p>
```

### 3. 表單提交

表單使用標準 HTML form,不實作 AJAX 提交:

```blade
<form action="/recipes" method="POST" enctype="multipart/form-data">
    @csrf
    {{-- 表單欄位 --}}
    <button type="submit">提交</button>
</form>
```

### 4. 路由佔位

所有連結和表單 action 使用佔位路由:

```blade
<a href="/recipes">配方列表</a>
<a href="/recipes/create">建立配方</a>
<a href="/recipes/{{ $recipe->id }}">查看配方</a>
<form action="/recipes" method="POST">...</form>
```

---

**元件規格完成日期**: 2025-11-06
**總計元件數量**: 18 個 ✅
  - **全域元件**: 1 個 (navbar)
  - **配方專用元件**: 17 個

**元件清單**:

### 基礎元件 (已完成 13/13) ✅

1. **navbar** (全域導航列) - Tailwind UI Navigation
2. **page-header** (頁面標題列) - Tailwind UI Page Headings
3. **form-field** (通用表單欄位) - Tailwind UI Input Groups
4. **textarea-field** (多行文字欄位) - Tailwind UI Textareas
5. **select-field** (下拉選單) - Tailwind UI Select Menus + @tailwindplus/elements
6. **image-upload** (照片上傳) - Tailwind UI File Inputs
7. **status-badge** (狀態徽章) - Tailwind UI Badges
8. **version-badge** (版本號徽章) - Tailwind UI Badges
9. **breadcrumb** (麵包屑導航) - Tailwind UI Breadcrumbs
10. **alert** (提示訊息) - Tailwind UI Notifications
11. **button** (按鈕) - Tailwind UI Buttons
12. **item-table** (項目清單動態表格) - Tailwind UI Tables
13. **modal** (彈出視窗) - Tailwind UI Modal Dialogs + @tailwindplus/elements

### 頁面級元件 (已完成 3/3) ✅

---


---

**返回**: [元件總覽](../components.md)
