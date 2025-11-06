@props([
    'recipes' => [],
    'showCheckbox' => true,
    'emptyMessage' => '尚無配方資料',
])

<div class="flow-root" x-data="{
    showDeleteModal: false,
    deleteRecipeId: null,
    deleteRecipeName: '',
    confirmDelete(id, name) {
        this.deleteRecipeId = id;
        this.deleteRecipeName = name;
        this.showDeleteModal = true;
    },
    handleDelete() {
        // TODO: 實際刪除邏輯 (發送 DELETE 請求)
        console.log('刪除配方 ID:', this.deleteRecipeId);
        // 這裡可以使用 fetch 或表單提交
        // fetch(`/recipes/${this.deleteRecipeId}`, { method: 'DELETE' })
        this.showDeleteModal = false;
    }
}">
    {{-- 桌面版：表格呈現 --}}
    <div class="hidden md:block overflow-x-auto -mx-4 sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full py-2 align-middle px-4 sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-lg outline-1 outline-black/5 rounded-xl border border-gray-100">
                <table class="min-w-full divide-y divide-gray-200">
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
                            <th scope="col" class="py-3.5 pr-3 pl-4 text-center text-sm font-semibold text-gray-900 sm:pl-6">編號</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">配方名稱</th>
                            <th scope="col" class="px-3 py-3.5 text-center text-sm font-semibold text-gray-900">版本數</th>
                            <th scope="col" class="px-3 py-3.5 text-center text-sm font-semibold text-gray-900">最新版本</th>
                            <th scope="col" class="px-3 py-3.5 text-center text-sm font-semibold text-gray-900">最後更新</th>
                            <th scope="col" class="py-3.5 pr-4 pl-3 text-center text-sm font-semibold text-gray-900 sm:pr-6">操作</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 bg-white">
                        @forelse($recipes as $recipe)
                            <tr class="group hover:bg-gradient-to-r hover:from-indigo-50/40 hover:to-purple-50/30 transition-all duration-200 hover:shadow-sm">
                                {{-- 多選框 --}}
                                @if($showCheckbox)
                                    <td class="py-4 pr-3 pl-4 text-center align-middle sm:pl-6">
                                        <input
                                            type="checkbox"
                                            name="selected_recipes[]"
                                            value="{{ $recipe['id'] }}"
                                            class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-600 size-4"
                                            aria-label="選取 {{ $recipe['name'] }}"
                                        />
                                    </td>
                                @endif

                                {{-- 編號 --}}
                                <td class="py-4 pr-3 pl-4 text-sm whitespace-nowrap text-center sm:pl-6">
                                    <span class="inline-flex items-center px-3 py-1 rounded-lg bg-gradient-to-r from-purple-100 to-indigo-100 text-purple-800 font-mono text-xs font-bold shadow-sm ring-1 ring-purple-200/50 group-hover:shadow-md transition-all duration-200">
                                        {{ $recipe['code'] ?? '0000' }}
                                    </span>
                                </td>

                                {{-- 配方名稱 --}}
                                <td class="px-3 py-4 text-sm">
                                    <div class="flex items-center gap-x-3">
                                        {{-- 配方主圖縮圖 (如果有) --}}
                                        @if(!empty($recipe['image_url']))
                                            <img
                                                src="{{ $recipe['image_url'] }}"
                                                alt="{{ $recipe['name'] }}"
                                                class="rounded-lg size-10 object-cover ring-1 ring-gray-200"
                                            />
                                        @endif
                                        <div>
                                            <div class="font-semibold text-gray-900">{{ $recipe['name'] }}</div>
                                            @if(!empty($recipe['description']))
                                                <div class="mt-0.5 text-xs text-gray-500">{{ $recipe['description'] }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </td>

                                {{-- 版本數 --}}
                                <td class="px-3 py-4 text-sm whitespace-nowrap text-center">
                                    <a href="{{ $recipe['versions_url'] ?? '#' }}" class="group/version inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-gradient-to-br from-blue-50 to-indigo-50 hover:from-blue-100 hover:to-indigo-100 transition-all duration-200 shadow-sm hover:shadow-md ring-1 ring-blue-100 hover:ring-blue-200">
                                        <svg class="w-4 h-4 text-blue-600 group-hover/version:scale-110 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2.994 2.994 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                        </svg>
                                        <span class="text-blue-700 font-semibold text-xs">{{ $recipe['version_count'] ?? 1 }} 個版本</span>
                                    </a>
                                </td>

                                {{-- 最新版本 --}}
                                <td class="px-3 py-4 text-sm whitespace-nowrap text-center">
                                    <x-recipes.version-badge :version="$recipe['latest_version'] ?? 'v1'" />
                                </td>

                                {{-- 最後更新 --}}
                                <td class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap text-center">
                                    {{ $recipe['updated_at'] ?? '-' }}
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

    {{-- 手機版：卡片式呈現 --}}
    <div class="md:hidden space-y-4">
        @forelse($recipes as $recipe)
            <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden hover:shadow-xl transition-all duration-200">
                {{-- 卡片頂部：編號 + 核取框 --}}
                <div class="bg-gradient-to-r from-indigo-50/50 via-purple-50/30 to-pink-50/20 px-4 py-3 flex items-center justify-between">
                    <div class="flex items-center gap-x-3">
                        @if($showCheckbox)
                            <input
                                type="checkbox"
                                name="selected_recipes[]"
                                value="{{ $recipe['id'] }}"
                                class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-600 size-4"
                                aria-label="選取 {{ $recipe['name'] }}"
                            />
                        @endif
                        <span class="inline-flex items-center px-3 py-1 rounded-lg bg-gradient-to-r from-purple-100 to-indigo-100 text-purple-800 font-mono text-xs font-bold shadow-sm ring-1 ring-purple-200/50">
                            {{ $recipe['code'] ?? '0000' }}
                        </span>
                    </div>
                    <x-recipes.version-badge :version="$recipe['latest_version'] ?? 'v1'" />
                </div>

                {{-- 卡片內容 --}}
                <div class="p-4 space-y-3">
                    {{-- 配方名稱與圖片 --}}
                    <div class="flex items-start gap-x-3">
                        @if(!empty($recipe['image_url']))
                            <img
                                src="{{ $recipe['image_url'] }}"
                                alt="{{ $recipe['name'] }}"
                                class="rounded-lg size-16 object-cover ring-1 ring-gray-200 flex-shrink-0"
                            />
                        @endif
                        <div class="flex-1 min-w-0">
                            <h3 class="text-base font-semibold text-gray-900 truncate">{{ $recipe['name'] }}</h3>
                            @if(!empty($recipe['description']))
                                <p class="mt-1 text-sm text-gray-500 line-clamp-2">{{ $recipe['description'] }}</p>
                            @endif
                        </div>
                    </div>

                    {{-- 資訊列 --}}
                    <div class="flex items-center justify-between text-sm pt-2 border-t border-gray-100">
                        <div class="flex items-center gap-x-4">
                            {{-- 版本數 --}}
                            <a href="{{ $recipe['versions_url'] ?? '#' }}" class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-gradient-to-br from-blue-50 to-indigo-50 hover:from-blue-100 hover:to-indigo-100 transition-all duration-200">
                                <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2.994 2.994 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                </svg>
                                <span class="text-blue-700 font-semibold text-xs">{{ $recipe['version_count'] ?? 1 }}</span>
                            </a>

                            {{-- 更新時間 --}}
                            <div class="flex items-center gap-1 text-gray-500">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span class="text-xs">{{ $recipe['updated_at'] ?? '-' }}</span>
                            </div>
                        </div>
                    </div>

                    {{-- 操作按鈕 --}}
                    <x-recipes.mobile-action-buttons
                        :viewUrl="$recipe['view_url'] ?? '#'"
                        :editUrl="$recipe['edit_url'] ?? '#'"
                        :deleteId="$recipe['id']"
                        :deleteName="$recipe['name']"
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
        title="確認刪除配方"
        item-name="deleteRecipeName"
        confirm-text="確認刪除"
        cancel-text="取消"
        confirm-variant="danger"
        @click="handleDelete()"
    />
</div>
