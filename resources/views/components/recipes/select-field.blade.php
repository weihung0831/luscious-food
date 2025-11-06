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
            class="grid w-full cursor-default grid-cols-1 rounded-lg bg-white px-3 py-2.5 text-left text-sm shadow-sm ring-1 ring-inset transition-all duration-200 {{ $error ? 'text-red-900 ring-red-300' : 'text-gray-900 ring-gray-300' }} focus-visible:ring-2 focus-visible:ring-indigo-500 focus-visible:shadow-md {{ $disabled ? 'cursor-not-allowed bg-gray-50 text-gray-500 ring-gray-200' : '' }}"
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
