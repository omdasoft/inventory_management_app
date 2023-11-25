<?php

use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\OAuthController;
use Illuminate\Support\Facades\Route;
// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware('auth:sanctum')->prefix('admin')->name('admin.')->group(function() {
    Route::get('products', [ProductController::class, 'index'])->name('products');
    Route::get('products/{id}', [ProductController::class, 'view'])->name('products.view');
});

Route::get('oauth/redirect', [OAuthController::class, 'redirect'])->name('oauth.redirect');
Route::get('oauth/callback', [OAuthController::class, 'callback'])->name('oauth.callback');
Route::post('oauth/token', [OAuthController::class, 'getToken'])->name('oauth.token');
