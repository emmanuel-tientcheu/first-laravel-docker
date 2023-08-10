<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\TodoController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', [UserController::class, 'login']);
Route::post('register', [UserController::class, 'register']);

Route::middleware('auth:sanctum')->group( function () {
    Route::resource('user', UserController::class);
    Route::resource('todo', TodoController::class);
    Route::resource('comment', CommentController::class);
  //  Route::put('comment', [CommentController::class, 'update']);

});


//php artisan make:listener ExampleListener --event=ExampleEvent
//php artisan make:observer ExampleObserver --model=ExampleModel
//php artisan make:observer ExampleObserver --model=ExampleModel
//php artisan make:policy ExamplePolicy --model=ExampleModel
//php artisan make:notification ExampleNotification
//php artisan make:model Example -m
//php artisan make:factory ExampleFactory --model=Example
