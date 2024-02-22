<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Web\CategoryController;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\MovieController;
use App\Http\Controllers\Web\PermissionController;
use App\Http\Controllers\Web\ReviewController;
use App\Http\Controllers\Web\RoleController;
use App\Http\Controllers\Web\UserController;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


Route::get('logout',[HomeController::class,'logout']);
Route::get('redirect',[HomeController::class,'index']);



Route::middleware('role:admin|super-admin')->group(function(){
    Route::resource('users', UserController::class);
    Route::get('users/{userId}/delete',[UserController::class,'destroy']);
    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);
    Route::get('permissions/{permissionId}/delete',[ PermissionController::class,'destroy']);
    Route::get('roles/{roleId}/delete',[ RoleController::class,'destroy']);
    // ->middleware('permission:delete roles');
    Route::get('roles/{roleId}/givePermissionToRole',[ RoleController::class,'PermissionToRole']);
    Route::put('roles/{roleId}/givePermissionToRole',[ RoleController::class,'givePermissionToRole']);
});


/*************************CategoryController************************************** */

Route::resource('categories',CategoryController::class);
Route::get('categories/{categoryID}/delete',[CategoryController::class,'destroy']);

/*************************MovieController************************************** */

Route::resource('movi',MovieController::class);
Route::get('movi/{movieID}/delete',[MovieController::class,'destroy']);

Route::get('search',[MovieController::class,'search']);

/*************************Review************************************** */
Route::resource('review',ReviewController::class);
Route::get('review/{movieID}/createe',[ReviewController::class,'createe']);
Route::post('review/{movieID}/storee',[ReviewController::class,'storee']);
Route::get('review/{movieID}/delete',[ReviewController::class,'destroy']);
Route::get('review/{movieID}/hide',[ReviewController::class,'hideReview']);
Route::get('review/{movieID}/unhide',[ReviewController::class,'unhideReview']);