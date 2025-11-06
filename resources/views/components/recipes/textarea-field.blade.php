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
                class="block w-full rounded-lg bg-white px-3 py-2.5 text-sm text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 transition-all duration-200 focus:ring-2 focus:ring-inset focus:ring-indigo-500 focus:shadow-md {{ $disabled ? 'disabled:cursor-not-allowed disabled:bg-gray-50 disabled:text-gray-500 disabled:ring-gray-200' : '' }}"
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
