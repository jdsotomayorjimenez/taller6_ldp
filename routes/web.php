<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProyectosController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource("projects", ProyectosController::class);