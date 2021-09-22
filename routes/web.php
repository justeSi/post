<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ParcelController;
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



Route::group(['prefix' => 'posts'], function(){
    Route::get('', [PostController::class, 'index'])->name('post.index');
    Route::get('create', [PostController::class, 'create'])->name('post.create');
    Route::post('store', [PostController::class, 'store'])->name('post.store');
    Route::get('edit/{post}', [PostController::class, 'edit'])->name('post.edit');
    Route::post('update/{post}', [PostController::class, 'update'])->name('post.update');
    Route::post('delete/{post}', [PostController::class, 'destroy'])->name('post.destroy');
    Route::get('show/{post}', [PostController::class, 'show'])->name('post.show');
    Route::get('pdf/{post}', [PostController::class, 'pdf'])->name('post.pdf');
});



Route::group(['prefix' => 'parcels'], function(){
    Route::get('', [ParcelController::class, 'index'])->name('parcel.index');
    Route::get('create', [ParcelController::class, 'create'])->name('parcel.create');
    Route::post('store', [ParcelController::class, 'store'])->name('parcel.store');
    Route::get('edit/{parcel}', [ParcelController::class, 'edit'])->name('parcel.edit');
    Route::post('update/{parcel}', [ParcelController::class, 'update'])->name('parcel.update');
    Route::post('delete/{parcel}', [ParcelController::class, 'destroy'])->name('parcel.destroy');
    Route::get('show/{parcel}', [ParcelController::class, 'show'])->name('parcel.show');
    Route::get('pdf/{book}', [ParcelController::class, 'pdf'])->name('book.pdf');
});



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
