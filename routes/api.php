<?php

use App\Models\Category;
use App\Models\Product;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/*----Products----*/

Route::get('/products', function () {
    return Product::all();
});

Route::get('/products/search', function () {
    return   Product::all($columns = ['title', 'color', 'description', 'id']);
});

Route::get('/products/search/{id}', function () {
    return   Product::find('id');
});

/*----Categories----*/

Route::get('/categories', function () {
    return Category::all();
});

/*----Types----*/

Route::get('/types', function () {
    return Type::all();
});

Route::get('/types/{id}', function () {
    return Type::all($columns = ['id']);
});
