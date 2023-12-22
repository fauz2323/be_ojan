<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


//category Admin
Route::get('/admin/category', [App\Http\Controllers\Admin\CategoryAdminController::class, 'index'])->name('admin.category.index');
Route::post('/admin/category/store', [App\Http\Controllers\Admin\CategoryAdminController::class, 'store'])->name('admin.category.store');
Route::get('/admin/category/edit/{id}', [App\Http\Controllers\Admin\CategoryAdminController::class, 'edit'])->name('admin.category.edit');
Route::post('/admin/category/update/{id}', [App\Http\Controllers\Admin\CategoryAdminController::class, 'update'])->name('admin.category.update');
Route::get('/admin/category/delete/{id}', [App\Http\Controllers\Admin\CategoryAdminController::class, 'destroy'])->name('admin.category.delete');


//notification admin
Route::get('/admin/notification', [App\Http\Controllers\Admin\NotificationAdminController::class, 'index'])->name('admin.notification.index');
Route::post('/admin/notification/store', [App\Http\Controllers\Admin\NotificationAdminController::class, 'store'])->name('admin.notification.store');
Route::get('/admin/notification/edit/{id}', [App\Http\Controllers\Admin\NotificationAdminController::class, 'edit'])->name('admin.notification.edit');
Route::post('/admin/notification/update/{id}', [App\Http\Controllers\Admin\NotificationAdminController::class, 'update'])->name('admin.notification.update');
Route::get('/admin/notification/delete/{id}', [App\Http\Controllers\Admin\NotificationAdminController::class, 'destroy'])->name('admin.notification.delete');
Route::get('/admin/notification/publish/{id}', [App\Http\Controllers\Admin\NotificationAdminController::class, 'publish'])->name('admin.notification.publish');


//wisataAdmin
Route::get('/admin/wisata', [App\Http\Controllers\Admin\WisataAdminController::class, 'index'])->name('admin.wisata.index');
Route::get('/admin/add', [App\Http\Controllers\Admin\WisataAdminController::class, 'add'])->name('admin.wisata.add');
Route::post('/admin/wisata/store', [App\Http\Controllers\Admin\WisataAdminController::class, 'store'])->name('admin.wisata.store');
Route::get('/admin/wisata/edit/{id}', [App\Http\Controllers\Admin\WisataAdminController::class, 'edit'])->name('admin.wisata.edit');
Route::post('/admin/wisata/update/{id}', [App\Http\Controllers\Admin\WisataAdminController::class, 'update'])->name('admin.wisata.update');
Route::get('/admin/wisata/delete/{id}', [App\Http\Controllers\Admin\WisataAdminController::class, 'destroy'])->name('admin.wisata.delete');

//setting
Route::get('/admin/setting', [App\Http\Controllers\Admin\SettingAdminController::class, 'index'])->name('admin.setting.index');

//version
Route::post('/admin/version/edit', [App\Http\Controllers\Admin\VersionAdminController::class, 'setVersion'])->name('admin.version.edit');


Route::get('/downloadApk', function () {
    $file = public_path('../../public_html/download/file.apk');

    return response()->file($file, [
        'Content-Type' => 'application/vnd.android.package-archive',
        'Content-Disposition' => 'attachment; filename="Wisata bogor.apk"',
    ]);
})->name('downloadfile');
