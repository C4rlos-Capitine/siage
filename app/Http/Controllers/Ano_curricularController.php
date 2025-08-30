<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ano_curricular;
class Ano_curricularController extends Controller
{
    public function index()
    {
        $anos_curriculares = Ano_curricular::all();
        return response()->json($anos_curriculares);
    }

    public function store(Request $request)
    {
        $request->validate([
            'designacao' => 'required|string|max:255',
            'nivel_ensino_id' => 'required|integer|exists:nivel_ensino,id_nivel_ensino',
        ]);

        $ano_curricular = Ano_curricular::create($request->all());

        return response()->json($ano_curricular, 201);
    }

    public function show($id)
    {
        $ano_curricular = Ano_curricular::find($id);
        if (!$ano_curricular) {
            return response()->json(['message' => 'Ano Curricular não encontrado'], 404);
        }
        return response()->json($ano_curricular);
    }

    public function update(Request $request, $id)
    {
        $ano_curricular = Ano_curricular::find($id);
        if (!$ano_curricular) {
            return response()->json(['message' => 'Ano Curricular não encontrado'], 404);
        }

        $request->validate([
            'designacao' => 'sometimes|required|string|max:255',
            'nivel_ensino_id' => 'sometimes|required|integer|exists:nivel_ensino,id_nivel_ensino',
        ]);

        $ano_curricular->update($request->all());

        return response()->json($ano_curricular);
    }

    public function destroy($id)
    {
        $ano_curricular = Ano_curricular::find($id);
        if (!$ano_curricular) {
            return response()->json(['message' => 'Ano Curricular não encontrado'], 404);
        }

        $ano_curricular->delete();

        return response()->json(['message' => 'Ano Curricular eliminado com sucesso']);
    }

    public function getByNivelEnsino($nivelEnsinoId)
    {
        $anosCurriculares = Ano_curricular::where('nivel_ensino_id', $nivelEnsinoId)->get();
        return response()->json($anosCurriculares);
    }

    public function create()
    {
        return view('ano_curricular.create');
    }

    public function edit($id)
    {
        $ano_curricular = Ano_curricular::find($id);
        if (!$ano_curricular) {
            return response()->json(['message' => 'Ano Curricular não encontrado'], 404);
        }
        return view('ano_curricular.edit', compact('ano_curricular'));
    }
    
}
