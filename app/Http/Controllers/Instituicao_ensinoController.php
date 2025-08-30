<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Instituicao_ensino;

class Instituicao_ensinoController extends Controller
{
    public function index()
    {
        $instituicoes = Instituicao_ensino::all();
        return response()->json($instituicoes);
    }
    public function store(Request $request)
    {
        $request->validate([
            'designacao' => 'required|string|max:255',
            'abreviatura' => 'required|string|max:50',
        ]);

        $instituicao = Instituicao_ensino::create($request->all());

        return response()->json($instituicao, 201);
    }

    public function show($id)
    {
        $instituicao = Instituicao_ensino::find($id);
        if (!$instituicao) {
            return response()->json(['message' => 'Instituição de Ensino não encontrada'], 404);
        }
        return response()->json($instituicao);
    }

    public function update(Request $request, $id)
    {
        $instituicao = Instituicao_ensino::find($id);
        if (!$instituicao) {
            return response()->json(['message' => 'Instituição de Ensino não encontrada'], 404);
        }

        $request->validate([
            'designacao' => 'sometimes|required|string|max:255',
            'abreviatura' => 'sometimes|required|string|max:50',
        ]);

        $instituicao->update($request->all());

        return response()->json($instituicao);
    }

    public function destroy($id)
    {
        $instituicao = Instituicao_ensino::find($id);
        if (!$instituicao) {
            return response()->json(['message' => 'Instituição de Ensino não encontrada'], 404);
        }

        $instituicao->delete();
        return response()->json(['message' => 'Instituição de Ensino eliminada com sucesso']);
    }

    public function searchByDesignacao($designacao)
    {
        $instituicoes = Instituicao_ensino::where('designacao', 'like', '%' . $designacao . '%')->get();
        return response()->json($instituicoes);
    }

    public function create()
    {
        // Retorna uma view para criar uma nova instituição de ensino (se aplicável)
        return view('instituicao_ensino.create');
    }

    public function edit($id)
    {
        // Retorna uma view para editar uma instituição de ensino existente (se aplicável)
        $instituicao = Instituicao_ensino::find($id);
        if (!$instituicao) {
            return response()->json(['message' => 'Instituição de Ensino não encontrada'], 404);
        }
        return view('instituicao_ensino.edit', compact('instituicao'));
    }

    public function getByAbreviatura($abreviatura)
    {
        $instituicoes = Instituicao_ensino::where('abreviatura', 'like', '%' . $abreviatura . '%')->get();
        return response()->json($instituicoes);
    }

    public function getByDesignacaoAndAbreviatura($designacao, $abreviatura)
    {
        $instituicoes = Instituicao_ensino::where('designacao', 'like', '%' . $designacao . '%')
            ->where('abreviatura', 'like', '%' . $abreviatura . '%')
            ->get();
        return response()->json($instituicoes);
    }

    public function getAllInstituicoes()
    {
        $instituicoes = Instituicao_ensino::all();
        return response()->json($instituicoes);
    }
}
