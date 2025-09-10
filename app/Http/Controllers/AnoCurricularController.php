<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ano_curricular;
class AnoCurricularController extends Controller
{
    public function index()
    {
        $anos_curriculares = Ano_curricular::all();
        return view('ano_curricular.index');
        // return response()->json($anos_curriculares);
    }

    public function store(Request $request)
    {
        $request->validate([
            'designacao' => 'required|string|max:45',
            'ordem' => 'required|integer',
            'ciclo_id' => 'required|integer|exists:ciclo,id_ciclo',
        ]);

        $ano_curricular = Ano_curricular::create($request->only(['designacao', 'ordem', 'ciclo_id']));

        return response()->json([
            'message' => 'Ano Curricular criado com sucesso!',
            'data' => $ano_curricular
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $ano_curricular = Ano_curricular::find($id);

        if (!$ano_curricular) {
            return response()->json(['message' => 'Ano Curricular não encontrado'], 404);
        }

        $request->validate([
            'designacao' => 'sometimes|required|string|max:45',
            'ordem' => 'sometimes|required|integer',
            'ciclo_id' => 'sometimes|required|integer|exists:ciclo,id_ciclo',
        ]);

        $ano_curricular->update($request->only(['designacao', 'ordem', 'ciclo_id']));

        return response()->json([
            'message' => 'Ano Curricular atualizado com sucesso!',
            'data' => $ano_curricular
        ]);
    }

    public function list()
    {
        $anos_curriculares = Ano_curricular::with('ciclo')->get();

        // Se quiser só os campos que precisa:
        $anos_curriculares = $anos_curriculares->map(function($ano){
            return [
                'id_ano_curricular' => $ano->id_ano_curricular,
                'designacao' => $ano->designacao,
                'ordem' => $ano->ordem,
                'ciclo_id' => $ano->ciclo_id,
                'ciclo_designacao' => $ano->ciclo->designacao ?? null,
            ];
        });

        return response()->json($anos_curriculares);
    }



    public function show($id)
    {
        $ano_curricular = Ano_curricular::find($id);
        if (!$ano_curricular) {
            return response()->json(['message' => 'Ano Curricular não encontrado'], 404);
        }
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
