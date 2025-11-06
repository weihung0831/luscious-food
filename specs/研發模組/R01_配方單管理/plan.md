# Implementation Plan: 配方管理介面 (Recipe Management UI)

**Branch**: `001-recipe-management-ui` | **Date**: 2025-11-06 | **Spec**: [spec.md](./spec.md)
**Input**: Feature specification from `specs/研發模組/R01_配方單管理/spec.md`

**Note**: 本規劃專注於 Blade + TailwindCSS 的畫面設計,不包含任何後端邏輯實作。

## Summary

本功能旨在為配方管理系統建立使用者介面,使用 Laravel Blade 模板引擎搭配 TailwindCSS 框架進行純 UI 設計。此階段僅專注於畫面規劃與 HTML/CSS 結構,不包含任何後端邏輯、資料處理或 JavaScript 互動邏輯。

主要畫面包含:
- 配方建立表單 (包含所有必填與選填欄位)
- 配方列表與多條件篩選介面
- 配方詳情檢視頁面
- 版本歷史檢視介面
- 主管審核介面

重點在於提供一致且直覺的使用者體驗,確保響應式設計(桌面與平板)和無障礙支援(WCAG 2.1 AA)。

## Technical Context

**Language/Version**: PHP ^8.2 (Laravel ^12.0)
**Primary Dependencies**:
  - Blade Template Engine (Laravel 內建)
  - TailwindCSS ^3.0 (前端 CSS 框架)
  - Vite ^5.0 (前端建置工具)
  - Alpine.js ^3.0 (NEEDS CLARIFICATION - 是否用於基礎互動,如表單驗證提示、下拉選單等)

**Storage**: N/A (僅 UI 規劃,不涉及資料儲存)
**Testing**: N/A (本階段不包含測試,僅產出靜態畫面)
**Target Platform**: Web (桌面瀏覽器 1920x1080+, 平板 768x1024+)
**Project Type**: Web Application (Laravel MVC 架構,僅規劃 View 層)
**Performance Goals**:
  - 頁面首次渲染時間 < 2 秒
  - TailwindCSS 打包後 CSS 檔案 < 50KB (使用 PurgeCSS)

**Constraints**:
  - 僅使用 Blade 模板語法,不撰寫 PHP 邏輯
  - 僅使用 TailwindCSS utility classes,不撰寫自訂 CSS
  - 不實作 JavaScript 邏輯(表單驗證、AJAX 請求等)
  - 使用靜態假資料展示畫面效果

**Scale/Scope**:
  - 約 8-10 個主要畫面/元件
  - 約 20-30 個可重用的 Blade 元件
  - 支援桌面與平板兩種裝置尺寸

## Constitution Check

*GATE: Must pass before Phase 0 research. Re-check after Phase 1 design.*

### ✅ 通過的檢查項目

| 檢查項目 | 狀態 | 說明 |
|---------|------|------|
| 程式碼品質原則 | ✅ PASS | 遵循 Laravel Blade 最佳實踐,使用元件化設計確保單一職責 |
| 使用者體驗一致性 | ✅ PASS | 使用 TailwindCSS 統一設計系統,確保介面一致性 |
| 效能要求 | ✅ PASS | 使用 TailwindCSS PurgeCSS 最小化 CSS 檔案大小 |
| 可維護性與文件化 | ✅ PASS | Blade 元件命名清晰,使用註解說明複雜結構 |
| 無障礙設計 | ✅ PASS | 遵循 WCAG 2.1 AA 標準,提供 label、aria 屬性等 |

### ⚠️  需要說明的項目

| 檢查項目 | 狀態 | 說明 |
|---------|------|------|
| 測試驅動開發 (TDD) | ⚠️  PARTIAL | 本階段僅規劃靜態畫面,不包含測試。後續實作邏輯時需補上測試 |
| 資料庫查詢最佳化 | N/A | 不涉及資料庫操作 |
| 安全性檢查 | N/A | 不涉及資料處理與驗證邏輯 |

**理由說明**: 本階段是 UI 原型規劃,目的是產出靜態畫面供團隊確認設計方向。測試、資料庫、安全性等議題將在後續實作階段處理。

## Project Structure

### Documentation (this feature)

```text
specs/
├── components.md        # 系統層級 UI 元件庫總覽索引 ✅
├── components/          # 元件規格詳細文件 (跨模組共用) ✅
│   ├── navigation.md    #   - 導航相關元件 (navbar, page-header, breadcrumb)
│   ├── forms.md         #   - 表單相關元件 (form-field, textarea-field, select-field, image-upload)
│   ├── feedback.md      #   - 回饋/提示元件 (status-badge, version-badge, alert, button, modal)
│   ├── tables.md        #   - 表格相關元件 (item-table, recipe-list-table, version-history-table)
│   └── filters.md       #   - 篩選相關元件 (filter-panel)
│
└── 研發模組/R01_配方單管理/
    ├── spec.md          # 功能規格文件 (已存在)
    ├── plan.md          # 本檔案 - 實作規劃
    ├── research.md      # Phase 0 研究結果
    ├── ui-design.md     # Phase 1 UI 設計規格
    ├── quickstart.md    # Phase 1 快速開始指南
    └── checklists/      # 檢查清單目錄 (已存在)
```

**說明**: 元件庫已提升至系統層級，供所有模組共用，確保全系統 UI 一致性

### Source Code (repository root)

**本階段僅規劃 View 層結構,不實作 Controller/Model**

```text
resources/
├── views/
│   └── recipes/                    # 配方管理相關畫面
│       ├── index.blade.php         # 配方列表頁面（顯示配方主檔）
│       ├── version-history.blade.php # 版本歷史頁面（單一配方的所有版本）
│       ├── create.blade.php        # 建立配方/新增版本表單頁面
│       ├── edit.blade.php          # 編輯版本表單頁面（基於 create 的變體）
│       ├── show.blade.php          # 版本詳情頁面（唯讀）
│       └── components/             # 可重用元件
│           ├── navbar.blade.php              # 全域導航列 ✅
│           ├── page-header.blade.php         # 頁面標題列 ✅
│           ├── form-field.blade.php          # 通用表單欄位 ✅
│           ├── textarea-field.blade.php      # 多行文字欄位 ✅
│           ├── select-field.blade.php        # 下拉選單 ✅
│           ├── image-upload.blade.php        # 照片上傳元件 ✅
│           ├── status-badge.blade.php        # 狀態徽章 ✅
│           ├── version-badge.blade.php       # 版本號徽章 ✅
│           ├── breadcrumb.blade.php          # 麵包屑導航 ✅
│           ├── alert.blade.php               # 提示訊息元件 ✅
│           ├── button.blade.php              # 按鈕元件 ✅
│           ├── item-table.blade.php          # 項目清單動態表格 ✅
│           ├── modal.blade.php               # 彈出視窗元件 ✅
│           ├── recipe-list-table.blade.php   # 配方列表表格 ✅
│           ├── version-history-table.blade.php # 版本歷史表格 ✅
│           └── filter-panel.blade.php        # 篩選面板 ✅
│
└── css/
    └── app.css                     # TailwindCSS 主檔案 (僅 @tailwind 指令)

public/
└── build/
    └── assets/
        └── app-*.css               # Vite 打包後的 CSS (由建置工具產生)
```

**Structure Decision**:
採用 Laravel 標準 MVC 架構中的 View 層結構。使用 `resources/views/recipes/` 作為配方管理的主要視圖目錄,並在其下建立 `components/` 子目錄存放可重用的 Blade 元件。

這種結構的優點:
1. **符合 Laravel 慣例**: 遵循 Laravel 官方建議的目錄結構
2. **元件化設計**: 透過 `components/` 目錄實現可重用元件,符合單一職責原則
3. **清晰的功能分離**: 主要頁面與元件分開,易於維護
4. **擴充性良好**: 未來新增其他功能模組時,可在 `resources/views/` 下建立新目錄

## Complexity Tracking

> **本專案無違反憲章項目,此表格為空**

| Violation | Why Needed | Simpler Alternative Rejected Because |
|-----------|------------|-------------------------------------|
| N/A | N/A | N/A |

## Phase 0: Research & Technology Decisions

### 需要研究的項目

以下項目標記為 NEEDS CLARIFICATION,需要在 Phase 0 進行研究:

1. **Alpine.js 使用範圍**
   - 問題: 是否使用 Alpine.js 處理基礎互動(如下拉選單、表單驗證提示、動態欄位新增/刪除)?
   - 研究方向:
     - Alpine.js 在 Laravel 專案中的整合方式
     - 使用 Alpine.js vs 純 TailwindCSS 的權衡
     - Alpine.js 對效能的影響

2. **TailwindCSS 設計系統配置**
   - 問題: 是否需要自訂 TailwindCSS 配置(顏色、字體、間距等)?
   - 研究方向:
     - 檢視專案是否已有設計系統或品牌指南
     - TailwindCSS 預設主題是否滿足需求
     - 如何建立可重用的 utility class 組合

3. **響應式設計斷點策略**
   - 問題: 桌面與平板的斷點如何設定?
   - 研究方向:
     - TailwindCSS 預設斷點 (sm, md, lg, xl, 2xl) 是否適用
     - 是否需要自訂斷點以符合目標裝置尺寸
     - 行動優先(mobile-first) vs 桌面優先(desktop-first) 策略

4. **Blade 元件組織方式**
   - 問題: 使用匿名元件 vs 類別元件?
   - 研究方向:
     - Laravel Blade 元件的最佳實踐
     - 何時使用匿名元件,何時使用類別元件
     - Slot vs Props 的選擇策略

5. **無障礙設計實作細節**
   - 問題: WCAG 2.1 AA 的具體實作要求?
   - 研究方向:
     - 表單欄位的 aria 屬性使用
     - 顏色對比度檢查工具
     - 鍵盤導航的實作方式(Tab, Enter, Esc 等)

### Research Output

research.md 檔案將包含以上研究項目的結論,並提供決策理由和實作指引。

## Phase 1: UI Design & Components Specification

### 產出檔案

1. **ui-design.md**: 詳細的 UI 設計規格
   - 每個頁面的 wireframe 描述
   - 主要互動流程說明
   - 配色方案與字體規劃
   - 響應式設計規則

2. **components.md**: Blade 元件詳細規格
   - 每個元件的用途說明
   - Props/Slots 定義
   - 使用範例
   - TailwindCSS classes 組合

3. **quickstart.md**: 開發環境設置與快速開始指南
   - Laravel + Vite + TailwindCSS 環境配置
   - Blade 元件使用說明
   - 常見問題排解

### 不產出的檔案

- ~~data-model.md~~: 不涉及資料模型設計
- ~~contracts/~~: 不涉及 API 設計
- ~~tasks.md~~: 由 `/speckit.tasks` 命令產生,不在此階段

## Next Steps

完成 Phase 1 後,團隊應:

1. **Review UI 設計**: 確認畫面設計符合需求
2. **實作靜態原型**: 根據 components.md 建立 Blade 檔案與假資料
3. **使用者測試**: 使用靜態原型進行可用性測試
4. **後續開發規劃**: 確認設計後,進入後端邏輯實作階段(另開新的 spec)

---

**狀態**: Phase 3 已完成（配方列表頁面實作完成）
**最後更新**: 2025-11-06

## 實作進度

- ✅ Phase 1: 基礎元件實作完成
- ✅ Phase 2: 配方建立頁面完成
- ✅ Phase 3: 配方列表頁面完成
- ⏸️ Phase 4: 版本歷史頁面（待開始）
- ⏸️ Phase 5: 配方詳情頁面（待開始）
- ⏸️ Phase 6: 配方編輯頁面（待開始）

## 已完成的元件

**Phase 1 & 2 元件**:
- ✅ page-header.blade.php - 頁面標題元件
- ✅ form-field.blade.php - 表單輸入欄位
- ✅ textarea-field.blade.php - 多行文字輸入
- ✅ select-field.blade.php - 下拉選單
- ✅ image-upload.blade.php - 圖片上傳
- ✅ button.blade.php - 按鈕元件（已簡化為實色設計）
- ✅ item-table.blade.php - 配方項目表格
- ✅ alert.blade.php - 提示訊息
- ✅ scroll-to-top.blade.php - 返回頂部按鈕

**Phase 3 元件**:
- ✅ recipe-list-table.blade.php - 配方列表表格（含完整視覺優化）
- ✅ filter-panel.blade.php - 篩選面板
- ✅ status-badge.blade.php - 狀態徽章
- ✅ version-badge.blade.php - 版本徽章

**已完成的頁面**:
- ✅ create.blade.php - 配方建立表單（按鈕文字改為「儲存版本」）
- ✅ index.blade.php - 配方列表頁面（含 5 筆示範資料）

## 視覺設計優化記錄

### 按鈕元件優化（button.blade.php）
- 從漸層背景改為實色背景
- 移除縮放動畫，改用簡單的顏色過渡
- Primary: `bg-indigo-600 hover:bg-indigo-700`
- Secondary: `bg-white ring-1 ring-gray-300 hover:bg-gray-50`

### 配方列表表格優化（recipe-list-table.blade.php）
- **表格標題列**: 漸層背景 `bg-gradient-to-r from-gray-50 to-gray-100/50`
- **表格列 Hover**: 漸層效果 `hover:from-indigo-50/30 hover:to-purple-50/20`
- **編號欄位**: 徽章樣式 `bg-gray-100 text-gray-700 font-mono`
- **版本數欄位**: 漸層背景 + 藍色標籤圖標
- **操作圖示**: 8x8 圓形按鈕，語意化顏色（藍/綠/橘/紅）
- **對齊方式**: 數字欄位置中，配方名稱靠左
