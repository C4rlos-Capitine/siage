<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Area_curricular;

class AreaCurricular extends Controller
{
    public function index()
    {
        $areas = Area_curricular::all();
        //return response()->json($areas);
        return view('area_curricular.index');
    }

    public function list(){
        $areas = Area_curricular::all();
        return response()->json($areas);
    }

    public function store(Request $request)
    {
        $request->validate([
            'designacao' => 'required|string|max:255',
            'abreviatura' => 'required|string|max:50',
        ]);

        $area = Area_curricular::create($request->all());

        return response()->json($area, 201);
    }

    public function show($id)
    {
        $area = Area_curricular::find($id);
        if (!$area) {
            return response()->json(['message' => 'Área Curricular não encontrada'], 404);
        }
        return response()->json($area);
    }

    public function update(Request $request, $id)
    {
        $area = Area_curricular::find($id);
        if (!$area) {
            return response()->json(['message' => 'Área Curricular não encontrada'], 404);
        }

        $request->validate([
            'designacao' => 'sometimes|required|string|max:255',
            'abreviatura' => 'sometimes|required|string|max:50',
        ]);

        $area->update($request->all());

        return response()->json($area);
    }

    public function destroy($id)
    {
        $area = Area_curricular::find($id);
        if (!$area) {
            return response()->json(['message' => 'Área Curricular não encontrada'], 404);
        }

        $area->delete();

        return response()->json(['message' => 'Área Curricular eliminada com sucesso']);
    }

    public function getByNivelEnsino($nivelEnsinoId)
    {
        $areas = Area_curricular::whereHas('disciplinas', function ($query) use ($nivelEnsinoId) {
            $query->where('nivel_ensino_id', $nivelEnsinoId);
        })->get();

        return response()->json($areas);
    }

    public function create()
    {
        return view('area_curricular.create');
    }

    public function edit($id)
    {
        $area = Area_curricular::find($id);
        return view('area_curricular.edit', compact('area'));
    }

    
}
