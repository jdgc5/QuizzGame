<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\QuizzController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\PartidasController;



Route::get('/', function () {
    return view('index');
});
Route::post('user/processLogin', [UserController::class, 'processLogin']);
Route::get('user/create', [UserController::class, 'create'])->name('user.create');
Route::get('user/index', [UserController::class, 'index'])->name('user.index');
Route::post('user/store', [UserController::class, 'store'])->name('user.store');
Route::post('user/logout', [UserController::class, 'processLogin'])->name('logout');


Route::resource('quizz', QuizzController::class);
Route::get('quizz/view/{id}', [QuizzController::class, 'view'])->name('quizz.view');
Route::get('/viewQuestions', [QuizzController::class, 'viewQuestions'])->name('quizz.viewQuestions');
Route::get('/game', [QuizzController::class, 'game'])->name('quizz.game');
Route::post('quizz/finish-game', [QuizzController::class, 'finishGame']);
Route::delete('partidas/{id}', [PartidasController::class, 'destroy'])->name('quizz.destroy');
Route::delete('partidas/{id}', [PartidasController::class, 'destroyView'])->name('quizz.destroyView');

Route::get('setting', [SettingController::class, 'index'])->name('setting.index');
Route::put('setting', [SettingController::class, 'update'])->name('setting.update');

Route::resource('partidas', PartidasController::class);
Route::get('partidas', [PartidasController::class, 'index'])->name('partidas.index');
Route::post('partidas/store', [PartidasController::class, 'store'])->name('partidas.store');
Route::get('partidas/{id}', [PartidasController::class, 'show'])->name('partidas.show');
Route::delete('partidas/{id}', [PartidasController::class, 'destroy'])->name('partidas.destroy');






