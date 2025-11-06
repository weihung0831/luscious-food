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
                class="block w-full rounded-lg bg-white px-3 py-2.5 text-sm text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 transition-all duration-200 focus:ring-2 focus:ring-inset focus:ring-indigo-500 focus:shadow-md {{ $disabled ? 'disabled:cursor-not-allowed disabled:bg-gray-50 disabled:text-gray-500 disabled:ring-gray-200' : '' }}"
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
