<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\User\AjaxController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;


Route::middleware(['admin_auth'])->group(function(){
    // Login & Register
    Route::redirect('/','loginPage');
    Route::get('loginPage',[AuthController::class,'loginPage'])->name('auth#loginPage');
    Route::get('registerpage',[AuthController::class,'registerPage'])->name('auth#registerPage');
});

// Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified'])->group(function () { if don't use Auth::logout in Change password function
    Route::middleware(['auth'])->group(function () {

    // dashboard
    Route::get('dashboard',[AuthController::class,'dashboard'])->name('dashboard');

    // Admin
    Route::group(['middleware' => 'admin_auth'],function(){

    //Category
    Route::group(['prefix' => 'category'],function(){
        Route::get('list',[CategoryController::class,'list'])->name('list#page');
        Route::get('create/page',[CategoryController::class,'createPage'])->name('category#createpage');
        Route::post('create',[CategoryController::class,'create'])->name('category#create');
        Route::get('delete/{id}',[CategoryController::class,'delete'])->name('category#delete');
        Route::get('edit/{id}',[CategoryController::class,'edit'])->name('category#edit');
        Route::post('update',[CategoryController::class,'update'])->name('category#update');
    });

    // Admin Account
    Route::prefix('admin')->group(function(){
        // password
        Route::get('password/changePage',[AdminController::class,'changePasswordPage'])->name('admin#changePasswordPage');
        Route::post('change/passowrd',[AdminController::class,'changePassword'])->name('admin#changePassword');
        // account
        Route::get('account/detail',[AdminController::class,'accountDetail'])->name('admin#accountdetail');
        Route::get('account/edit',[AdminController::class,'aacountEdit'])->name('admin#accountedit');
        Route::post('account/update/{id}',[AdminController::class,'accountUpdate'])->name('admin#accountupdate');
        // admin list
        Route::get('list',[AdminController::class,'adminList'])->name('admin#list');
        Route::get('delete/{id}',[AdminController::class,'delete'])->name('admin#delete');
        Route::get('change/role/{id}',[AdminController::class,'changeRole'])->name('admin#changerole');
        Route::post('change/{id}',[AdminController::class,'change'])->name('admin#change');

        // Change Role with Ajax
        Route::prefix('ajax')->group(function(){
            Route::get('change/role',[AdminController::class,'ajaxChangeRole'])->name('ajax#changerole');
        });
    });

    // Products
    Route::prefix('product')->group(function(){
        Route::get('list',[ProductController::class,'productList'])->name('product#list');
        Route::get('create/page',[ProductController::class,'productCreatePage'])->name('product#createpage');
        Route::post('create',[ProductController::class,'create'])->name('product#create');
        Route::get('delete/{id}',[ProductController::class,'delete'])->name('product#delete');
        Route::get('edit/page/{id}',[ProductController::class,'edit'])->name('product#edit');
        Route::get('update/page/{id}',[ProductController::class,'updatePage'])->name('product#updatepage');
        Route::post('update',[ProductController::class,'update'])->name('product#update');
    });

    // Order
    Route::prefix('order')->group(function(){
        Route::get('list',[OrderController::class,'orderList'])->name('order#list');
        Route::get('list/info/{orderCode}',[OrderController::class,'listInfo'])->name('order#listinfo');
    });

    // Ajax For Order
    Route::prefix('ajax')->group(function(){
        Route::get('order/status',[OrderController::class,'ajaxOrderStatus'])->name('ajax#orderstatus');
        Route::get('change/status',[OrderController::class,'ajaxChangeStatus'])->name('ajax#changeStatus');
    });

    // Contact
    Route::prefix('contact')->group(function(){
        Route::get('list',[ContactController::class,'contactList'])->name('contact#list');
        Route::get('detail/{id}',[ContactController::class,'detail'])->name('contact#detail');
    });

    // User List
    Route::get('listuser/page',[AdminController::class,'userListPage'])->name('userlist#page');
    Route::get('listuser/delete/{id}',[AdminController::class,'userDeleteFromAdmin'])->name('userlist#userDeleteFromAdmin');

    // User to Admin Change With Ajax
    Route::prefix('ajax')->group(function(){
        Route::get('role/userchange',[AdminController::class,'ajaxUserChangeRole'])->name('ajax#userchangerole');
    });

    });

    // User
    Route::group(['prefix'=>'user' , 'middleware' => 'user_auth'],function(){

        // Home Page
        Route::get('home',[UserController::class,'home'])->name('user#home');

        // Filter
        Route::get('filter/{id}',[UserController::class,'filter'])->name('user#filter');

        //History
        Route::get('history',[UserController::class,'history'])->name('user#history');

        // Contact
        Route::post('contact',[ContactController::class,'contact'])->name('user#contact');

        Route::prefix('pizza')->group(function(){
            Route::get('detail/page/{id}',[UserController::class,'detailPage'])->name('pizza#detailpage');
        });

        // Cart
        Route::prefix('cart')->group(function(){
            Route::get('list',[UserController::class,'cartPage'])->name('pizza#cartpage');
        });

        // Password
        Route::prefix('password')->group(function(){
            Route::get('change/page',[UserController::class,'changePage'])->name('user#changepassword');
            Route::post('change/password',[UserController::class,'change'])->name('user#change');
        });

        // Account Profile
        Route::prefix('account')->group(function(){
            Route::get('profile/page',[UserController::class,'profilePage'])->name('user#profilepage');
            Route::post('profile/change/{id}',[UserController::class,'profileChange'])->name('user#profilechange');
        });

        // Ajax
        Route::prefix('ajax')->group(function(){
            Route::get('pizza/list',[AjaxController::class,'ajaxPizzaList'])->name('ajax#pizzalist');
            Route::get('cart',[AjaxController::class,'ajaxCart'])->name('ajax#cart');
            Route::get('order',[AjaxController::class,'ajaxOrder'])->name('ajax#order');
            Route::get('cart/clear',[AjaxController::class,'ajaxCartClear'])->name('ajax#cartclear');
            Route::get('cart/current/clear',[AjaxController::class,'ajaxCartCurrentClear'])->name('ajax#cartcurrentclear');
            Route::get('increase/view/count',[AjaxController::class,'increaseViewCount'])->name('ajax#increaseviewcount');
        });
    });
});

