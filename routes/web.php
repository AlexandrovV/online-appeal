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
        Route::get('/', [DepartmentController::class, 'index']);
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

