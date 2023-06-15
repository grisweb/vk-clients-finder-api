<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\VkConnectController;
use App\Http\Controllers\Favorites;
use App\Http\Controllers\SearchTasks;
use App\Http\Controllers\FoundUsers;
use App\Http\Controllers\Users\UserController;
use App\Http\Controllers\Vk\DatabaseController;
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

Route::post('/login', LoginController::class);
Route::post('/register', RegisterController::class);

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::post('/logout', LogoutController::class);
    Route::get('/users', [UserController::class, 'index']);
    Route::get('/users/me', [UserController::class, 'me']);
    Route::post('/vk/connect', VkConnectController::class);

    Route::get('/vk/cities', [DatabaseController::class, 'getCities']);
    Route::get('/vk/universities', [DatabaseController::class, 'getUniversities']);
    Route::get('/vk/faculties', [DatabaseController::class, 'getFaculties']);
    Route::get('/vk/chairs', [DatabaseController::class, 'getChairs']);

    Route::post('/search-tasks', SearchTasks\StoreController::class);
    Route::delete('/search-tasks', SearchTasks\DeleteController::class);
    Route::get('/search-tasks', SearchTasks\IndexController::class);
    Route::get('/search-tasks/{searchTask:uuid}', SearchTasks\ShowController::class);

    Route::get('/search-tasks/{searchTask:uuid}/found-users', FoundUsers\IndexController::class);
    Route::delete('/found-users', FoundUsers\DeleteController::class);

    Route::get('/favorites', Favorites\IndexController::class);
    Route::post('/favorites', Favorites\StoreController::class);
    Route::delete('/favorites', Favorites\DeleteController::class);
});

Route::get('/found-users/csv', [FoundUsers\ExportController::class, 'csv']);
