<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\Setting\{
    SettingController as Setting_SettingController, 
    UserProfileController as Setting_UserProfileController, 
    CategoryController as Setting_CategoryController
};
use App\Http\Controllers\{TransactionController, CategoryController};
use Illuminate\Support\Facades\Auth;

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

Auth::routes([
    'reset' => false
]);

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', [TransactionController::class, 'index'])->name('home');
    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
    Route::post('/transaction/new-transaction', [TransactionController::class, 'store'])->name('transactions.store');
    Route::get('/transactions/{id}', [TransactionController::class, 'show'])->name('transactions.show');
    Route::put('/transactions/{id}/update', [TransactionController::class, 'update'])->name('transactions.update');

    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/{id}', [CategoryController::class, 'show'])->name('categories.show');

    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');

    Route::get('/settings', [Setting_SettingController::class, 'index'])->name('settings.setting.index');
    Route::get('/settings/get-view-content', [Setting_SettingController::class, 'getViewContent'])->name('settings.setting.getviewcontent');
    Route::put('/settings/update-user-profile', [Setting_UserProfileController::class, 'updateProfile'])->name('settings.userprofile.updateprofile');
    Route::patch('/settings/change-password', [Setting_UserProfileController::class, 'changePassword'])->name('settings.userprofile.changepassword');
    Route::post('/settings/new-category', [Setting_CategoryController::class, 'insertCategory'])->name('settings.category.insertcategory');
    Route::put('/categories/{id}', [Setting_CategoryController::class, 'updateCategory'])->name('settings.category.updatecategory');
});
