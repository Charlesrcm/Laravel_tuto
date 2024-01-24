<?php

use Illuminate\Http\Request;
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

Route::get('/', function () {
    return view('welcome');
});

// regroupage de même routes
Route::prefix('/blog')->name('blog.')->group(function () {
    Route::get('/', function (Request $request) {
        return [
            "link" => \route('show', ['slug' => 'article', 'id' => 13]), // genre d'htaccess
        ];
    })->name('index');


    Route::get('/{slug}-{id}', function (string $slug, string $id) {
        return [
            "slug" => $slug,
            "id" => $id,
        ];
    })->where([ // critères spécifique
        'id' => '[0-9]+',
        'slug' => '[a-z0-9\-]+',
    ])->name('show');
});
