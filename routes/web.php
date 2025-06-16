<?php

use App\Http\Controllers\ContatoController;
use Illuminate\Support\Facades\Route;

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


Route::get('/', [ContatoController::class, "index"])->name("contatos.home");

Route::get('/contato/create', [ContatoController::class, "create"])->name("contatos.create");

Route::get('/contato/edit/{id}', [ContatoController::class, "edit"])->name("contatos.edit"); 

Route::get('/contato/show/{id}', [ContatoController::class, "show"])->name("contatos.show");

Route::delete('/contato/destroy/{id}', [ContatoController::class, "destroy"])->name("contatos.destroy"); 

Route::post('/contatos/store', [ContatoController::class, "store"])->name("contatos.store");

Route::put('/contatos/update/{id}', [ContatoController::class, "update"])->name("contatos.update");
