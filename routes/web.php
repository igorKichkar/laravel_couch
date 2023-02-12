<?php

use Illuminate\Support\Facades\Route;
use App\Models\Post;
use App\Http\Middleware\TestMiddleware;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ComentController;
use Illuminate\Http\Request;
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

// Route::get('/{id?}', function ($idd = null) {
//     return "helo $idd";
// })->middleware('test');

// Route::get('/{id}', function ($id) {
//     return view("post", [
//         "post" => Post::find($id)
//     ]);
// })->where('id', '[0-9]+');

// Route::middleware(['test'])->group(function () {
//     // Route::middleware(['age'])->group( function()  
//     Route::get('/first', function () {
//         echo "first route";
//     });
//     Route::get('/second', function () {
//         echo "second route";
//     });
//     Route::get('/third', function () {
//         echo "third route";
//     });
// });

// Route::redirect('/p', 'photos_name');
// Route::view('/po', 'post');

// //Encoded Forward Slashes
// Route::get('/search/{search}', function ($search) {
//     return $search;
// })->where('search', '.*');

// Route::get('/token', function (Request $request) {
//     $token = $request->session()->token();
 
//     $token = csrf_token();
 
//     return $request->ip();
// });

// Route::get('/home', function () {
//     return response('Hello World', 200)
//                   ->header('Content-Type', 'text/plain');
// });

//Named Routes
// Route::get('post/', [PostController::class, 'index'])->name('photos_name');

Route::resource('/posts', PostController::class);
// Route::resource('/coments', ComentController::class);
Route::post('/coments/{post_id}',[ComentController::class, 'store']);



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
