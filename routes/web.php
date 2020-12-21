<?php

use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\MyController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SubjectController;
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

Route::get('/', [IndexController::class, 'index'])->middleware('auth')->name('index');

Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/authenticate', [LoginController::class, 'authenticate'])->name('authenticate');

Route::get('/register', [LoginController::class, 'register'])->name('register');
Route::post('/sign-up', [LoginController::class, 'signUp'])->name('sign-up');

Route::group(['prefix' => 'department', 'middleware' => ['auth', 'acl'], 'is' => 'admin|dept'],
    function () {
        Route::get('/', [DepartmentController::class, 'index'])->name('department-all');
        Route::get('/show/{id}', [DepartmentController::class, 'show'])->name('department-get');
        Route::get('/delete/{id}', [DepartmentController::class, 'destroy'])->name('department-destroy');
        Route::get('/create', [DepartmentController::class, 'create'])->name('department-create');
        Route::post('/store', [DepartmentController::class, 'store'])->name('department-store');
        Route::get('/edit/{id}', [DepartmentController::class, 'edit'])->name('department-edit');
        Route::post('/update/', [DepartmentController::class, 'update'])->name('department-update');
    }
);

Route::group(['prefix' => 'subject', 'middleware' => ['auth', 'acl'], 'is' => 'admin'],
    function () {
        Route::get('/', [SubjectController::class, 'index'])->name('subject-all');
        Route::get('/show/{id}', [SubjectController::class, 'show'])->name('subject-get');
        Route::get('/delete/{id}', [SubjectController::class, 'destroy'])->name('subject-destroy');
        Route::get('/create', [SubjectController::class, 'create'])->name('subject-create');
        Route::post('/store', [SubjectController::class, 'store'])->name('subject-store');
        Route::get('/edit/{id}', [SubjectController::class, 'edit'])->name('subject-edit');
        Route::post('/update/', [SubjectController::class, 'update'])->name('subject-update');
    }
);

Route::group(['prefix' => 'roles', 'middleware' => ['auth', 'acl'], 'is' => 'admin'],
    function () {
        Route::get('/', [RoleController::class, 'index'])->name('roles-all');
        Route::post('/sync', [RoleController::class, 'syncRoles'])->name('sync-roles');
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

