# Form Components (表單相關元件)

**文件說明**: 本文件包含所有表單相關的 Blade 元件規格
**元件數量**: 4 個
**最後更新**: 2025-11-06

---

## 元件清單

1. [form-field](#1-form-field) - 通用表單欄位
2. [textarea-field](#2-textarea-field) - 多行文字欄位
3. [select-field](#3-select-field) - 下拉選單
4. [image-upload](#4-image-upload) - 照片上傳元件

---

### 1. form-field (通用表單欄位)

**檔案位置**: `resources/views/recipes/components/form-field.blade.php`

**說明**: 基於 Tailwind UI - Application UI > Forms > Input Groups 設計

**Props**:
```php
@props([
    'label' => '',           // 欄位標籤
    'name' => '',            // 欄位 name 屬性
    'type' => 'text',        // 輸入類型 (text, number, email 等)
    'value' => '',           // 預設值
    'placeholder' => '',     // 佔位提示文字
    'required' => false,     // 是否必填
    'disabled' => false,     // 是否禁用
    'error' => '',           // 錯誤訊息
    'helpText' => '',        // 輔助說明文字
    'cornerHint' => '',      // 右上角提示 (如 "選填" 或 "最多100字")
    'prefix' => '',          // 輸入框前綴 (如 "https://")
    'suffix' => '',          // 輸入框後綴 (如單位 "g", "kg")
])
```

**完整程式碼**:
```blade
@props([
    'label' => '',
    'name' => '',
    'type' => 'text',
    'value' => '',
    'placeholder' => '',
    'required' => false,
    'disabled' => false,
    'error' => '',
    'helpText' => '',
    'cornerHint' => '',
    'prefix' => '',
    'suffix' => '',
])

<div>
    {{-- Label 區域 --}}
    @if($label)
        <div class="flex justify-between">
            <label for="{{ $name }}" class="block text-sm/6 font-medium text-gray-900">
                {{ $label }}
                @if($required)
                    <span class="text-red-600" aria-label="必填">*</span>
                @endif
            </label>
            @if($cornerHint)
                <span id="{{ $name }}-hint" class="text-sm/6 text-gray-500">{{ $cornerHint }}</span>
            @endif
        </div>
    @endif

    {{-- 輸入框區域 --}}
    <div class="mt-2">
        @if($error)
            {{-- 錯誤狀態 --}}
            <div class="grid grid-cols-1">
                <input
                    type="{{ $type }}"
                    name="{{ $name }}"
                    id="{{ $name }}"
                    value="{{ $value }}"
                    placeholder="{{ $placeholder }}"
                    aria-invalid="true"
                    aria-describedby="{{ $name }}-error"
                    @if($required) required @endif
                    @if($disabled) disabled @endif
                    class="col-start-1 row-start-1 block w-full rounded-md bg-white py-1.5 pr-10 pl-3 text-red-900 outline-1 -outline-offset-1 outline-red-300 placeholder:text-red-300 focus:outline-2 focus:-outline-offset-2 focus:outline-red-600 sm:pr-9 sm:text-sm/6"
                />
                <svg viewBox="0 0 16 16" fill="currentColor" data-slot="icon" aria-hidden="true" class="pointer-events-none col-start-1 row-start-1 mr-3 size-5 self-center justify-self-end text-red-500 sm:size-4">
                    <path d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14ZM8 4a.75.75 0 0 1 .75.75v3a.75.75 0 0 1-1.5 0v-3A.75.75 0 0 1 8 4Zm0 8a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z" clip-rule="evenodd" fill-rule="evenodd" />
                </svg>
            </div>
        @elseif($prefix || $suffix)
            {{-- 帶前綴/後綴的輸入框 --}}
            <div class="flex items-center rounded-md bg-white {{ $prefix ? 'pl-3' : '' }} {{ $suffix ? 'pr-3' : '' }} outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                @if($prefix)
                    <div class="shrink-0 text-base text-gray-500 select-none sm:text-sm/6">{{ $prefix }}</div>
                @endif
                <input
                    type="{{ $type }}"
                    name="{{ $name }}"
                    id="{{ $name }}"
                    value="{{ $value }}"
                    placeholder="{{ $placeholder }}"
                    @if($required) required @endif
                    @if($disabled) disabled @endif
                    @if($helpText || $cornerHint) aria-describedby="{{ $name }}-description" @endif
                    class="block min-w-0 grow py-1.5 {{ $prefix ? 'pr-3 pl-1' : 'px-3' }} text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6 {{ $disabled ? 'cursor-not-allowed bg-gray-50 text-gray-500' : '' }}"
                />
                @if($suffix)
                    <div class="shrink-0 text-base text-gray-500 select-none sm:text-sm/6">{{ $suffix }}</div>
                @endif
            </div>
        @else
            {{-- 一般輸入框 --}}
            <input
                type="{{ $type }}"
                name="{{ $name }}"
                id="{{ $name }}"
                value="{{ $value }}"
                placeholder="{{ $placeholder }}"
                @if($required) required @endif
                @if($disabled) disabled @endif
                @if($helpText || $cornerHint) aria-describedby="{{ $name }}-description" @endif
                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 {{ $disabled ? 'disabled:cursor-not-allowed disabled:bg-gray-50 disabled:text-gray-500 disabled:outline-gray-200' : '' }} sm:text-sm/6"
            />
        @endif
    </div>

    {{-- 輔助說明文字 --}}
    @if($helpText)
        <p id="{{ $name }}-description" class="mt-2 text-sm text-gray-500">{{ $helpText }}</p>
    @endif

    {{-- 錯誤訊息 --}}
    @if($error)
        <p id="{{ $name }}-error" class="mt-2 text-sm text-red-600" role="alert">{{ $error }}</p>
    @endif
</div>
```

**使用範例**:
```blade
{{-- 1. 基本輸入欄位 --}}
<x-recipes.form-field
    label="配方名稱"
    name="recipe_name"
    :required="true"
    placeholder="請輸入配方名稱"
/>

{{-- 2. 帶輔助說明文字 --}}
<x-recipes.form-field
    label="配方編號"
    name="recipe_code"
    placeholder="R001"
    helpText="系統會自動產生,也可手動輸入"
/>

{{-- 3. 帶錯誤訊息 --}}
<x-recipes.form-field
    label="配方名稱"
    name="recipe_name"
    value="巧克力"
    :required="true"
    error="配方名稱至少需要5個字元"
/>

{{-- 4. 禁用/唯讀欄位 --}}
<x-recipes.form-field
    label="版本號"
    name="version"
    value="A1"
    :disabled="true"
    helpText="版本號由系統自動產生"
/>

{{-- 5. 選填欄位 (右上角提示) --}}
<x-recipes.form-field
    label="備註"
    name="note"
    cornerHint="選填"
    placeholder="輸入額外備註"
/>

{{-- 6. 帶單位的數字輸入 (後綴) --}}
<x-recipes.form-field
    label="洗豆水量"
    name="water_amount"
    type="number"
    :required="true"
    suffix="ml"
    placeholder="1000"
/>

{{-- 7. 帶前綴的輸入 --}}
<x-recipes.form-field
    label="網站連結"
    name="website"
    prefix="https://"
    placeholder="www.example.com"
/>

{{-- 8. 字數限制提示 --}}
<x-recipes.form-field
    label="配方目的"
    name="purpose"
    :required="true"
    cornerHint="最多200字"
    placeholder="說明配方建立目的"
/>

{{-- 9. Email 輸入 --}}
<x-recipes.form-field
    label="電子郵件"
    name="email"
    type="email"
    placeholder="you@example.com"
    helpText="我們只會用於重要通知"
/>
```

**設計說明**:
- **來源**: Tailwind UI - Application UI > Forms > Input Groups
- **支援6種狀態**: 基本、說明文字、錯誤、禁用、右上角提示、前後綴
- **錯誤狀態**: 自動顯示紅色外框和錯誤圖示
- **前後綴功能**: 適合網址(https://)或單位(g, ml, kg)
- **完全響應式**: 文字大小在小螢幕自動調整
- **無障礙支援**: 完整的 aria 屬性和語意化標籤

---

### 2. textarea-field (多行文字欄位)

**檔案位置**: `resources/views/recipes/components/textarea-field.blade.php`

**說明**: 基於 Tailwind UI - Application UI > Forms > Textareas 設計

**Props**:
```php
@props([
    'label' => '',
    'name' => '',
    'value' => '',
    'placeholder' => '',
    'required' => false,
    'disabled' => false,
    'rows' => 4,
    'maxlength' => null,
    'error' => '',
    'helpText' => '',
    'cornerHint' => '',      // 右上角提示 (如 "選填" 或 "最多500字")
    'showCounter' => false,  // 是否顯示字數計數器
])
```

**完整程式碼**:
```blade
@props([
    'label' => '',
    'name' => '',
    'value' => '',
    'placeholder' => '',
    'required' => false,
    'disabled' => false,
    'rows' => 4,
    'maxlength' => null,
    'error' => '',
    'helpText' => '',
    'cornerHint' => '',
    'showCounter' => false,
])

<div>
    {{-- Label 區域 --}}
    @if($label)
        <div class="flex justify-between">
            <label for="{{ $name }}" class="block text-sm/6 font-medium text-gray-900">
                {{ $label }}
                @if($required)
                    <span class="text-red-600" aria-label="必填">*</span>
                @endif
            </label>
            @if($cornerHint)
                <span id="{{ $name }}-hint" class="text-sm/6 text-gray-500">{{ $cornerHint }}</span>
            @endif
        </div>
    @endif

    {{-- Textarea 區域 --}}
    <div class="mt-2">
        @if($error)
            {{-- 錯誤狀態 --}}
            <div class="grid grid-cols-1">
                <textarea
                    name="{{ $name }}"
                    id="{{ $name }}"
                    rows="{{ $rows }}"
                    @if($maxlength) maxlength="{{ $maxlength }}" @endif
                    @if($required) required @endif
                    @if($disabled) disabled @endif
                    placeholder="{{ $placeholder }}"
                    aria-invalid="true"
                    aria-describedby="{{ $name }}-error"
                    class="col-start-1 row-start-1 block w-full rounded-md bg-white py-1.5 pr-10 pl-3 text-base text-red-900 outline-1 -outline-offset-1 outline-red-300 placeholder:text-red-300 focus:outline-2 focus:-outline-offset-2 focus:outline-red-600 sm:text-sm/6"
                >{{ $value }}</textarea>
                <svg viewBox="0 0 16 16" fill="currentColor" data-slot="icon" aria-hidden="true" class="pointer-events-none col-start-1 row-start-1 mr-3 mt-3 size-5 self-start justify-self-end text-red-500 sm:size-4">
                    <path d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14ZM8 4a.75.75 0 0 1 .75.75v3a.75.75 0 0 1-1.5 0v-3A.75.75 0 0 1 8 4Zm0 8a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z" clip-rule="evenodd" fill-rule="evenodd" />
                </svg>
            </div>
        @else
            {{-- 一般狀態 --}}
            <textarea
                name="{{ $name }}"
                id="{{ $name }}"
                rows="{{ $rows }}"
                @if($maxlength) maxlength="{{ $maxlength }}" @endif
                @if($required) required @endif
                @if($disabled) disabled @endif
                @if($helpText || $cornerHint) aria-describedby="{{ $name }}-description" @endif
                placeholder="{{ $placeholder }}"
                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 {{ $disabled ? 'disabled:cursor-not-allowed disabled:bg-gray-50 disabled:text-gray-500 disabled:outline-gray-200' : '' }} sm:text-sm/6"
            >{{ $value }}</textarea>
        @endif
    </div>

    {{-- 輔助說明文字 --}}
    @if($helpText)
        <p id="{{ $name }}-description" class="mt-2 text-sm text-gray-500">{{ $helpText }}</p>
    @endif

    {{-- 字數計數器 --}}
    @if($showCounter && $maxlength)
        <div class="mt-2 flex justify-between text-sm text-gray-500">
            <span>已輸入 <span id="{{ $name }}-counter">{{ strlen($value) }}</span> 字元</span>
            <span>最多 {{ $maxlength }} 字元</span>
        </div>
        {{-- TODO: 使用 Alpine.js 實作即時字數計數 --}}
    @elseif($maxlength && !$error)
        <p class="mt-2 text-sm text-gray-500 text-right">最多 {{ $maxlength }} 字元</p>
    @endif

    {{-- 錯誤訊息 --}}
    @if($error)
        <p id="{{ $name }}-error" class="mt-2 text-sm text-red-600" role="alert">{{ $error }}</p>
    @endif
</div>
```

**使用範例**:
```blade
{{-- 1. 基本多行輸入 --}}
<x-recipes.textarea-field
    label="配方目的"
    name="purpose"
    :required="true"
    placeholder="請說明配方建立目的"
/>

{{-- 2. 帶輔助說明文字 --}}
<x-recipes.textarea-field
    label="配方目的"
    name="purpose"
    :required="true"
    :rows="3"
    placeholder="請說明配方建立目的"
    helpText="清楚描述此配方的目標與用途,有助於後續追蹤"
/>

{{-- 3. 帶字數限制和計數器 --}}
<x-recipes.textarea-field
    label="注意事項"
    name="notes"
    :required="true"
    :rows="5"
    :maxlength="500"
    :showCounter="true"
    placeholder="記錄重要注意事項"
/>

{{-- 4. 帶錯誤訊息 --}}
<x-recipes.textarea-field
    label="配方目的"
    name="purpose"
    value="測試"
    :required="true"
    error="配方目的至少需要10個字元"
/>

{{-- 5. 右上角提示 --}}
<x-recipes.textarea-field
    label="備註"
    name="remarks"
    cornerHint="選填"
    :rows="3"
    placeholder="輸入額外備註"
/>

{{-- 6. 禁用狀態 --}}
<x-recipes.textarea-field
    label="歷史備註"
    name="old_notes"
    value="此為已歸檔配方的備註,無法修改"
    :disabled="true"
    :rows="3"
/>

{{-- 7. 完整配置 --}}
<x-recipes.textarea-field
    label="注意事項"
    name="notes"
    :required="true"
    :rows="6"
    :maxlength="500"
    :showCounter="true"
    cornerHint="重要"
    placeholder="請詳細記錄配方製作時的注意事項"
    helpText="包含溫度、時間、順序等重要細節"
/>
```

**設計說明**:
- **來源**: Tailwind UI - Application UI > Forms > Textareas
- **錯誤狀態**: 紅色外框 + 右上角錯誤圖示
- **字數計數**: 支援靜態顯示,可用 Alpine.js 實作即時計數
- **彈性行數**: 預設4行,可自訂
- **完全響應式**: 文字大小在小螢幕自動調整
- **無障礙支援**: 完整的 aria 屬性和語意化標籤

---

### 3. select-field (下拉選單欄位)

**檔案位置**: `resources/views/recipes/components/select-field.blade.php`

**說明**: 基於 Tailwind UI - Application UI > Forms > Select Menus 設計 (使用 `@tailwindplus/elements` 的自訂下拉選單)

**Props**:
```php
@props([
    'label' => '',
    'name' => '',
    'options' => [],         // ['value' => 'label', ...] 或 [['value' => '1', 'label' => '選項1'], ...]
    'selected' => '',
    'placeholder' => '請選擇',
    'required' => false,
    'disabled' => false,
    'error' => '',
    'helpText' => '',
    'cornerHint' => '',
])
```

**完整程式碼**:
```blade
@props([
    'label' => '',
    'name' => '',
    'options' => [],
    'selected' => '',
    'placeholder' => '請選擇',
    'required' => false,
    'disabled' => false,
    'error' => '',
    'helpText' => '',
    'cornerHint' => '',
])

{{-- 需要引入 @tailwindplus/elements 來支援自訂下拉選單 --}}
{{-- <script src="https://cdn.jsdelivr.net/npm/@tailwindplus/elements@1" type="module"></script> --}}

<div>
    {{-- Label 區域 --}}
    @if($label)
        <div class="flex justify-between">
            <label for="{{ $name }}" class="block text-sm/6 font-medium text-gray-900">
                {{ $label }}
                @if($required)
                    <span class="text-red-600" aria-label="必填">*</span>
                @endif
            </label>
            @if($cornerHint)
                <span id="{{ $name }}-hint" class="text-sm/6 text-gray-500">{{ $cornerHint }}</span>
            @endif
        </div>
    @endif

    {{-- 自訂下拉選單 --}}
    <el-select
        id="{{ $name }}"
        name="{{ $name }}"
        value="{{ $selected }}"
        @if($disabled) disabled @endif
        @if($required) required @endif
        @if($error) aria-invalid="true" aria-describedby="{{ $name }}-error" @endif
        @if($helpText || $cornerHint) aria-describedby="{{ $name }}-description" @endif
        class="mt-2 block"
    >
        <button
            type="button"
            class="grid w-full cursor-default grid-cols-1 rounded-md bg-white py-1.5 pr-2 pl-3 text-left {{ $error ? 'text-red-900 outline-1 -outline-offset-1 outline-red-300' : 'text-gray-900 outline-1 -outline-offset-1 outline-gray-300' }} focus-visible:outline-2 focus-visible:-outline-offset-2 focus-visible:outline-indigo-600 {{ $disabled ? 'cursor-not-allowed bg-gray-50 text-gray-500 outline-gray-200' : '' }} sm:text-sm/6"
            @if($disabled) disabled @endif
        >
            <el-selectedcontent class="col-start-1 row-start-1 truncate pr-6">
                {{ $placeholder }}
            </el-selectedcontent>
            <svg viewBox="0 0 16 16" fill="currentColor" data-slot="icon" aria-hidden="true" class="col-start-1 row-start-1 size-5 self-center justify-self-end {{ $error ? 'text-red-500' : 'text-gray-500' }} sm:size-4">
                <path d="M5.22 10.22a.75.75 0 0 1 1.06 0L8 11.94l1.72-1.72a.75.75 0 1 1 1.06 1.06l-2.25 2.25a.75.75 0 0 1-1.06 0l-2.25-2.25a.75.75 0 0 1 0-1.06ZM10.78 5.78a.75.75 0 0 1-1.06 0L8 4.06 6.28 5.78a.75.75 0 0 1-1.06-1.06l2.25-2.25a.75.75 0 0 1 1.06 0l2.25 2.25a.75.75 0 0 1 0 1.06Z" clip-rule="evenodd" fill-rule="evenodd" />
            </svg>
        </button>

        <el-options anchor="bottom start" popover class="max-h-60 w-(--button-width) overflow-auto rounded-md bg-white py-1 text-base shadow-lg outline-1 outline-black/5 [--anchor-gap:--spacing(1)] data-leave:transition data-leave:transition-discrete data-leave:duration-100 data-leave:ease-in data-closed:data-leave:opacity-0 sm:text-sm">
            @foreach($options as $key => $option)
                @php
                    // 支援兩種格式: ['value' => 'label'] 或 [['value' => '1', 'label' => '標籤']]
                    $optionValue = is_array($option) ? $option['value'] : $key;
                    $optionLabel = is_array($option) ? $option['label'] : $option;
                @endphp
                <el-option value="{{ $optionValue }}" class="group/option relative block cursor-default py-2 pr-9 pl-3 text-gray-900 select-none focus:bg-indigo-600 focus:text-white focus:outline-hidden">
                    <span class="block truncate font-normal group-aria-selected/option:font-semibold">{{ $optionLabel }}</span>
                    <span class="absolute inset-y-0 right-0 flex items-center pr-4 text-indigo-600 group-not-aria-selected/option:hidden group-focus/option:text-white in-[el-selectedcontent]:hidden">
                        <svg viewBox="0 0 20 20" fill="currentColor" data-slot="icon" aria-hidden="true" class="size-5">
                            <path d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z" clip-rule="evenodd" fill-rule="evenodd" />
                        </svg>
                    </span>
                </el-option>
            @endforeach
        </el-options>
    </el-select>

    {{-- 輔助說明文字 --}}
    @if($helpText)
        <p id="{{ $name }}-description" class="mt-2 text-sm text-gray-500">{{ $helpText }}</p>
    @endif

    {{-- 錯誤訊息 --}}
    @if($error)
        <p id="{{ $name }}-error" class="mt-2 text-sm text-red-600" role="alert">{{ $error }}</p>
    @endif
</div>
```

**使用範例**:
```blade
{{-- 1. 基本下拉選單 --}}
<x-recipes.select-field
    label="樣品數單位"
    name="sample_unit"
    :required="true"
    :options="[
        'can' => '罐',
        'cup' => '杯',
        'bag' => '袋',
        'bowl' => '碗'
    ]"
    selected="can"
/>

{{-- 2. 帶輔助說明文字 --}}
<x-recipes.select-field
    label="配方狀態"
    name="status"
    :options="[
        'pending' => '待審核',
        'approved' => '已核准',
        'rejected' => '已退回',
        'archived' => '已歸檔'
    ]"
    helpText="選擇要篩選的配方狀態"
/>

{{-- 3. 帶錯誤訊息 --}}
<x-recipes.select-field
    label="樣品數單位"
    name="sample_unit"
    :required="true"
    :options="['can' => '罐', 'cup' => '杯', 'bag' => '袋', 'bowl' => '碗']"
    error="請選擇單位"
/>

{{-- 4. 選填欄位 (右上角提示) --}}
<x-recipes.select-field
    label="來源配方編號"
    name="source_recipe_id"
    cornerHint="選填"
    :options="[
        '1' => 'R001 - 巧克力布朗尼 A1',
        '2' => 'R002 - 抹茶蛋糕 B2',
        '3' => 'R003 - 草莓塔 A3'
    ]"
    placeholder="選擇來源配方"
/>

{{-- 5. 禁用狀態 --}}
<x-recipes.select-field
    label="配方類型"
    name="recipe_type"
    :disabled="true"
    :options="['baking' => '烘焙', 'cooking' => '烹飪']"
    selected="baking"
/>

{{-- 6. 使用者選擇 (陣列格式) --}}
<x-recipes.select-field
    label="指派給"
    name="assigned_to"
    :required="true"
    :options="[
        ['value' => '1', 'label' => '張研發'],
        ['value' => '2', 'label' => '李主管'],
        ['value' => '3', 'label' => '王經理']
    ]"
    selected="1"
/>
```

**設計說明**:
- **來源**: Tailwind UI - Application UI > Forms > Select Menus
- **自訂元件**: 使用 `@tailwindplus/elements` 的 `el-select` 實現更好的 UI
- **優點**:
  - 更美觀的下拉選單樣式
  - 支援鍵盤導航
  - 選中項目有打勾圖示
  - 可滾動的選項列表
- **錯誤狀態**: 紅色外框和圖示
- **支援兩種選項格式**: 簡單的 key-value 陣列或物件陣列

**技術需求**:
```html
<!-- 需要在 layout 主檔案的 <head> 中引入 -->
<script src="https://cdn.jsdelivr.net/npm/@tailwindplus/elements@1" type="module"></script>
```

---

### 4. image-upload (照片上傳元件)

**檔案位置**: `resources/views/recipes/components/image-upload.blade.php`

**說明**: 基於 Tailwind UI - Application UI > Forms > Input Groups 設計

**Props**:
```php
@props([
    'name' => 'photo',
    'label' => '照片上傳',
    'required' => false,
    'previewUrl' => '',          // 已上傳照片的預覽 URL
    'error' => '',
    'helpText' => '',
    'accept' => 'image/jpeg,image/png',  // 接受的檔案類型
    'maxSize' => '10MB',         // 最大檔案大小說明文字
    'formats' => 'PNG, JPG, GIF', // 支援格式說明文字
])
```

**完整程式碼**:
```blade
@props([
    'name' => 'photo',
    'label' => '照片上傳',
    'required' => false,
    'previewUrl' => '',
    'error' => '',
    'helpText' => '',
    'accept' => 'image/jpeg,image/png',
    'maxSize' => '10MB',
    'formats' => 'PNG, JPG, GIF',
])

<div class="col-span-full">
    {{-- Label --}}
    @if($label)
        <label for="{{ $name }}" class="block text-sm/6 font-medium text-gray-900">
            {{ $label }}
            @if($required)
                <span class="text-red-600" aria-label="必填">*</span>
            @endif
        </label>
    @endif

    {{-- 上傳區域 --}}
    <div class="mt-2 flex justify-center rounded-lg border border-dashed {{ $error ? 'border-red-300 bg-red-50' : 'border-gray-900/25' }} px-6 py-10">
        <div class="text-center">
            {{-- 圖片圖示 --}}
            <svg viewBox="0 0 24 24" fill="currentColor" data-slot="icon" aria-hidden="true" class="mx-auto size-12 {{ $error ? 'text-red-300' : 'text-gray-300' }}">
                <path d="M1.5 6a2.25 2.25 0 0 1 2.25-2.25h16.5A2.25 2.25 0 0 1 22.5 6v12a2.25 2.25 0 0 1-2.25 2.25H3.75A2.25 2.25 0 0 1 1.5 18V6ZM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0 0 21 18v-1.94l-2.69-2.689a1.5 1.5 0 0 0-2.12 0l-.88.879.97.97a.75.75 0 1 1-1.06 1.06l-5.16-5.159a1.5 1.5 0 0 0-2.12 0L3 16.061Zm10.125-7.81a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0Z" clip-rule="evenodd" fill-rule="evenodd" />
            </svg>

            {{-- 上傳文字和按鈕 --}}
            <div class="mt-4 flex text-sm/6 {{ $error ? 'text-red-600' : 'text-gray-600' }}">
                <label for="{{ $name }}" class="relative cursor-pointer rounded-md bg-transparent font-semibold {{ $error ? 'text-red-600 hover:text-red-500' : 'text-indigo-600 hover:text-indigo-500' }} focus-within:outline-2 focus-within:outline-offset-2 focus-within:outline-indigo-600">
                    <span>上傳檔案</span>
                    <input
                        id="{{ $name }}"
                        name="{{ $name }}"
                        type="file"
                        accept="{{ $accept }}"
                        @if($required) required @endif
                        @if($error) aria-invalid="true" aria-describedby="{{ $name }}-error" @endif
                        @if($helpText) aria-describedby="{{ $name }}-description" @endif
                        class="sr-only"
                    />
                </label>
                <p class="pl-1">或拖放至此</p>
            </div>

            {{-- 格式和大小限制說明 --}}
            <p class="text-xs/5 {{ $error ? 'text-red-600' : 'text-gray-600' }}">
                {{ $formats }} 最大 {{ $maxSize }}
            </p>
        </div>
    </div>

    {{-- 預覽區域 --}}
    @if($previewUrl)
        <div class="mt-4">
            <p class="text-sm font-medium text-gray-700 mb-2">目前照片:</p>
            <div class="relative inline-block">
                <img
                    src="{{ $previewUrl }}"
                    alt="照片預覽"
                    class="h-32 w-32 rounded-lg object-cover shadow-sm ring-1 ring-gray-900/10"
                />
                {{-- TODO: 可選擇性加入刪除按鈕 --}}
            </div>
        </div>
    @else
        {{-- TODO: 使用 Alpine.js 實作即時預覽 --}}
        <div class="mt-4 hidden" id="{{ $name }}-preview">
            <p class="text-sm font-medium text-gray-700 mb-2">預覽:</p>
            <img
                src=""
                alt="照片預覽"
                class="h-32 w-32 rounded-lg object-cover shadow-sm ring-1 ring-gray-900/10"
            />
        </div>
    @endif

    {{-- 輔助說明文字 --}}
    @if($helpText)
        <p id="{{ $name }}-description" class="mt-2 text-sm text-gray-500">{{ $helpText }}</p>
    @endif

    {{-- 錯誤訊息 --}}
    @if($error)
        <p id="{{ $name }}-error" class="mt-2 text-sm text-red-600" role="alert">{{ $error }}</p>
    @endif
</div>
```

**使用範例**:
```blade
{{-- 1. 基本照片上傳 --}}
<x-recipes.image-upload
    name="recipe_photo"
    label="配方照片"
    :required="true"
/>

{{-- 2. 自訂格式和大小限制 --}}
<x-recipes.image-upload
    name="recipe_photo"
    label="配方照片"
    :required="true"
    accept="image/jpeg,image/png"
    formats="PNG, JPG"
    maxSize="5MB"
    helpText="請上傳清晰的配方成品照片"
/>

{{-- 3. 帶錯誤訊息 --}}
<x-recipes.image-upload
    name="recipe_photo"
    label="配方照片"
    :required="true"
    error="照片檔案過大,請上傳小於 5MB 的圖片"
/>

{{-- 4. 顯示已上傳照片 (編輯模式) --}}
<x-recipes.image-upload
    name="recipe_photo"
    label="配方照片"
    :required="true"
    previewUrl="/storage/recipes/chocolate-brownie.jpg"
    helpText="更換照片請重新上傳"
/>

{{-- 5. 選填欄位 --}}
<x-recipes.image-upload
    name="additional_photo"
    label="額外照片"
    formats="PNG, JPG, GIF, WebP"
    maxSize="10MB"
    helpText="可上傳製作過程或細節照片"
/>

{{-- 6. 支援 GIF 動圖 --}}
<x-recipes.image-upload
    name="process_gif"
    label="製作過程動圖"
    accept="image/gif,image/jpeg,image/png"
    formats="GIF, PNG, JPG"
    maxSize="20MB"
/>
```

**設計說明**:
- **來源**: Tailwind UI - Application UI > Forms > Input Groups (File Upload)
- **拖放上傳**: 支援拖放檔案到虛線框內
- **點擊上傳**: 點擊「上傳檔案」文字選擇檔案
- **視覺提示**: 大型圖片圖示和清楚的說明文字
- **錯誤狀態**: 紅色虛線框和紅色文字
- **預覽功能**: 顯示已上傳的照片縮圖
- **可自訂**: 格式限制、大小限制可彈性設定
- **無障礙**: 使用 `sr-only` 隱藏實際的 file input,保持無障礙支援

**進階功能 (可選)**:
```blade
{{-- TODO: 使用 Alpine.js 或 JavaScript 實作 --}}
- 即時預覽 (選擇檔案後立即顯示預覽圖)
- 拖放區域高亮 (拖曳檔案進入時改變背景色)
- 檔案大小驗證 (前端即時檢查檔案大小)
- 多檔案上傳 (一次上傳多張照片)
- 裁切功能 (上傳前裁切圖片)
```

---


---

**返回**: [元件總覽](../components.md)
