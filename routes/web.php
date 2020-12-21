<?php

use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\MyController;
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

use \App\Http\Controllers\TestController;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('department')->group(
    function () {
        Route::get('/', [DepartmentController::class, 'index'])->name('department-all');
        Route::get('/show/{id}', [DepartmentController::class, 'show'])->name('department-get');
        Route::get('/delete/{id}', [DepartmentController::class, 'destroy'])->name('department-destroy');
        Route::get('/create', [DepartmentController::class, 'create'])->name('department-create');
        Route::post('/store', [DepartmentController::class, 'store'])->name('department-store');
        Route::get('/edit/{id}', [DepartmentController::class, 'edit'])->name('department-edit');
        Route::post('/update/{id}', [DepartmentController::class, 'update'])->name('department-update');
    }
);
/*
 * Test Controllers
 */
Route::get('/test', [TestController::class, 'indexTest']);
Route::get('/test-email', [MyController::class, 'attachment_email']);
//Route::prefix('source')->group(
//    function () {
//        Route::get('{id}/edit', 'MyController@index')
//            ->middleware(['permission.blah-blah'])
//            ->name('edit');
//    }
//);

