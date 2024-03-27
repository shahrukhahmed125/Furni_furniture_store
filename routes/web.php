<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use Database\Seeders\AdminSeeder;
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

// Route::get('/', function () {
//     return view('welcome');
// });

//----------- HOME ROUTES ----------//

    Route::get('/',[HomeController::class,'index'])->name('index');
    Route::get('/shop',[HomeController::class,'shop'])->name('shop');
    Route::get('/about',[HomeController::class,'about'])->name('about');
    Route::get('/blog',[HomeController::class,'blog'])->name('blog');
    Route::get('/services',[HomeController::class,'services'])->name('services');

    Route::get('/contact',[HomeController::class,'contact'])->name('contact');
    Route::post('/contact_post',[HomeController::class,'contact_post'])->name('contact_post');

    Route::get('/cart',[HomeController::class,'cart'])->name('cart');
    Route::get('/checkout',[HomeController::class,'checkout'])->name('checkout');
    Route::get('/thankyou',[HomeController::class,'thankyou'])->name('thankyou');

//----------- END HOME ROUTES ----------//

//----------- AUTH ROUTES ----------//

    Route::get('/login',[AuthController::class,'login'])->name('login');
    Route::post('/redirect',[AuthController::class,'loginPost'])->name('loginPost');

    //----------- ADMIN ROUTES ----------//

        Route::middleware('auth','verified','admin')->group(function()
        {

            Route::get('/AdminDashboard',[AdminController::class,'dashboard'])->name('dashboard');
            Route::get('/change_password',[AdminController::class, 'change_password'])->name('change_password');
            Route::post('/change_password_post',[AdminController::class, 'change_password_post'])->name('change_password_post');

            Route::get('/users',[AdminController::class,'users'])->name('users');
            Route::get('/add_users',[AdminController::class,'add_users'])->name('add_users');
            Route::post('/add_users_post',[AdminController::class,'add_users_post'])->name('add_users_post');
            Route::get('/user_delete/{id}',[AdminController::class, 'user_delete'])->name('user_delete');
            Route::get('/user_edit/{id}',[AdminController::class, 'user_edit'])->name('user_edit');
            Route::post('/user_update/{id}',[AdminController::class, 'user_update'])->name('edit_users_post');

            Route::get('/roles',[AdminController::class,'roles'])->name('roles');
            Route::post('/rolesPost',[AdminController::class,'add_roles'])->name('add_roles');
            Route::get('/role_delete/{id}',[AdminController::class, 'role_delete'])->name('role_delete');

            Route::get('/category',[AdminController::class,'category'])->name('category');
            Route::post('/categoryPost',[AdminController::class,'categoryPost'])->name('categoryPost');
            Route::get('/product_category_delete/{id}',[AdminController::class,'product_category_delete'])->name('product_category_delete');

            Route::get('/add_product',[AdminController::class,'add_product'])->name('add_product');
            Route::get('/all_product',[AdminController::class,'all_product'])->name('all_product');
            Route::post('/add_product_post',[AdminController::class,'add_product_post'])->name('add_product_post');
            Route::get('/delete_product/{id}',[AdminController::class,'delete_product'])->name('delete_product');
            Route::get('/edit_product/{id}',[AdminController::class,'edit_product'])->name('edit_product');

            Route::get('/all_blog',[AdminController::class, 'all_blog'])->name('all_blog');
            Route::get('/blog_delete/{id}',[AdminController::class, 'blog_delete'])->name('blog_delete');

            Route::get('/message',[AdminController::class, 'message'])->name('message');
            Route::get('/message_delete/{id}',[AdminController::class, 'message_delete'])->name('message_delete');
        });

    //----------- END ADMIN ROUTES ----------//
    
    Route::get('/register',[AuthController::class,'register'])->name('register');
    Route::post('/registerPost',[AuthController::class,'registerPost'])->name('registerPost');
    Route::get('logout',[AuthController::class,'logout'])->name('logout');




//----------- END AUTH ROUTES ----------//