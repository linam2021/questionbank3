<?php


use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\QuestionController\QuestionController;
use App\Http\Controllers\QuestionController\DepartmentController;
use App\Http\Controllers\QuestionController\CourseController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('user/verify/{token}', [App\Http\Controllers\Auth\RegisterController::class , 'verifyEmail'])->name('verifyEmail');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login');
Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'register'])->name('register');
//Route::get('/ForgotPassword', [App\Http\Controllers\ForgotPasswordController::class, 'forgotPassword'])->name('forgotPassword');
//Route::get('/resetPassword', [App\Http\Controllers\ResetPasswordController::class, 'login'])->name('resetPassword');

Route::get('/showDepartments', [DepartmentController::class, 'index'])->name('showDepartments');
Route::post('/addDepartment', [DepartmentController::class, 'addDepartment'])->name('addDepartment');
Route::get('/deleteDept/{id}', [DepartmentController::class, 'deleteDept'])->name('deleteDept');

Route::get('/showCourses', [CourseController::class, 'index'])->name('showCourses');
Route::post('/addCourse', [CourseController::class, 'addCourse'])->name('addCourse');
Route::get('/deleteCourse/{id}', [CourseController::class, 'deleteCourse'])->name('deleteCourse');

Route::get('/showQuestions/{id}', [QuestionController::class, 'showQuestions'])->name('showQuestions');
Route::post('/store', [QuestionController::class, 'store'])->name('store');
Route::get('/edit/{id}/{page}', [QuestionController::class, 'edit'])->name('edit');
Route::post('/update/{id}/{page}', [QuestionController::class, 'update'])->name('update');
Route::get('/delete/{id}', [QuestionController::class, 'delete'])->name('delete');

