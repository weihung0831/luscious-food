@props([
    'viewUrl' => '#',
    'editUrl' => '#',
    'deleteId' => null,
    'deleteName' => '',
    'copyUrl' => null,
    'showCopy' => false,
])

<div class="flex items-center justify-center gap-x-1">
    {{-- 檢視 --}}
    <a href="{{ $viewUrl }}" class="group/btn inline-flex items-center justify-center w-9 h-9 rounded-xl bg-gradient-to-br from-blue-50 to-cyan-50 text-blue-600 hover:from-blue-500 hover:to-cyan-500 hover:text-white hover:shadow-lg hover:scale-110 transition-all duration-300" title="檢視">
        <svg class="w-4.5 h-4.5 group-hover/btn:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
        </svg>
        <span class="sr-only">檢視</span>
    </a>

    {{-- 編輯 --}}
    <a href="{{ $editUrl }}" class="group/btn inline-flex items-center justify-center w-9 h-9 rounded-xl bg-gradient-to-br from-orange-50 to-amber-50 text-orange-600 hover:from-orange-500 hover:to-amber-500 hover:text-white hover:shadow-lg hover:scale-110 transition-all duration-300" title="編輯">
        <svg class="w-4.5 h-4.5 group-hover/btn:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
        </svg>
        <span class="sr-only">編輯</span>
    </a>

    {{-- 複製 (選用) --}}
    @if($showCopy && $copyUrl)
        <a href="{{ $copyUrl }}" class="group/btn inline-flex items-center justify-center w-9 h-9 rounded-xl bg-gradient-to-br from-green-50 to-emerald-50 text-green-600 hover:from-green-500 hover:to-emerald-500 hover:text-white hover:shadow-lg hover:scale-110 transition-all duration-300" title="複製為新版本">
            <svg class="w-4.5 h-4.5 group-hover/btn:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 17.25v3.375c0 .621-.504 1.125-1.125 1.125h-9.75a1.125 1.125 0 01-1.125-1.125V7.875c0-.621.504-1.125 1.125-1.125H6.75a9.06 9.06 0 011.5.124m7.5 10.376h3.375c.621 0 1.125-.504 1.125-1.125V11.25c0-4.46-3.243-8.161-7.5-8.876a9.06 9.06 0 00-1.5-.124H9.375c-.621 0-1.125.504-1.125 1.125v3.5m7.5 10.375H9.375a1.125 1.125 0 01-1.125-1.125v-9.25m12 6.625v-1.875a3.375 3.375 0 00-3.375-3.375h-1.5a1.125 1.125 0 01-1.125-1.125v-1.5a3.375 3.375 0 00-3.375-3.375H9.75" />
            </svg>
            <span class="sr-only">複製</span>
        </a>
    @endif

    {{-- 刪除 --}}
    <button
        type="button"
        @click="confirmDelete('{{ $deleteId }}', '{{ $deleteName }}')"
        class="group/btn inline-flex items-center justify-center w-9 h-9 rounded-xl bg-gradient-to-br from-red-50 to-pink-50 text-red-600 hover:from-red-500 hover:to-pink-500 hover:text-white hover:shadow-lg hover:scale-110 transition-all duration-300"
        title="刪除"
    >
        <svg class="w-4.5 h-4.5 group-hover/btn:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
        </svg>
        <span class="sr-only">刪除</span>
    </button>
</div>
