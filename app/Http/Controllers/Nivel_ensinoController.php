<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nivel_ensino;

class Nivel_ensinoController extends Controller
{
    public function index()
    {
        return view('nivel_ensino.index');
    }

    public function list()
    {
        return response()->json(Nivel_ensino::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'designacao' => 'required|string|max:45',
            'abreviatura' => 'required|string|max:10',
            'ordem' => 'required|integer',
        ]);

        $nivel = Nivel_ensino::create($request->all());

        return response()->json([
            'message' => 'Nível de Ensino registrado com sucesso!',
            'data' => $nivel
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $nivel = Nivel_ensino::find($id);

        if (!$nivel) {
            return response()->json(['message' => 'Nível de Ensino não encontrado'], 404);
        }

        $request->validate([
            'designacao' => 'sometimes|required|string|max:45',
            'abreviatura' => 'sometimes|required|string|max:10',
            'ordem' => 'sometimes|required|integer',
        ]);

        $nivel->update($request->all());

        return response()->json([
            'message' => 'Nível de Ensino atualizado com sucesso!',
            'data' => $nivel
        ]);
    }
    public function show($id)
    {
        $nivel_ensino = Nivel_ensino::find($id);
        return view('nivel_ensino.show', compact('nivel_ensino'));
    }

    public function edit($id)
    {
        $nivel_ensino = Nivel_ensino::find($id);
        return view('nivel_ensino.edit', compact('nivel_ensino'));
    }

    public function destroy($id)
    {
        $nivel_ensino = Nivel_ensino::find($id);
        if (!$nivel_ensino) {
            return response()->json(['message' => 'Nível de Ensino não encontrado'], 404);
        }

        $nivel_ensino->delete();
        return response()->json(['message' => 'Nível de Ensino eliminado com sucesso']);
    }

    public function searchByDesignacao($designacao)
    {
        $niveis_ensino = Nivel_ensino::where('designacao', 'like', '%' . $designacao . '%')->get();
        return response()->json($niveis_ensino);
    }
}
