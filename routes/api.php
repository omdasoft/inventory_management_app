<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\OAuthController;
use Illuminate\Support\Facades\Route;
// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware('auth:sanctum')->prefix('admin/v1')->name('admin.')->group(function() {
    Route::get('products', [ProductController::class, 'index'])->name('products');
    Route::get('products/{id}', [ProductController::class, 'show'])->name('products.show');
    Route::get('categories', [CategoryController::class, 'index'])->name('categories');
});

Route::get('oauth/redirect', [OAuthController::class, 'redirect'])->name('oauth.redirect');
Route::get('oauth/callback', [OAuthController::class, 'callback'])->name('oauth.callback');
Route::post('oauth/token', [OAuthController::class, 'getToken'])->name('oauth.token');
