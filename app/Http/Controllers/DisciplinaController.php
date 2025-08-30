<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Disciplina;

class DisciplinaController extends Controller
{
    public function index()
    {
        $disciplinas = Disciplina::all();
        return response()->json($disciplinas);
    }

    public function store(Request $request)
    {
        $request->validate([
            'designacao' => 'required|string|max:255',
            'abreviatura' => 'required|string|max:50',
            'area_curricular_id' => 'required|integer|exists:area_curricular,id_area_curricular',
            'nivel_academico_id' => 'required|integer|exists:nivel_academico,id_nivel_academico',
        ]);

        $disciplina = Disciplina::create($request->all());

        return response()->json($disciplina, 201);
    }

    public function show($id)
    {
        $disciplina = Disciplina::find($id);
        if (!$disciplina) {
            return response()->json(['message' => 'Disciplina não encontrada'], 404);
        }
        return response()->json($disciplina);
    }

    public function update(Request $request, $id)
    {
        $disciplina = Disciplina::find($id);
        if (!$disciplina) {
            return response()->json(['message' => 'Disciplina não encontrada'], 404);
        }

        $request->validate([
            'designacao' => 'sometimes|required|string|max:255',
            'abreviatura' => 'sometimes|required|string|max:50',
            'area_curricular_id' => 'sometimes|required|integer|exists:area_curricular,id_area_curricular',
            'nivel_academico_id' => 'sometimes|required|integer|exists:nivel_academico,id_nivel_academico',
        ]);

        $disciplina->update($request->all());

        return response()->json($disciplina);
    }

    public function destroy($id)
    {
        $disciplina = Disciplina::find($id);
        if (!$disciplina) {
            return response()->json(['message' => 'Disciplina não encontrada'], 404);
        }

        $disciplina->delete();
        return response()->json(['message' => 'Disciplina eliminada com sucesso']);
    }

    public function getByAreaCurricular($areaCurricularId)
    {
        $disciplinas = Disciplina::where('area_curricular_id', $areaCurricularId)->get();
        return response()->json($disciplinas);
    }   

    public function getByNivelAcademico($nivelAcademicoId)
    {
        $disciplinas = Disciplina::where('nivel_academico_id', $nivelAcademicoId)->get();
        return response()->json($disciplinas);
    }

    public function create()
    {
        return view('disciplina.create');
    }

    public function edit($id)
    {
        $disciplina = Disciplina::find($id);
        if (!$disciplina) {
            return response()->json(['message' => 'Disciplina não encontrada'], 404);
        }
        return view('disciplina.edit', compact('disciplina'));
    }

    public function getByNivelEnsino($nivelEnsinoId)
    {
        $disciplinas = Disciplina::whereHas('nivel_ensino', function ($query) use ($nivelEnsinoId) {
            $query->where('id_nivel_ensino', $nivelEnsinoId);
        })->get();

        return response()->json($disciplinas);
    }

    
}
