<?php

use App\Http\Controllers\PokemonsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// rotas para visualizar os registros
Route::get('/',function(){return response()->json(['Sucesso'=>true]);});
Route::get('/pokemons',[PokemonsController::class,'index']);
Route::get('/pokemons/{codigo}',[PokemonsController::class,'show']);

// rota para inserir os registros
Route::post('/pokemons',[PokemonsController::class,'store']);

// rota para alternar os registros
Route::put('/pokemons/{codigo}',[PokemonsController::class,'update']);

// rota para excluir o registro por id/codigo
Route::delete('/pokemons/{id}',[PokemonsController::class,'destroy']);
