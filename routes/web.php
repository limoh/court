<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LawyerController;
use App\Http\Controllers\JudgeController;
use App\Http\Controllers\RoleAssign;
use App\Http\Controllers\CasesController;
use App\Http\Controllers\PlaintiffController;
use App\Exports\CaseExport;

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
/*
    Route::get('kesi', [CasesController::class, 'index'])->name('kesi.index');
    Route::get('kesi/{kesi}/edit', [CasesController::class, 'edit'])->name('kesi.edit');
    Route::put('kesi', [CasesController::class, 'update'])->name('kesi.update');
    Route::delete('kesi/{kesi}', [CasesController::class, 'destroy'])->name('kesi.destroy');
    Route::get('kesi/{kesi}', [CasesController::class, 'show'])->name('kesi.show');
    Route::get('kesi/create', [CasesController::class, 'create'])->name('kesi.create');
    Route::post('kesi', [CasesController::class, 'store'])->name('kesi.store');
*/
    
});


Route::group(['middleware' => ['auth','role:Lawyer']], function () 
{
    /*
    Route::get('kesi', [CasesController::class, 'index'])->name('kesi.index');
    Route::get('kesi/create', [CasesController::class, 'create'])->name('kesi.create');
    Route::post('kesi', [CasesController::class, 'store'])->name('kesi.store');
    Route::get('kesi/{kesi}', [CasesController::class, 'show'])->name('kesi.show');
    Route::get('kesi/{kesi}/edit', [CasesController::class, 'edit'])->name('kesi.edit');
    Route::put('kesi', [CasesController::class, 'update'])->name('kesi.update');
*/
    Route::resource('plaintiffs', PlaintiffController::class);

    
});


Route::group(['middleware' => ['auth','role:Judge']], function () 
{
    /*
    Route::get('kesi', [CasesController::class, 'index'])->name('kesi.index');
    Route::get('kesi/{kesi}/edit', [CasesController::class, 'edit'])->name('kesi.edit');
    Route::put('kesi', [CasesController::class, 'update'])->name('kesi.update');

*/
    
});

Route::group(['middleware' => ['auth','role:Admin|Judge|Lawyer|Plaintiff']], function () 
{
    /*
    Route::get('kesi', [CasesController::class, 'index'])->name('kesi.index');
    Route::get('kesi/create', [CasesController::class, 'create'])->name('kesi.create');
    Route::post('kesi', [CasesController::class, 'store'])->name('kesi.store');
    Route::get('kesi/{kesi}', [CasesController::class, 'show'])->name('kesi.show');
    Route::get('kesi/{kesi}/edit', [CasesController::class, 'edit'])->name('kesi.edit');
    Route::put('kesi', [CasesController::class, 'update'])->name('kesi.update');
*/
    Route::resource('kesi', CasesController::class);
  

});

 Route::get('download', function(){
        return(new CaseExport)->download('cases-files.xlsx');
    }); 



