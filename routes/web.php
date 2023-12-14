<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuizzController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\GameController;

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
Route::get('/', function () {
    return view('index');
});



Route::get('quizz/sign-in', [QuizzController::class, 'signIn']);
Route::get('quizz/sign-up', [QuizzController::class, 'signUn']);
Route::get('quizz/viewQuestions', [QuizzController::class, 'viewQuestions']);
Route::get('quizz/game', [QuizzController::class, 'game']);
Route::get('quizz/history', [QuizzController::class, 'game']);
Route::post('quizz/finish-game', [QuizzController::class, 'finishGame']);



Route::resource('quizz', QuizzController::Class);
Route::get('quizz/view/{id}', [QuizzController::class, 'view'])-> name ('quizz.view');
Route::get('setting', [SettingController::class, 'index'])-> name ('setting.index');
Route::put('setting', [SettingController::class, 'update'])-> name ('setting.update');
Route::get('quizz/viewQuestions', [QuizzController::class, 'viewQuestions'])->name('quizz.viewQuestions');





