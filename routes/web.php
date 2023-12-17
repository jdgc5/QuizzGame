<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuizzController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\PartidasController;
use App\Http\Controllers\UserController;


Route::get('/', function () {
    return view('index');
});

Route::resource('quizz', QuizzController::Class);

Route::get('user/create', [UserController::class, 'create'])->name('user.create');
Route::get('user/index', [UserController::class, 'index'])->name('user.index');
Route::post('user/store', [UserController::class, 'store'])->name('user.store');
Route::post('user/processLogin', [UserController::class, 'processLogin']);


Route::get('quizz/viewQuestions', [QuizzController::class, 'viewQuestions']);
Route::get('quizz/game', [QuizzController::class, 'game']);
Route::get('quizz/history', [QuizzController::class, 'game']);
Route::post('quizz/finish-game', [QuizzController::class, 'finishGame']);

Route::get('quizz/view/{id}', [QuizzController::class, 'view'])-> name ('quizz.view');
Route::get('setting', [SettingController::class, 'index'])-> name ('setting.index');
Route::put('setting', [SettingController::class, 'update'])-> name ('setting.update');
Route::get('quizz/viewQuestions', [QuizzController::class, 'viewQuestions'])->name('quizz.viewQuestions');

Route::get('partidas', [PartidasController::class, 'index'])->name('partidas.index');
Route::get('partidas/{id}', [PartidasController::class, 'show'])->name('partidas.show');
Route::delete('partidas/{id}', [PartidasController::class, 'destroy'])->name('partidas.destroy');






