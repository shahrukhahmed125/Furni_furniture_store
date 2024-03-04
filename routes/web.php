<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
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
    Route::get('/cart',[HomeController::class,'cart'])->name('cart');
    Route::get('/checkout',[HomeController::class,'checkout'])->name('checkout');
    Route::get('/thankyou',[HomeController::class,'thankyou'])->name('thankyou');

//----------- END HOME ROUTES ----------//

//----------- AUTH ROUTES ----------//

    Route::get('/login',[AuthController::class,'login'])->name('login');
    Route::post('/redirect',[AuthController::class,'loginPost'])->name('loginPost');
    //----------- ADMIN ROUTES ----------//

        Route::get('/AdminDashboard',[AdminController::class,'dashboard'])->name('dashboard')->middleware('auth','verified');

    //----------- END ADMIN ROUTES ----------//
    Route::get('/register',[AuthController::class,'register'])->name('register');
    Route::post('/registerPost',[AuthController::class,'registerPost'])->name('registerPost');
    Route::get('logout',[AuthController::class,'logout'])->name('logout');




//----------- END AUTH ROUTES ----------//