@props([
    'versions' => [],
    'recipeId' => null,
    'showCheckbox' => true,
    'emptyMessage' => '尚無版本資料',
])

<div class="flow-root" x-data="{
    showDeleteModal: false,
    deleteVersionId: null,
    deleteVersionName: '',
    confirmDelete(id, name) {
        this.deleteVersionId = id;
        this.deleteVersionName = name;
        this.showDeleteModal = true;
    },
    handleDelete() {
        // TODO: 實際刪除邏輯 (發送 DELETE 請求)
        console.log('刪除版本 ID:', this.deleteVersionId);
        this.showDeleteModal = false;
    }
}">
    {{-- 桌面版：表格呈現 --}}
    <div class="hidden md:block overflow-x-auto -mx-4 sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full py-2 align-middle px-4 sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-xl rounded-2xl border border-gray-200/60 bg-white backdrop-blur-sm">
                <table class="min-w-full">
                    <thead class="bg-gradient-to-r from-indigo-50/50 via-purple-50/30 to-pink-50/20">
                        <tr>
                            @if($showCheckbox)
                                <th scope="col" class="py-3.5 pr-3 pl-4 text-center sm:pl-6">
                                    <input
                                        type="checkbox"
                                        class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-600 size-4"
                                        aria-label="全選"
                                    />
                                </th>
                            @endif
                            <th scope="col" class="py-3.5 pr-3 pl-4 text-center text-sm font-semibold text-gray-900 sm:pl-6">版本號</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">版本標籤</th>
                            <th scope="col" class="px-3 py-3.5 text-center text-sm font-semibold text-gray-900">建立日期</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">研發目的</th>
                            <th scope="col" class="px-3 py-3.5 text-center text-sm font-semibold text-gray-900">樣品數</th>
                            <th scope="col" class="px-3 py-3.5 text-center text-sm font-semibold text-gray-900">PH值</th>
                            <th scope="col" class="px-3 py-3.5 text-center text-sm font-semibold text-gray-900">糖度</th>
                            <th scope="col" class="py-3.5 pr-4 pl-3 text-center text-sm font-semibold text-gray-900 sm:pr-6">操作</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100/50 bg-white">
                        @forelse($versions as $version)
                            <tr class="group hover:bg-gradient-to-r hover:from-indigo-50/60 hover:via-purple-50/40 hover:to-pink-50/30 transition-all duration-300 hover:shadow-lg hover:scale-[1.01] hover:z-10 relative">
                                {{-- 多選框 --}}
                                @if($showCheckbox)
                                    <td class="py-4 pr-3 pl-4 text-center align-middle sm:pl-6">
                                        <input
                                            type="checkbox"
                                            name="selected_versions[]"
                                            value="{{ $version['id'] }}"
                                            class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-600 size-4"
                                            aria-label="選取版本 {{ $version['version_name'] ?? '' }}"
                                        />
                                    </td>
                                @endif

                                {{-- 版本號 --}}
                                <td class="py-4 pr-3 pl-4 text-sm whitespace-nowrap text-center sm:pl-6">
                                    <x-recipes.version-badge :version="$version['version_name'] ?? 'v1'" />
                                </td>

                                {{-- 版本標籤 --}}
                                <td class="px-3 py-4 text-sm">
                                    <div class="font-medium text-gray-900">{{ $version['version_label'] ?? '-' }}</div>
                                </td>

                                {{-- 建立日期 --}}
                                <td class="px-3 py-4 text-sm whitespace-nowrap text-center">
                                    <div class="inline-flex items-center gap-1.5 text-gray-600">
                                        <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        <span>{{ $version['created_at'] ?? '-' }}</span>
                                    </div>
                                </td>

                                {{-- 研發目的 --}}
                                <td class="px-3 py-4 text-sm text-gray-600 max-w-xs">
                                    <div class="line-clamp-2">{{ $version['purpose'] ?? '-' }}</div>
                                </td>

                                {{-- 樣品數 --}}
                                <td class="px-3 py-4 text-sm whitespace-nowrap text-center">
                                    @if(!empty($version['sample_quantity']))
                                        <span class="inline-flex items-center gap-0.5 px-3 py-1.5 rounded-full bg-gradient-to-r from-emerald-500 to-teal-500 text-white font-semibold text-xs shadow-md hover:shadow-lg transition-all duration-200 hover:scale-105">
                                            {{ $version['sample_quantity']  }} <span class="opacity-90">{{ $version['sample_unit'] ?? '' }}</span>
                                        </span>
                                    @else
                                        <span class="text-gray-400 text-xs">-</span>
                                    @endif
                                </td>

                                {{-- PH值 --}}
                                <td class="px-3 py-4 text-sm whitespace-nowrap text-center">
                                    @if(!empty($version['ph_value']))
                                        <span class="inline-flex items-center px-3 py-1.5 rounded-full bg-gradient-to-r from-blue-500 to-cyan-500 text-white font-semibold text-xs shadow-md hover:shadow-lg transition-all duration-200 hover:scale-105">
                                            {{ $version['ph_value'] }}
                                        </span>
                                    @else
                                        <span class="text-gray-400 text-xs">-</span>
                                    @endif
                                </td>

                                {{-- 糖度 --}}
                                <td class="px-3 py-4 text-sm whitespace-nowrap text-center">
                                    @if(!empty($version['brix_value']))
                                        <span class="inline-flex items-center px-3 py-1.5 rounded-full bg-gradient-to-r from-orange-500 to-amber-500 text-white font-semibold text-xs shadow-md hover:shadow-lg transition-all duration-200 hover:scale-105">
                                            {{ $version['brix_value'] }}<span class="opacity-90">°Bx</span>
                                        </span>
                                    @else
                                        <span class="text-gray-400 text-xs">-</span>
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

    {{-- 手機版：卡片式呈現 --}}
    <div class="md:hidden space-y-4">
        @forelse($versions as $version)
            <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden hover:shadow-xl transition-all duration-200">
                {{-- 卡片頂部：版本號 --}}
                <div class="bg-gradient-to-r from-indigo-50/50 via-purple-50/30 to-pink-50/20 px-4 py-3 flex items-center justify-between">
                    <div class="flex items-center gap-x-3">
                        @if($showCheckbox)
                            <input
                                type="checkbox"
                                name="selected_versions[]"
                                value="{{ $version['id'] }}"
                                class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-600 size-4"
                                aria-label="選取版本 {{ $version['version_name'] ?? '' }}"
                            />
                        @endif
                        <x-recipes.version-badge :version="$version['version_name'] ?? 'v1'" />
                        <span class="text-sm font-semibold text-gray-900">{{ $version['version_label'] ?? '-' }}</span>
                    </div>
                </div>

                {{-- 卡片內容 --}}
                <div class="p-4 space-y-3">
                    {{-- 建立日期 --}}
                    <div class="flex items-center gap-2 text-sm text-gray-500">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <span>{{ $version['created_at'] ?? '-' }}</span>
                    </div>

                    {{-- 研發目的 --}}
                    <div>
                        <div class="text-xs font-medium text-gray-500 mb-1">研發目的</div>
                        <div class="text-sm text-gray-900">{{ $version['purpose'] ?? '-' }}</div>
                    </div>

                    {{-- 測量數據 --}}
                    <div class="flex items-center gap-x-3 text-sm pt-2 border-t border-gray-100">
                        @if(!empty($version['sample_quantity']))
                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg bg-gradient-to-br from-emerald-50 to-teal-50 text-emerald-700 font-semibold text-xs ring-1 ring-emerald-100">
                                {{ $version['sample_quantity'] }} {{ $version['sample_unit'] ?? '' }}
                            </span>
                        @endif
                        @if(!empty($version['ph_value']))
                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg bg-gradient-to-br from-blue-50 to-indigo-50 text-blue-700 font-semibold text-xs ring-1 ring-blue-100">
                                pH {{ $version['ph_value'] }}
                            </span>
                        @endif
                        @if(!empty($version['brix_value']))
                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg bg-gradient-to-br from-amber-50 to-orange-50 text-amber-700 font-semibold text-xs ring-1 ring-amber-100">
                                {{ $version['brix_value'] }}°Bx
                            </span>
                        @endif
                    </div>

                    {{-- 操作按鈕 --}}
                    <x-recipes.mobile-action-buttons
                        :viewUrl="$version['view_url'] ?? '#'"
                        :editUrl="$version['edit_url'] ?? '#'"
                        :deleteId="$version['id']"
                        :deleteName="$version['version_name'] ?? ''"
                        :copyUrl="$version['copy_url'] ?? '#'"
                        :showCopy="true"
                    />
                </div>
            </div>
        @empty
            <div class="bg-white rounded-xl shadow-lg border border-gray-100 px-4 py-8 text-center">
                <p class="text-sm text-gray-500">{{ $emptyMessage }}</p>
            </div>
        @endforelse
    </div>

    {{-- 刪除確認 Modal --}}
    <x-recipes.confirm-modal
        show="showDeleteModal"
        title="確認刪除版本"
        item-name="deleteVersionName"
        confirm-text="確認刪除"
        cancel-text="取消"
        confirm-variant="danger"
        @click="handleDelete()"
    />
</div>
