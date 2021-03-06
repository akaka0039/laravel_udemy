<?php

use Illuminate\Support\Facades\Route;

//20211024_add
use App\Http\Controllers\ComponentTestController;

//20211031_add
use App\Http\Controllers\LifeCycleTestController;

use App\Http\Controllers\User\ItemController;
use App\Http\Controllers\User\CartController;



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

Route::get('/', function () {
    return view('user.welcome');
});

// 20220214_コメント
// ミドルウェアとは
// アプリケーションに入るHTTPリクエストを検査およびフィルタリングするための便利なメカニズムを提供

Route::middleware(['auth:users'])->group(function () {
    // index
    Route::get('/', [
        ItemController::class,
        'index'
    ])->name('items.index');
    // show
    Route::get(
        'show/{item}',
        [ItemController::class, 'show']
    )->name('items.show');
});

// グループ内の各ルートに特定のURIをプレフィックスとして付けることができる
// グループ内の全てのルートURLの前に「cart」を付与することができる

Route::prefix('cart')->middleware(['auth:users'])->group(function () {
    // add
    Route::post('add', [
        CartController::class,
        'add'
    ])->name('cart.add');
    // index
    Route::get('/', [
        CartController::class,
        'index'
    ])->name('cart.index');
    // delete
    Route::post('delete/{item}', [
        CartController::class,
        'delete'
    ])->name('cart.delete');
    // 
    Route::get('checkout', [
        CartController::class,
        'checkout'
    ])->name('cart.checkout');
    // 支払い成功
    Route::get('success', [
        CartController::class,
        'success'
    ])->name('cart.success');
    // 支払い失敗
    Route::get('cancel', [
        CartController::class,
        'cancel'
    ])->name('cart.cancel');
});



// //20211024_add
// Route::get('/component-test1', [ComponentTestController::class, 'showComponent1']);
// Route::get('/component-test2', [ComponentTestController::class, 'showComponent2']);

// //20211031_add for content
// Route::get('/service-container-test', [LifeCycleTestController::class, 'showServiceContainerTest']);

// //20211101_ServiceProvider
// Route::get('/service-provider-test', [LifeCycleTestController::class, 'showServiceProviderTest']);




// Route::get('/dashboard', function () {
//     return view('user.dashboard');
// })->middleware(['auth:users'])->name('dashboard');
// //middlewareでログインしてきたユーザが以前登録していたか確認



require __DIR__ . '/auth.php';
