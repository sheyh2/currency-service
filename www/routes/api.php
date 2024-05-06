<?php

use App\Http\Controllers\Api\CurrencyController;
use Illuminate\Routing\Router;
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

Route::prefix('currency')->middleware('auth_token')->group(function(Router $router)
{
    $router->get('index', [CurrencyController::class, 'index']);
    $router->get('show/{id}', [CurrencyController::class, 'show']);
});
