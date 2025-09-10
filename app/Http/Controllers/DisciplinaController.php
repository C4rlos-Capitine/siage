<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Disciplina;

class DisciplinaController extends Controller
{
    public function index()
    {
        $disciplinas = Disciplina::all();
        //return response()->json($disciplinas);
        return view('disciplina.index');
    }

    public function list()
    {
        $disciplinas = Disciplina::select(
            'disciplina.id_disciplina',
            'disciplina.designacao',
            'disciplina.abreviatura',
            'area_curricular.id_area_curricular',
            'area_curricular.designacao as area_curricular_designacao',
            'nivel_ensino.id_nivel_ensino',
            'nivel_ensino.designacao as nivel_ensino_designacao'
        )
        ->join('area_curricular', 'disciplina.area_curricular_id', '=', 'area_curricular.id_area_curricular')
        ->join('nivel_ensino', 'disciplina.nivel_ensino_id', '=', 'nivel_ensino.id_nivel_ensino')
        ->get();

        return response()->json($disciplinas);
    }


    public function store(Request $request)
    {
        $request->validate([
            'designacao' => 'required|string|max:100',
            'abreviatura' => 'required|string|max:20',
            'area_curricular_id' => 'required|exists:area_curricular,id_area_curricular',
            'nivel_ensino_id' => 'required|exists:nivel_ensino,id_nivel_ensino',
        ]);

        $disciplina = Disciplina::create($request->all());

        return response()->json(['message' => 'Disciplina registrada com sucesso!', 'data' => $disciplina], 201);
    }

    public function update(Request $request, $id)
    {
        $disciplina = Disciplina::find($id);
        if (!$disciplina) {
            return response()->json(['message' => 'Disciplina não encontrada'], 404);
        }

        $request->validate([
            'designacao' => 'sometimes|required|string|max:100',
            'abreviatura' => 'sometimes|required|string|max:20',
            'area_curricular_id' => 'sometimes|required|exists:area_curricular,id_area_curricular',
            'nivel_ensino_id' => 'sometimes|required|exists:nivel_ensino,id_nivel_ensino',
        ]);

        $disciplina->update($request->all());

        return response()->json(['message' => 'Disciplina atualizada com sucesso!', 'data' => $disciplina]);
    }

    public function show($id)
    {
        $disciplina = Disciplina::select(
                'disciplina.id_disciplina',
                'disciplina.designacao',
                'disciplina.abreviatura',
                'disciplina.area_curricular_id',
                'area_curricular.designacao as area_curricular',
                'disciplina.nivel_ensino_id',
                'nivel_ensino.designacao as nivel_ensino'
            )
            ->join('area_curricular', 'disciplina.area_curricular_id', '=', 'area_curricular.id_area_curricular')
            ->join('nivel_ensino', 'disciplina.nivel_ensino_id', '=', 'nivel_ensino.id_nivel_ensino')
            ->where('disciplina.id_disciplina', $id)
            ->first();

        if (!$disciplina) {
            return response()->json(['message' => 'Disciplina não encontrada'], 404);
        }

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
