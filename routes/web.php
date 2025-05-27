<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ElevadorController;

Route::redirect('/', '/elevador');
Route::get('/elevador', [ElevadorController::class, 'index'])->name('elevador.index');
Route::post('/elevador/chamar', [ElevadorController::class, 'chamar'])->name('elevador.chamar');
Route::post('/elevador/mover', [ElevadorController::class, 'mover'])->name('elevador.mover');
