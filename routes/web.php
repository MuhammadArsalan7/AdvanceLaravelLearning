<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CsvParsingController;
use App\Http\Controllers\OneToManyController;
use App\Http\Controllers\OneToOneController;

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
Route::get('/csvparse',[CsvParsingController::class,'index'])->name('csv.parse');
Route::post('/csvparsed',[CsvParsingController::class,'csvParseQueue'])->name('csv.parse.queue');


// One to One relation routes
Route::get('/',[OneToOneController::class,'index'])->name('create.user');
Route::post('/createdUser',[OneToOneController::class,'userCreated'])->name('user.created');

Route::get('/showUser',[OneToOneController::class,'showAllUser'])->name('show.user');

Route::get('/edit/{id}',[OneToOneController::class,'EditUser'])->name('edit.user');
Route::post('/updateuser/{id}',[OneToOneController::class,'UpdateUser'])->name('user.updated');

Route::get('/delete/{id}',[OneToOneController::class,'DeleteUser'])->name('delete.user');

Route::post('/searchUser',[OneToOneController::class,'searchUserRole'])->name('searchUserRole.post');


//One to Many Routes
Route::get('/create/order',[OneToManyController::class,'createOrder'])->name('create.order');
Route::post('/created/order',[OneToOneController::class,'OrderCreated'])->name('order.created');




