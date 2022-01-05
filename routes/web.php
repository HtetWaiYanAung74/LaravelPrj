<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Product\CommentController;
use App\Http\Controllers\Product\ProductController;
use App\Models\Article;

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
//    return view('welcome');
	return redirect('/articles');
});

/*Route::get('/articles/detail', function () {
	return 'Show articles';
})->name('article');

Route::get('/post/detail', function () {
	return 'Show post detail';
});

Route::get('/post/detail/{id}', function ($id) {
	return "Show post detail $id";
});

Route::get('/articles/more', function () {
	return redirect()->route('article');
});	*/


Route::middleware(['auth'])->group(function() {
	Route::get('/articles/add', [ProductController::class, 'create']);
	Route::get('/articles/update/{id}', [ProductController::class, 'edit']);
	Route::get('/articles/delete/{id}', [ProductController::class, 'destroy']);
});

//Controller
Route::get('/articles/', [ProductController::class, 'index']);

//for detail page
Route::get('/articles/detail/{id}', [ProductController::class, 'show']);

//add article
Route::get('/articles/add', [ProductController::class, 'create']);
Route::post('/articles/add', [ProductController::class, 'store']);

//update article
Route::get('/articles/update/{id}', [ProductController::class, 'edit']);
Route::post('/articles/update/{id}', [ProductController::class, 'update']);

//delete article
Route::get('/articles/delete/{id}', [ProductController::class, 'destroy']);

Route::post('/comment/add',[CommentController::class, 'store']);
Route::get('/comment/delete/{id}',[CommentController::class, 'destroy']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/tranlate/{lang}', function($lang) {
	App::setlocale($lang);
	return view('translate');
});

Route::get('/articles/{lang}', function($lang){
	App::setlocale($lang);
	$article = Article::latest()->paginate(5);
    return view('Articles.index',compact('article', 'lang'));
});