<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Formacao_academica;
class Formacao_academicaController extends Controller
{
    public function index()
    {
        $formacoes = Formacao_academica::all();
        return response()->json($formacoes);
    }

    public function store(Request $request)
    {
        $request->validate([
            'designacao' => 'required|string|max:255',
            'abreviatura' => 'required|string|max:50',
        ]);

        $formacao = Formacao_academica::create($request->all());

        return response()->json($formacao, 201);
    }

    public function show($id)
    {
        $formacao = Formacao_academica::find($id);
        if (!$formacao) {
            return response()->json(['message' => 'Formação Académica não encontrada'], 404);
        }
        return response()->json($formacao);
    }

    public function update(Request $request, $id)
    {
        $formacao = Formacao_academica::find($id);
        if (!$formacao) {
            return response()->json(['message' => 'Formação Académica não encontrada'], 404);
        }

        $request->validate([
            'designacao' => 'sometimes|required|string|max:255',
            'abreviatura' => 'sometimes|required|string|max:50',
        ]);

        $formacao->update($request->all());

        return response()->json($formacao);
    }

    public function destroy($id)
    {
        $formacao = Formacao_academica::find($id);
        if (!$formacao) {
            return response()->json(['message' => 'Formação Académica não encontrada'], 404);
        }

        $formacao->delete();

        return response()->json(['message' => 'Formação Académica eliminada com sucesso']);
    }

    public function getFormacoesByNivelAcademico($nivelAcademicoId)
    {
        $formacoes = Formacao_academica::where('nivel_academico_id', $nivelAcademicoId)->get();
        return response()->json($formacoes);
    }

    public function create()
    {
        return view('formacao_academica.create');
    }

    public function edit($id)
    {
        $formacao = Formacao_academica::find($id);
        return view('formacao_academica.edit', compact('formacao'));
    }

    public function getByNivelAcademico($nivelAcademicoId)
    {
        $formacoes = Formacao_academica::where('nivel_academico_id', $nivelAcademicoId)->get();
        return response()->json($formacoes);
    }

    public function getByDesignacao($designacao)
    {
        $formacoes = Formacao_academica::where('designacao', 'like', '%' . $designacao . '%')->get();
        return response()->json($formacoes);
    }
     public function getByAbreviatura($abreviatura)
    {
        $formacoes = Formacao_academica::where('abreviatura', 'like', '%' . $abreviatura . '%')->get();
        return response()->json($formacoes);
    }
}
