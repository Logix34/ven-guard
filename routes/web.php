<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ActivitylogController;
use Illuminate\Support\Facades\Route;

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
////////////////////////////..........................Login Section........................///////////////////////////
    Route::get('login',[AdminController::class,'loginView'])->name('login');
    Route::post('/verify-login',[AdminController::class,'postLogin']);
////////////////////////////..........................SignUP Section........................///////////////////////////
    Route::get('sign_up',[AdminController::class,'create']);
    Route::post('/submit-signup/form',[AdminController::class,'store']);
////////////////////////////..........................forget/reset Password Section........................///////////////////////////
    Route::get('/forget_password',[AdminController::class,'index']);
    Route::get('/forget/code',[AdminController::class,'forgetCode']);
    Route::post('/forget-password',[AdminController::class,'forget']);
    Route::post('/reset_password',[AdminController::class,'verifyOtp']);


    Route::group(['middleware' => 'auth'], function () {
////////////////////////////..........................Dashboard Section........................///////////////////////////
    Route::get('admin/dashboard', [AdminController::class, 'dashboard']);
////////////////////////////..........................Users Section........................///////////////////////////
    Route::get('User/profile',[AdminController::class,'getProfile']);
    Route::get('/user/detail/{id}',[BaseController::class,'getUserDetail']);
    Route::get('/users',[BaseController::class,'getUsers']);
    Route::get('/users/List',[BaseController::class,'usersList']);
    Route::get('/add/new_user',[BaseController::class,'getAdd']);
    Route::get('/user/edit{id}', [BaseController::class,'editUser']);
    Route::get('/user/delete/{id}',[BaseController::class,'deleteUser']);

    Route::put('/submit-Profile/form/', [AdminController::class,'updateProfile'])->name('admin.updateProfile');
    Route::post('submit-Users/form',[BaseController::class,'addUser']);
    ////////////////////////////..........................Roles  Section........................///////////////////////////
    Route::get('/roles',[BaseController::class,'getRoles']);
    Route::get('/roles/List',[BaseController::class,'rolesList']);
    Route::get('/add_roles',[BaseController::class,'createRoles']);
    Route::get('/role/delete/{id}',[BaseController::class,'deleteRole']);
    Route::get('/role/edit{id}', [BaseController::class,'editRoles']);

    Route::post('/submit-roles/form/',[BaseController::class,'postRolesForm']);
////////////////////////////..........................Permissions  Section........................///////////////////////////
    Route::get('/permissions',[PermissionController::class,'index']);
    Route::get('/add_permissions',[PermissionController::class,'create']);
    Route::get('/delete_Permission',[PermissionController::class,'deletePermission']);
    Route::get('/permissions/List',[PermissionController::class,'PermissionList']);
    Route::get('/permissions/edit{id}', [PermissionController::class,'editPermissions']);

    Route::post('/create_permissions',[PermissionController::class,'createpermission']);
    Route::post('/store_permissions',[PermissionController::class,'store']);
////////////////////////////..........................ActivityLog  Section........................///////////////////////////
   Route::get('/activity_log',[ActivitylogController::class,'index']);
   Route::get('/activity_list',[ActivitylogController::class,'list']);
});
Route::post('/logout', [AdminController::class,'logout']);

