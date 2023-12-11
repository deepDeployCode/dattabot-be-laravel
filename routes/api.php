<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PokedexController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('v1')->group(function () {
    //routes basic auth
    Route::prefix('user/auth')->group(function () {
        Route::post('login', [AuthController::class, 'login'])->name('dattabot-login');
        Route::post('register', [AuthController::class, 'register'])->name('dattabot-register');
        Route::middleware('auth:api')->group(function () {
            Route::post('logout', [AuthController::class, 'logout'])->name('dattabot-logout');
            Route::prefix('pokedex')->group(function () {
                Route::get('/list', [PokedexController::class, 'list'])->name('dattabot-list-pokedex');
                Route::get('/{id}/detail', [PokedexController::class, 'detail'])->name('dattabot-detail-pokedex');
                Route::post('/visual-data', [PokedexController::class, 'visualDataPokemon'])->name('dattabot-detail-pokedex');
            });
            Route::prefix('master-data')->group(function () {
                Route::get('/', [AuthController::class, 'listUser'])->name('master-data-user-list');
                Route::get('{id}', [AuthController::class, 'detailUser'])->name('master-data-user-detail');
            });
        });
    });
});
