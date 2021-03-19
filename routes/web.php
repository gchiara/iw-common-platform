<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\DatasetsController;
use App\Http\Controllers\PlatformsController;

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

/*
Route::get('/', function () {
    return view('welcome');
});
*/
Route::get('/',[PlatformsController::class, 'index'])->name('home');

Route::middleware(['auth:sanctum', 'verified'])->group(function(){
    Route::get('/dashboard',[DatasetsController::class, 'index'])->name('dashboard');
    Route::post('/dashboard',[DatasetsController::class, 'index']);
    Route::get('/download-dataset/{dataset}', [DatasetsController::class, 'download']);
});

Route::get('storage/images/{filename}', function ($filename)
{
    $path = storage_path('public/images/' . $filename);
    if (!File::exists($path)) {
        abort(404);
    }
    $file = File::get($path);
    $type = File::mimeType($path);
    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);
    return $response;
});

Route::middleware(['App\Http\Middleware\CheckIfAdmin'])->group(function(){
    // Routes for only admins   
    Route::get('/admin', function () {
        return view('admin-main');
    })->name('admin');

    Route::get('/users-list',[UsersController::class, 'manage'])->name('users-list');
    Route::get('/platforms-list',[PlatformsController::class, 'manage'])->name('platforms-list');

    Route::get('/platform',[PlatformsController::class, 'add']);
    Route::post('/platform',[PlatformsController::class, 'create']);
    Route::get('/platform/{platform}', [PlatformsController::class, 'edit']);
    Route::post('/platform/{platform}', [PlatformsController::class, 'update']);

    Route::get('/user-toggle-editor/{user}', [UsersController::class, 'toggleEditor']);
    Route::post('/user-remove/{user}', [UsersController::class, 'delete']);

    Route::get('/download-users', [UsersController::class, 'download']);

});

Route::middleware(['App\Http\Middleware\CheckIfAdminOrEditor'])->group(function(){
    // Routes for admins and editors
    Route::get('/dataset',[DatasetsController::class, 'add']);
    Route::post('/dataset',[DatasetsController::class, 'create']);
    Route::get('/dataset/{dataset}', [DatasetsController::class, 'edit']);
    Route::post('/dataset/{dataset}', [DatasetsController::class, 'update']);
    Route::get('/download-datasets-list', [DatasetsController::class, 'downloadList']);
});
