<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LawyerController;
use App\Http\Controllers\JudgeController;
use App\Http\Controllers\RoleAssign;
use App\Http\Controllers\CasesCoutroller;

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
    return redirect('/login');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/profile', [HomeController::class, 'profile'])->name('profile');
Route::get('/profile/edit', [HomeController::class, 'profileEdit'])->name('profile.edit');
Route::put('/profile/update', [HomeController::class, 'profileUpdate'])->name('profile.update');
Route::get('/profile/changepassword', [HomeController::class, 'changePasswordForm'])->name('profile.change.password');
Route::post('/profile/changepassword', [HomeController::class, 'changePassword'])->name('profile.changepassword');

Route::group(['middleware' => ['auth','role:Admin']], function () 
{
    Route::get('/roles-permissions', [RolePermissionController::class, 'roles'])->name('roles-permissions');
    Route::get('/role-create', [RolePermissionController::class, 'createRole'])->name('role.create');
    Route::post('/role-store', [RolePermissionController::class, 'storeRole'])->name('role.store');
    Route::get('/role-edit/{id}', [RolePermissionController::class, 'editRole'])->name('role.edit');
    Route::put('/role-update/{id}', [RolePermissionController::class, 'updateRole'])->name('role.update');

    Route::get('/permission-create', [RolePermissionController::class, 'createPermission'])->name('permission.create');
    Route::post('/permission-store', [RolePermissionController::class, 'storePermission'])->name('permission.store');
    Route::get('/permission-edit/{id}', [RolePermissionController::class, 'editPermission'])->name('permission.edit');
    Route::put('/permission-update/{id}', [RolePermissionController::class, 'updatePermission'])->name('permission.update');


    Route::resource('judge', JudgeController::class);
    Route::resource('lawyers', LawyerController::class);
    Route::resource('assignrole', RoleAssign::class);
    Route::resource('kesi', CasesCoutroller::class);
});

Route::group(['middleware' => ['auth','role:Lawyer']], function () 
{
    Route::get('/kesi', [CasesCoutroller::class, 'index'])->name('kesi.index');
    Route::get('/kesi/{kesi}', [CasesCoutroller::class, 'show'])->name('kesi.show');
});  

Route::group(['middleware' => ['auth','role:Judge']], function () 
{
    Route::get('/kesi', [CasesCoutroller::class, 'index'])->name('kesi.index');
    Route::get('/kesi/{kesi}', [CasesCoutroller::class, 'show'])->name('kesi.show');
    Route::get('/kesi/{kesi}/edit', [CasesCoutroller::class, 'edit'])->name('kesi.edit');
    Route::PUT('/kesi/{kesi}', [CasesCoutroller::class, 'update'])->name('kesi.update');
}); 







