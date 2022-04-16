<?php

use Illuminate\Support\Facades\Route;

use App\Models\Reagent;
use Illuminate\Http\Request;
use App\Http\Controllers\ReagentsController;//追記
use App\Http\Controllers\Auth\LoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// TOPページ表示
Route::get('/', [ReagentsController::class, 'index'])->middleware('auth');
// ->middleware('auth')これをつけるとログインがない状態ではログインページにいくことになる
// ただし、laravel自体に備わっている認証機能のため、設定が簡単になっている。

// 検索フォーム追記
Route::get('reagents', [ReagentsController::class, 'search']);

 // 項目を追加
Route::post('reagents', [ReagentsController::class, 'store']);
 
 //更新画面表示
Route::get('reagentsedit/{reagent}', [ReagentsController::class, 'edit']);

//更新処理
Route::post('reagents/update', [ReagentsController::class, 'update']);
 
 // 項目削除
Route::delete('reagent/{reagent}', [ReagentsController::class, 'destroy']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
