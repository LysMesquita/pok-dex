<?php

namespace App\Http\Controllers;

use App\Models\pokemons;
use Illuminate\Http\Request;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class PokemonsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // buscando todos os Pokémons
        $registros = Pokemons::all();

        // contando o numero de registros
        $contador = $registros->count();

        // verificando se ha registros
        if ($contador > 0) {
            return response()->json([
                'sucess' => true,
                'message' => 'Pokémons encontrados com sucesso!',
                'data' => $registros,
                'total' => $contador
            ], 200); // retorna HTTP 200 (OK) com os dados e a contagem
        } else {
            return response()->json([
                'sucess' => false,
                'message' => 'Nenhum pokémon encontrado!',
            ], 404); // retorna HTTP 404 (Not Found ) se nao houver registros
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validação dos dados recebidos
        $validator = Validator::make($request->all(), [
            'nome' => 'required',
            'tipo' => 'required',
            'vantagem' => 'required',
            'desvantagem' => 'required',
            'evolucao' => 'required',
            'altura' => 'required',
            'peso' => 'required',
            'numero' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'sucess' => false,
                'message' => 'Registros inválidos',
                'errors' => $validator->errors()
            ], 400); // retorna HTTP 400 (Bad Request) se houver erro de validação
        }

        // criando um pokémon no banco de dados
        $registros = Pokemons::create($request->all());
        if ($registros) {
            return response()->json([
                'sucess' => true,
                'message' => 'Pokemons cadastrados com sucesso!',
                'data' => $registros
            ], 201);
        } else {
            return response()->json([
                'sucess' => false,
                'message' => 'Erro ao cadastrar um pokemon',
            ], 500); // retorna HTTP 500 (Internal Server Error) se o cadastro falhar
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // buscando um pokémon pelo ID
        $registros = Pokemons::find($id);
        
        // verificando se o pokémon foi encontrado
        if ($registros) {
            return responde()->json([
                'sucess' => true,
                'message' => 'Pokémon localizado com sucesso!',
                'data' => $registros
            ], 200); // retorna HTTP 200 (OK) com os dados do produto
        } else {
            return response()->json([
                'sucess' => false,
                'message' => 'Pokémon não localizado',
            ], 404); // retorna HTTP 404 (Not Found) se o produto nao for encontrado
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required',
            'tipo' => 'required',
            'vantagem' => 'required',
            'desvantagem' => 'required',
            'evolucao' => 'required',
            'altura' => 'required',
            'peso' => 'required',
            'numero' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json ([
                'suceess' => false,
                'message' => 'Registros inválidos',
                'errors' => $validator->errors()
            ], 400); // retorna HTTP 400 se houver erro de validação
        }

        // encontrando um pokémon no banco
        $registrosBanco = Pokemons::find($id);

        if (!$registrosBanco) {
            return response()->json([
                'sucess' => false,
                'message' => 'Pokémon não encontrado na Pokédex'
            ], 404);
        }

        // atualizando os dados
        $registrosBanco->nome = $request->nome;
        $registrosBanco->tipo = $request->tipo;
        $registrosBanco->vantagem = $request->vantagem;
        $registrosBanco->desvantagem = $request->desvantagem;
        $registrosBanco->evolucao = $request->evolucao;
        $registrosBanco->altura = $request->altura;
        $registrosBanco->peso = $request->peso;
        $registrosBanco->numero = $request->numero;

        // salvando as alterações
        if ($registrosBanco->save()) {
            return response()->json([
                'sucess' => true,
                'message' => 'Pokemon atualizado com sucesso!',
                'data' => $registrosBanco
            ], 200); // retorna HTTP 200 se a atualização for bem sucedida
        } else {
            return response()->json([
                'sucess' => false,
                'message' => 'Erro ao atualizar o pokémon'
            ], 500); // retorna HTTP 500 se houver erro ao salvar
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // encontrando um pokémons no banco
        $registros = Pokemons::find($id);

        if (!$registros) {
        return response()->json([
            'sucess' => false,
            'message' => 'Pokémon não encontrado na Pokédex'
        ], 404); // retorna HTTP 404 se o produto nao for encontrado
        }
        // deletando um produto
        if ($registros->delete()) {
            return response()->json([
                'sucess' => true,
                'message' => 'Pokémon deletado com sucesso da Pokédex'
            ], 200); // retorna HTTP 200 se a exclusão for bem sucedida
        }
        return response()->json([
            'sucess' => false,
            'message' => 'Erro ao deletar um Pokémon da Pokédex'
        ], 500); // retorna HTTP 500 se houver erro na exclusão
    }
}
