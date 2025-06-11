<?php

use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebinarRegistrationController;
use App\Http\Controllers\WebinarController;
use Illuminate\Support\Facades\Artisan;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/run_all', function () {
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    Artisan::call('optimize:clear'); // Laravel 10 mein optimize:clear use hoti hai
    return 'All clear commands executed successfully!';
});

Route::get('/', function () {
    return redirect()->route('login');
    // return view('frontend.webinar.recorded');
});

Route::get('/webinar-show/{uid}', [WebinarController::class, 'show'])
    ->name('webinar.show');
Route::post('/webinar/question/store', [WebinarController::class, 'QuestionStore'])
    ->name('webinar.question.submit');


Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    // Example admin route
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/questions', [UserController::class, 'userQuestoins'])->name('users.questions');
    // Add more admin routes here
});



require __DIR__ . '/auth.php';
