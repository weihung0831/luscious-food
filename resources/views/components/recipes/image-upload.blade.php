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

<style>
@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-10px); }
}

@keyframes dash {
    to { stroke-dashoffset: 0; }
}

.upload-float {
    animation: float 3s ease-in-out infinite;
}

.upload-area:hover .upload-float {
    animation: float 2s ease-in-out infinite;
}
</style>

<div class="col-span-full">
    {{-- Label --}}
    @if($label)
        <label for="{{ $name }}" class="block text-sm font-medium text-gray-900">
            {{ $label }}
            @if($required)
                <span class="text-red-600" aria-label="必填">*</span>
            @endif
        </label>
    @endif

    {{-- 上傳區域 --}}
    <div class="mt-2 upload-area relative overflow-hidden rounded-xl border-2 border-dashed {{ $error ? 'border-red-300 bg-red-50/50' : 'border-gray-300 bg-gradient-to-br from-gray-50 to-indigo-50/20' }} px-6 py-12 transition-all duration-300 hover:border-indigo-400 hover:bg-gradient-to-br hover:from-indigo-50/50 hover:to-purple-50/30 hover:shadow-lg">
        {{-- 裝飾性背景圖案 --}}
        <div class="absolute inset-0 opacity-5">
            <svg class="h-full w-full" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <pattern id="upload-pattern" x="0" y="0" width="20" height="20" patternUnits="userSpaceOnUse">
                        <circle cx="2" cy="2" r="1" fill="currentColor" class="text-indigo-600"/>
                    </pattern>
                </defs>
                <rect x="0" y="0" width="100%" height="100%" fill="url(#upload-pattern)"/>
            </svg>
        </div>

        <div class="relative text-center">
            {{-- 圖片圖示 --}}
            <div class="upload-float">
                <div class="mx-auto w-16 h-16 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-2xl flex items-center justify-center shadow-lg mb-4">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="size-8 text-white">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
            </div>

            {{-- 上傳文字和按鈕 --}}
            <div class="mt-4">
                <label for="{{ $name }}" class="inline-flex items-center gap-2 cursor-pointer rounded-lg bg-white px-4 py-2.5 text-sm font-semibold text-indigo-600 shadow-sm ring-1 ring-inset ring-indigo-200 transition-all duration-200 hover:bg-indigo-50 hover:ring-indigo-300 hover:shadow-md">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                    </svg>
                    <span>選擇檔案上傳</span>
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
            </div>

            <p class="mt-3 text-sm text-gray-600">
                或將圖片拖放至此區域
            </p>

            {{-- 格式和大小限制說明 --}}
            <div class="mt-4 inline-flex items-center gap-2 rounded-lg bg-white/60 px-3 py-1.5 text-xs text-gray-600 backdrop-blur-sm">
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>支援 {{ $formats }}，檔案大小最大 {{ $maxSize }}</span>
            </div>
        </div>
    </div>

    {{-- 預覽區域 --}}
    @if($previewUrl)
        <div class="mt-6 animate-in fade-in duration-500">
            <p class="text-sm font-semibold text-gray-900 mb-3 flex items-center gap-2">
                <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                已上傳照片
            </p>
            <div class="relative inline-block group">
                <div class="absolute -inset-1 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-xl opacity-25 group-hover:opacity-50 blur transition duration-300"></div>
                <div class="relative">
                    <img
                        src="{{ $previewUrl }}"
                        alt="照片預覽"
                        class="h-40 w-40 rounded-xl object-cover shadow-lg ring-2 ring-white transition-transform duration-300 group-hover:scale-105"
                    />
                    {{-- 刪除按鈕 (hover 時顯示) --}}
                    <button type="button" class="absolute -top-2 -right-2 hidden group-hover:flex items-center justify-center w-8 h-8 bg-red-500 text-white rounded-full shadow-lg transition-all duration-200 hover:bg-red-600 hover:scale-110">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    @else
        {{-- TODO: 使用 Alpine.js 實作即時預覽 --}}
        <div class="mt-6 hidden animate-in fade-in duration-500" id="{{ $name }}-preview">
            <p class="text-sm font-semibold text-gray-900 mb-3">預覽:</p>
            <div class="relative inline-block group">
                <div class="absolute -inset-1 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-xl opacity-25 group-hover:opacity-50 blur transition duration-300"></div>
                <div class="relative">
                    <img
                        src=""
                        alt="照片預覽"
                        class="h-40 w-40 rounded-xl object-cover shadow-lg ring-2 ring-white"
                    />
                </div>
            </div>
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
