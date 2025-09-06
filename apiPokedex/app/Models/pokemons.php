<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pokemons extends Model
{
    protected $fillable = [
        'nome',
        'tipo',
        'vantagem',
        'desvantagem',
        'evolucao',
        'altura',
        'peso',
        'numero',
    ];
}
