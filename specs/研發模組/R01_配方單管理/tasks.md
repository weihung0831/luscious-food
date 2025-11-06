# Implementation Tasks: 配方管理介面 (Recipe Management UI)

**Feature Branch**: `001-recipe-management-ui`
**Generated**: 2025-11-06
**Status**: Ready for Implementation
**Strategy**: 畫面與元件配對 - 每個頁面與其所需元件一起開發

---

## 📋 任務總覽

| 階段 | 畫面 | User Story | 任務數 | 新增元件數 | 狀態 |
|------|------|-----------|--------|----------|------|
| Phase 1 | - | Setup | 4 | 0 | ✅ Completed |
| Phase 2 | create.blade.php | US1 建立配方 | 10 | 9 | ✅ Completed |
| Phase 3 | index.blade.php | US3 列表頁 | 5 | 4 | ✅ Completed |
| Phase 4 | version-history.blade.php | US2 版本歷史 | 3 | 2 | Pending |
| Phase 5 | edit.blade.php | US2 編輯頁 | 1 | 0 | Pending |
| Phase 6 | show.blade.php | US4 詳情頁 | 3 | 2 | Pending |
| Phase 7 | - | Polish | 3 | 0 | Pending |
| **Total** | **5 個頁面** | **4 個 Stories** | **29** | **17** | - |

---

## 🎯 實作策略說明

### 為什麼這樣組織？

**原則：頁面與元件同步開發**

```
開發列表頁時 (Phase 3)：
├── T015: 建立 recipe-list-table 元件      ← 列表頁需要
├── T016: 建立 filter-panel 元件            ← 列表頁需要
├── T017: 建立 status-badge 元件            ← 列表頁需要
├── T018: 建立 version-badge 元件           ← 列表頁需要
└── T019: 建立 index.blade.php 並整合所有元件

✅ 完成 Phase 3 = 列表頁功能完整可用
```

### 與傳統方式的差異

| 傳統方式 ❌ | 本方式 ✅ |
|-----------|----------|
| 先做完所有元件 (13 個) | 按頁面需要才做元件 |
| 再做所有頁面 (5 個) | 頁面 + 元件一起完成 |
| 進度：元件 → 頁面 | 進度：功能 → 功能 |
| 風險：可能做了用不到的 | 效率：只做需要的 |

### MVP 範圍

**Phase 1-2 為 MVP**:
- Setup + 建立配方頁面 (create.blade.php)
- 完成後可立即交付「建立配方」核心功能
- 預估時間: ~5 hours

---

## Phase 1: Setup (專案初始化)

**Goal**: 設置 Laravel + Vite + TailwindCSS 開發環境

**Duration**: ~30 minutes

### Setup Tasks

- [x] T001 安裝並配置 TailwindCSS v3.0 in `tailwind.config.js`
- [x] T002 [P] 配置 Vite v5.0 for asset compilation in `vite.config.js`
- [x] T003 [P] 引入 @tailwindplus/elements v1.0 CDN in base layout `resources/views/layouts/app.blade.php`
- [x] T004 建立基礎目錄結構 `resources/views/recipes/` 和 `resources/views/recipes/components/`

**Completion Criteria**:
- ✅ `npm run dev` 成功執行
- ✅ TailwindCSS utility classes 可用
- ✅ 目錄結構符合 plan.md 定義

**Parallel Execution**: T002-T003 可並行

---

## Phase 2: US1 - 建立配方頁面 (create.blade.php) 🎯 MVP

**User Story**: 研發人員需要建立新產品配方時，能夠在配方建立表單中輸入完整的配方資訊

**Goal**: 實作配方建立表單頁面及其所需的所有元件

**Duration**: ~4 hours

**畫面**: `create.blade.php`

**需要的元件** (本 Phase 開發):
1. navbar - 全域導航列 (所有頁面共用)
2. page-header - 頁面標題列
3. form-field - 通用表單欄位 (text, number, date)
4. textarea-field - 多行文字欄位
5. select-field - 下拉選單
6. image-upload - 照片上傳
7. button - 按鈕 (primary, secondary, danger)
8. item-table - 項目清單動態表格
9. alert - 提示訊息

### Phase 2 Tasks

**Step 1: 建立該頁面需要的元件**

- [x] T005 [P] [US1] 建立 navbar 元件 (全域共用) in `resources/views/components/navbar.blade.php`
- [x] T006 [P] [US1] 建立 page-header 元件 in `resources/views/recipes/components/page-header.blade.php`
- [x] T007 [P] [US1] 建立 form-field 元件 in `resources/views/recipes/components/form-field.blade.php`
- [x] T008 [P] [US1] 建立 textarea-field 元件 in `resources/views/recipes/components/textarea-field.blade.php`
- [x] T009 [P] [US1] 建立 select-field 元件 in `resources/views/recipes/components/select-field.blade.php`
- [x] T010 [P] [US1] 建立 image-upload 元件 in `resources/views/recipes/components/image-upload.blade.php`
- [x] T011 [P] [US1] 建立 button 元件 in `resources/views/recipes/components/button.blade.php`
- [x] T012 [P] [US1] 建立 item-table 元件 in `resources/views/recipes/components/item-table.blade.php`
- [x] T013 [P] [US1] 建立 alert 元件 in `resources/views/recipes/components/alert.blade.php`

**Step 2: 建立頁面並整合所有元件**

- [x] T014 [US1] 建立 create.blade.php 並整合所有表單區塊 in `resources/views/recipes/create.blade.php`
  - 整合【配方主檔資訊】(form-field, textarea-field, image-upload)
  - 整合【版本資訊】(form-field, textarea-field, select-field)
  - 整合【測量數據】(form-field, select-field)
  - 整合【配方項目】(item-table)
  - 整合【穀物專用資訊】(form-field)
  - 整合【照片與備註】(image-upload, textarea-field)
  - 整合 page-header, button, alert

**Independent Test Criteria**:
- ✅ 訪問 `/recipes/create` 看到完整表單
- ✅ 所有必填欄位顯示 * 標記
- ✅ 可以上傳照片並看到預覽
- ✅ item-table 可以動態新增/刪除項目
- ✅ 百分比總和自動計算並顯示警告
- ✅ 點擊「提交審核」顯示成功訊息 (靜態)
- ✅ 響應式：桌面 1920x1080 和平板 768x1024 正常顯示

**Dependencies**: Phase 1

**Parallel Execution**: T005-T013 可並行實作（9 個元件同時開發）

---

## Phase 3: US3 - 配方列表頁面 (index.blade.php)

**User Story**: 使用者需要快速找到特定配方，使用多個條件篩選

**Goal**: 實作配方列表頁面及其所需的所有元件

**Duration**: ~2.5 hours

**畫面**: `index.blade.php`

**需要的元件** (本 Phase 開發):
1. recipe-list-table - 配方列表表格 (新)
2. filter-panel - 篩選面板 (新)
3. status-badge - 狀態徽章 (新)
4. version-badge - 版本號徽章 (新)

**重用的元件** (Phase 2):
- page-header
- button

### Phase 3 Tasks

**Step 1: 建立該頁面需要的元件**

- [x] T015 [P] [US3] 建立 recipe-list-table 元件 in `resources/views/recipes/components/recipe-list-table.blade.php`
- [x] T016 [P] [US3] 建立 filter-panel 元件 in `resources/views/recipes/components/filter-panel.blade.php`
- [x] T017 [P] [US3] 建立 status-badge 元件 in `resources/views/recipes/components/status-badge.blade.php`
- [x] T018 [P] [US3] 建立 version-badge 元件 in `resources/views/recipes/components/version-badge.blade.php`

**Step 2: 建立頁面並整合所有元件**

- [x] T019 [US3] 建立 index.blade.php 並整合列表與篩選功能 in `resources/views/recipes/index.blade.php`
  - 整合 filter-panel (關鍵字搜尋、狀態篩選、排序)
  - 整合 recipe-list-table (配方列表顯示)
  - 整合 page-header, button
  - 使用 status-badge 顯示配方狀態
  - 使用 version-badge 顯示版本號

**Independent Test Criteria**:
- ✅ 訪問 `/recipes` 看到配方列表
- ✅ 列表顯示：編號（徽章樣式）、配方名稱（含縮圖和說明）、版本數（漸層背景+圖標）、最新版本（version-badge）、最後更新、操作圖示
- ✅ 篩選面板提供：關鍵字搜尋、狀態篩選、排序
- ✅ 版本號使用 version-badge 正確顯示顏色
- ✅ 操作圖示：檢視（藍色）、版本（綠色）、編輯（橘色）、刪除（紅色），每個圖示 hover 時顯示對應顏色背景
- ✅ 表格視覺效果：標題列漸層背景、列 hover 漸層效果、版本數漸層背景
- ✅ 響應式：列表在桌面和平板正確顯示

**Dependencies**: Phase 2 (需要 page-header, button)

**Parallel Execution**: T015-T018 可並行實作（4 個元件同時開發）

---

## Phase 4: US2 - 版本歷史頁面 (version-history.blade.php)

**User Story**: 研發人員需要查看配方的所有版本歷史

**Goal**: 實作版本歷史頁面及其所需的所有元件

**Duration**: ~1.5 hours

**畫面**: `version-history.blade.php`

**需要的元件** (本 Phase 開發):
1. version-history-table - 版本歷史表格 (新)
2. breadcrumb - 麵包屑導航 (新)

**重用的元件** (Phase 2-3):
- page-header
- button
- version-badge

### Phase 4 Tasks

**Step 1: 建立該頁面需要的元件**

- [ ] T020 [P] [US2] 建立 version-history-table 元件 in `resources/views/recipes/components/version-history-table.blade.php`
- [ ] T021 [P] [US2] 建立 breadcrumb 元件 in `resources/views/recipes/components/breadcrumb.blade.php`

**Step 2: 建立頁面並整合所有元件**

- [ ] T022 [US2] 建立 version-history.blade.php 並整合版本列表 in `resources/views/recipes/version-history.blade.php`
  - 整合 breadcrumb (首頁 > 配方列表 > 配方名稱 > 版本歷史)
  - 整合 page-header (顯示配方名稱和編號)
  - 整合 version-history-table (版本列表)
  - 整合 button (新增版本按鈕)
  - 使用 version-badge 顯示版本號

**Independent Test Criteria**:
- ✅ 訪問 `/recipes/{id}/versions` 看到版本歷史
- ✅ 版本列表顯示：版本號、版本名稱、建立日期、研發目的、樣品數、PH值、糖度、操作
- ✅ 麵包屑導航正確顯示層級
- ✅ 操作按鈕：檢視、編輯、複製為新版本
- ✅ 版本號使用 version-badge 正確顯示
- ✅ 響應式：版本列表在桌面和平板正確顯示

**Dependencies**: Phase 3 (從列表頁進入版本歷史)

**Parallel Execution**: T020-T021 可並行實作（2 個元件同時開發）

---

## Phase 5: US2 - 編輯頁面 (edit.blade.php)

**User Story**: 研發人員需要編輯或複製現有版本建立新版本

**Goal**: 實作編輯頁面（重用 create.blade.php 結構）

**Duration**: ~30 minutes

**畫面**: `edit.blade.php`

**需要的元件** (本 Phase 開發): 無（完全重用 Phase 2 元件）

**重用的元件** (Phase 2):
- page-header
- form-field
- textarea-field
- select-field
- image-upload
- button
- item-table
- alert

### Phase 5 Tasks

- [ ] T023 [US2] 建立 edit.blade.php (複用 create.blade.php 結構) in `resources/views/recipes/edit.blade.php`
  - 複用 create.blade.php 的所有表單區塊
  - 修改 page-header 顯示「編輯版本」標題
  - 預填表單資料（使用靜態資料模擬）
  - 修改提交按鈕文字為「更新版本」

**Independent Test Criteria**:
- ✅ 訪問 `/recipes/{id}/edit` 看到編輯表單
- ✅ 表單自動填入該版本的所有資訊
- ✅ 可以修改任何欄位
- ✅ 點擊「更新版本」顯示成功訊息 (靜態)
- ✅ 表單結構與 create.blade.php 一致

**Dependencies**: Phase 4 (從版本歷史點擊編輯進入)

**Parallel Execution**: 無（單一任務）

---

## Phase 6: US4 - 詳情頁面 (show.blade.php)

**User Story**: 主管需要審核研發人員提交的配方

**Goal**: 實作配方詳情頁面及審核功能

**Duration**: ~2 hours

**畫面**: `show.blade.php`

**需要的元件** (本 Phase 開發):
1. modal - 彈出視窗 (新，用於審核確認對話框)

**重用的元件** (Phase 2-3):
- page-header
- status-badge
- version-badge
- button
- textarea-field (審核意見輸入)

### Phase 6 Tasks

**Step 1: 建立該頁面需要的元件**

- [ ] T024 [P] [US4] 建立 modal 元件 in `resources/views/recipes/components/modal.blade.php`

**Step 2: 建立頁面並整合所有元件**

- [ ] T025 [US4] 建立 show.blade.php 並整合詳情顯示 in `resources/views/recipes/show.blade.php`
  - 整合 page-header (顯示配方名稱、版本號、狀態徽章)
  - 整合配方資訊顯示區塊（所有欄位唯讀）
  - 使用 status-badge 顯示當前狀態
  - 使用 version-badge 顯示版本號

- [ ] T026 [US4] 整合審核操作區塊 in `show.blade.php`
  - 整合審核按鈕（核准、退回）
  - 整合 modal 確認對話框
  - modal 中使用 textarea-field 輸入審核意見
  - 整合 button (核准、退回、取消)

**Independent Test Criteria**:
- ✅ 訪問 `/recipes/{id}` 看到完整配方資訊
- ✅ 所有欄位以唯讀模式顯示
- ✅ 狀態徽章正確顯示
- ✅ 「核准」和「退回」按鈕僅在「待審核」狀態顯示
- ✅ 點擊審核按鈕彈出 modal 確認對話框
- ✅ modal 中可輸入審核意見
- ✅ 確認後顯示成功訊息 (靜態)
- ✅ 響應式：詳情頁在桌面和平板正確顯示

**Dependencies**: Phase 3 (從列表頁點擊檢視進入)

**Parallel Execution**: T024 可獨立實作，T025-T026 依序執行

---

## Phase 7: Polish & Integration (整合與優化)

**Goal**: 整合所有頁面、優化體驗、準備交付

**Duration**: ~1 hour

### Polish Tasks

- [ ] T027 [P] 統一所有頁面的 navbar 和 page-header 樣式
- [ ] T028 [P] 為所有頁面新增 breadcrumb 導航（除列表頁外）
- [ ] T029 測試所有頁面間的導航連結並進行響應式測試
  - 測試 navbar 連結
  - 測試 breadcrumb 導航
  - 測試表格內連結（檢視、編輯、版本歷史）
  - 測試響應式（桌面 1920x1080 和平板 768x1024）
  - 測試無障礙（鍵盤導航、螢幕閱讀器）
  - 執行 `npm run build` 驗證 CSS < 50KB

**Completion Criteria**:
- ✅ 所有頁面可正確導航
- ✅ 所有元件樣式一致
- ✅ 響應式設計在目標裝置上正常運作
- ✅ 無障礙標準符合 WCAG 2.1 AA
- ✅ 效能目標達成（首次渲染 < 2 秒，CSS < 50KB）

**Parallel Execution**: T027-T028 可並行實作

---

## 📊 Dependencies & Execution Order

### Critical Path (必須依序執行)

```
Phase 1 (Setup)
    ↓
Phase 2 (建立配方頁 + 元件) ← MVP Core
    ↓
Phase 3 (列表頁 + 元件)
    ↓
Phase 4 (版本歷史頁 + 元件)
    ↓
Phase 5 (編輯頁)
    ↓
Phase 6 (詳情頁 + 元件)
    ↓
Phase 7 (Polish)
```

### 頁面與元件關係圖

```
create.blade.php (Phase 2)
├── navbar ✅
├── page-header ✅
├── form-field ✅
├── textarea-field ✅
├── select-field ✅
├── image-upload ✅
├── button ✅
├── item-table ✅
└── alert ✅

index.blade.php (Phase 3)
├── page-header (重用 Phase 2)
├── button (重用 Phase 2)
├── recipe-list-table ✅ 新
├── filter-panel ✅ 新
├── status-badge ✅ 新
└── version-badge ✅ 新

version-history.blade.php (Phase 4)
├── page-header (重用 Phase 2)
├── button (重用 Phase 2)
├── version-badge (重用 Phase 3)
├── version-history-table ✅ 新
└── breadcrumb ✅ 新

edit.blade.php (Phase 5)
└── 完全重用 Phase 2 所有元件

show.blade.php (Phase 6)
├── page-header (重用 Phase 2)
├── button (重用 Phase 2)
├── textarea-field (重用 Phase 2)
├── status-badge (重用 Phase 3)
├── version-badge (重用 Phase 3)
└── modal ✅ 新
```

### Parallel Opportunities by Phase

**Phase 2**: 9 個元件 (T005-T013) 可並行
**Phase 3**: 4 個元件 (T015-T018) 可並行
**Phase 4**: 2 個元件 (T020-T021) 可並行
**Phase 6**: T024 可獨立實作
**Phase 7**: 2 個任務 (T027-T028) 可並行

**總並行機會**: 17/29 = 59% 的任務可並行執行

---

## 🎯 Suggested MVP Scope

**MVP = Phase 1 + Phase 2**

**交付內容**:
- ✅ 完整的配方建立表單頁面 (create.blade.php)
- ✅ 該頁面需要的 9 個元件
- ✅ 符合 FR-001 到 FR-007 的功能需求

**可測試的價值**:
研發人員可以建立新配方，輸入所有必填和選填欄位，上傳照片，管理配方項目，送出配方。

**預估時間**: ~5 hours

---

## 📝 Implementation Notes

### 開發順序建議

**按 Phase 順序開發**，每個 Phase 內：

1. **先並行開發所有元件** (標記 [P] 的任務)
   - 例如 Phase 2: 同時開發 T005-T013 的 9 個元件

2. **再開發頁面並整合**
   - 例如 Phase 2: 開發 T014 (create.blade.php)，整合剛完成的 9 個元件

3. **測試該頁面功能完整性**
   - 確認 Independent Test Criteria 全部通過

4. **進入下一個 Phase**

### 靜態資料模擬範例

**配方列表** (Phase 3 使用):
```php
@php
$recipes = [
    ['id' => 1, 'code' => '#0001', 'name' => '紅豆湯', 'latest_version' => 'v3',
     'created_at' => '2025-11-01', 'status' => 'active', 'status_label' => '使用中'],
    ['id' => 2, 'code' => '#0002', 'name' => '糙米粥', 'latest_version' => 'v1',
     'created_at' => '2025-11-05', 'status' => 'draft', 'status_label' => '草稿'],
];
@endphp
```

**版本歷史** (Phase 4 使用):
```php
@php
$versions = [
    ['id' => 1, 'version_name' => 'v1', 'version_label' => '傳統版',
     'created_at' => '2025-11-01', 'purpose' => '經典配方，保留傳統風味',
     'sample_quantity' => 10, 'sample_unit' => '罐', 'ph_value' => '6.5', 'brix_value' => '15.0'],
];
@endphp
```

### 元件引用方式

- 全域元件: `<x-navbar />`
- 配方模組元件: `<x-recipes.button />`, `<x-recipes.form-field />`

---

## ✅ Validation Checklist

完成實作後，請確認：

### 功能完整性
- [ ] 所有 29 個任務已完成
- [ ] 5 個主要頁面可正常訪問
- [ ] 17 個元件規格與 `/specs/components/` 定義一致
- [ ] 所有 User Story 的 Independent Test 通過

### 品質標準
- [ ] 響應式測試通過（桌面 1920x1080+, 平板 768x1024+）
- [ ] 無障礙測試通過（WCAG 2.1 AA）
- [ ] 效能測試通過（首次渲染 < 2 秒，CSS < 50KB）
- [ ] 程式碼遵循 Laravel Blade 最佳實踐

### 頁面導航
- [ ] navbar 所有連結可用
- [ ] breadcrumb 導航正確
- [ ] 表格內操作連結正確（檢視、編輯、版本歷史、複製）
- [ ] 所有按鈕功能正常（即使是靜態模擬）

---

**Generated by**: Claude Code (speckit.tasks)
**Next Step**: 開始 Phase 1 Setup，執行 T001-T004
**Key Point**: 每個 Phase 完成後，該頁面即可獨立展示和測試！
**Contact**: 參考 `/specs/components.md` 查看所有元件規格
