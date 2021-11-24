<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ContactController;

use App\Http\Controllers\Auth\AuthController;

use App\Http\Controllers\Admin\IndexAdminController;
use App\Http\Controllers\Admin\ArticleAdminController;
use App\Http\Controllers\Admin\PermissionAdminController;
use App\Http\Controllers\Admin\MenuAdminController;
use App\Http\Controllers\Admin\UserAdminController;
use App\Http\Controllers\Admin\PortfolioAdminController;

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

Route::resource('/', IndexController::class)
    ->only(['index'])
    ->names([
        'index' => 'home',
    ])
;
Route::resource('/portfolios', PortfolioController::class, [
    'parameters' => [
        'portfolios' => 'alias',
    ],
]);
Route::resource('/articles', ArticleController::class, [
    'parameters' => [
        'articles' => 'alias',
    ],
]);
Route::get('/articles/cat/{cat_alias}', [ArticleController::class, 'index'])
    ->name('articlesCat')
    ->where('cat_alias', '[\w]+');

Route::resource('/comments', CommentController::class)
    ->only(['store']);

Route::match(['get', 'post'], '/contacts', [ContactController::class, 'index'])->name('contacts');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout']);

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [IndexAdminController::class, 'index'])->name('index');
    Route::resources([
        '/articles' => ArticleAdminController::class,
        '/permissions' => PermissionAdminController::class,
        '/menus' => MenuAdminController::class,
        '/users' => UserAdminController::class,
        '/portfolios' => PortfolioAdminController::class,
    ]);
});
