<?php

use Illuminate\Support\Facades\Route;

//20211024_add
use App\Http\Controllers\ComponentTestController;

//20211031_add
use App\Http\Controllers\LifeCycleTestController;




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
    return view('welcome');
});


//20211024_add
Route::get('/component-test1', [ComponentTestController::class, 'showComponent1']);
Route::get('/component-test2', [ComponentTestController::class, 'showComponent2']);

//20211031_add for content
Route::get('/service-container-test', [LifeCycleTestController::class, 'showServiceContainerTest']);

//20211101_ServiceProvider
Route::get('/service-provider-test', [LifeCycleTestController::class, 'showServiceProviderTest']);




Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');
//middlewareでログインしてきたユーザが以前登録していたか確認



require __DIR__.'/auth.php';
