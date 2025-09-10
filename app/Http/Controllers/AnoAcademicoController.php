<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ano_academico;

class AnoAcademicoController extends Controller
{
    public function index()
    {
        //$anos_academicos = Ano_academico::all();
        return view('ano_academico.index');
    }

    public function list(){
        $anos_academicos = Ano_academico::all();
        return response()->json($anos_academicos);
    }
    public function create()
    {
        return view('ano_academico.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'designacao' => 'required|string|max:255',
            'data_inicio' => 'required|date',
            'data_fim' => 'required|date|after:data_inicio',
            'estado' => 'required|in:0,1',
        ]);

        $ano_academico = Ano_academico::create($request->all());

        return response()->json([
            'message' => 'Ano Acadêmico registrado com sucesso!',
            'data' => $ano_academico
        ], 201);
    }


    public function show($id)
    {
        $ano_academico = Ano_academico::find($id);
        //return view('ano_academico.show', compact('ano_academico'));
        return response()->json($ano_academico);
    }

    public function edit($id)
    {
        $ano_academico = Ano_academico::find($id);
        return view('ano_academico.edit', compact('ano_academico'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'designacao' => 'required|string|max:255',
            'data_inicio' => 'required|date',
            'data_fim' => 'required|date|after:data_inicio',
            'estado' => 'required|in:0,1',
        ]);

        $ano_academico = Ano_academico::find($id);
        if (!$ano_academico) {
            return response()->json(['message' => 'Ano Acadêmico não encontrado'], 404);
        }

        $ano_academico->update($request->all());

        return response()->json([
            'message' => 'Ano Acadêmico atualizado com sucesso!',
            'data' => $ano_academico
        ], 200);
    }

}
