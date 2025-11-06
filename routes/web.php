<?php

use Illuminate\Support\Facades\Route;

// 首頁重定向到配方列表
Route::get('/', function () {
    return redirect('/recipes');
});

// 配方列表
Route::get('/recipes', function () {
    return view('recipes.index');
})->name('recipes.index');

// 建立配方表單
Route::get('/recipes/create', function () {
    return view('recipes.create');
})->name('recipes.create');

// 配方詳情
Route::get('/recipes/{id}', function ($id) {
    return view('recipes.show', ['recipeId' => $id]);
})->name('recipes.show');

// 編輯配方表單
Route::get('/recipes/{id}/edit', function ($id) {
    return view('recipes.edit', ['recipeId' => $id]);
})->name('recipes.edit');

// 版本歷史
Route::get('/recipes/{id}/versions', function ($id) {
    return view('recipes.version-history', ['recipeId' => $id]);
})->name('recipes.versions');

// 審核頁面
Route::get('/recipes/{id}/review', function ($id) {
    return view('recipes.review', ['recipeId' => $id]);
})->name('recipes.review');

// 表單提交路由 (僅佔位,無實際邏輯)
Route::post('/recipes', function () {
    return redirect('/recipes')->with('success', '配方已提交審核!');
})->name('recipes.store');

Route::put('/recipes/{id}', function ($id) {
    return redirect("/recipes/{$id}")->with('success', '配方已更新!');
})->name('recipes.update');
