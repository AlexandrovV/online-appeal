<?php

use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\MyController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\NotificationLogController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StatsController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherController;
use \App\Http\Controllers\AppealController;
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

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

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

Route::group(['prefix' => 'teacher', 'middleware' => ['auth', 'acl'], 'is' => 'admin|dept'],
    function () {
        Route::get('/', [TeacherController::class, 'index'])->name('teacher-all');
        Route::get('/show/{id}', [TeacherController::class, 'show'])->name('teacher-get');
        Route::get('/delete/{id}', [TeacherController::class, 'destroy'])->name('teacher-destroy');
        Route::get('/create', [TeacherController::class, 'create'])->name('teacher-create');
        Route::post('/store', [TeacherController::class, 'store'])->name('teacher-store');
        Route::get('/edit/{id}', [TeacherController::class, 'edit'])->name('teacher-edit');
        Route::post('/update/', [TeacherController::class, 'update'])->name('teacher-update');
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

Route::group(['prefix' => '/stud/appeals', 'middleware' => ['auth', 'acl'], 'is' => 'student'],
    function () {
        Route::get('/', [AppealController::class, 'studentAppeals'])->name('student-appeals');
        Route::get('/{status}', [AppealController::class, 'studentStatusAppeals'])->name('student-status-appeals');
        Route::get('/form/new', [AppealController::class, 'form'])->name('appeal-form');
        Route::post('/create', [AppealController::class, 'create'])->name('appeal-create');
    }
);

Route::group(['prefix' => '/dept/appeals', 'middleware' => ['auth', 'acl'], 'is' => 'dept|admin'],
    function () {
        Route::get('/', [AppealController::class, 'departmentAppeals'])->name('department-appeals');
        Route::get('/{status}', [AppealController::class, 'departmentStatusAppeals'])->name('department-status-appeals');
        Route::get('/approve/{id}', [AppealController::class, 'approve'])->name('approve-appeal');
    }
);

Route::group(['prefix' => '/manager/appeals', 'middleware' => ['auth', 'acl'], 'is' => 'manager|admin'],
    function () {
        Route::get('/', [AppealController::class, 'managerAppeals'])->name('manager-appeals');
        Route::get('/{status}', [AppealController::class, 'managerStatusAppeals'])->name('manager-status-appeals');
        Route::post('/accept', [AppealController::class, 'managerProcessAppeal'])->name('manager-process-appeal');
    }
);

Route::get('/appeal/cancel/{id}', [AppealController::class, 'cancel'])->name('cancel-appeal')->middleware('auth');

Route::get('/appeal/get/{id}', [AppealController::class, 'getAppealInBrowser'])->name('appeal-browser');

Route::get('/stats', [StatsController::class, 'index'])->name('stats-index');
Route::get('/statsJson', [StatsController::class, 'findAllJson'])->name('stats-json');

Route::group(['prefix' => 'notification', 'middleware' => ['auth', 'acl'], 'is' => 'admin'],
    function () {
        Route::get('/', [NotificationLogController::class, 'index'])->name('notification-all');
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

