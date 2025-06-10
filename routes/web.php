<?php

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
    return view('welcome');
    // return view('frontend.webinar.recorded');
});

Route::get('/webinar-show/{uid}', [WebinarController::class, 'show'])
    ->name('webinar.show');
Route::post('/webinar/question/store', [WebinarController::class, 'QuestionStore'])
    ->name('webinar.question.submit');

 