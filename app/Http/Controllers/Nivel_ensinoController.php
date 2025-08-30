<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Nivel_ensinoController extends Controller
{
    public function index()
    {
        $niveis_ensino = Nivel_ensino::all();
        return view('nivel_ensino.index', compact('niveis_ensino'));
    }

    public function create()
    {
        return view('nivel_ensino.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'designacao' => 'required|string|max:255',
            'abreviatura' => 'required|string|max:50',
        ]);

        Nivel_ensino::create($request->all());

        return redirect()->route('nivel_ensino.index')
                         ->with('success', 'Nível de Ensino criado com sucesso.');
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

    public function update(Request $request, $id)
    {
        $request->validate([
            'designacao' => 'required|string|max:255',
            'abreviatura' => 'required|string|max:50',
        ]);

        $nivel_ensino = Nivel_ensino::find($id);
        $nivel_ensino->update($request->all());

        return redirect()->route('nivel_ensino.index')
                         ->with('success', 'Nível de Ensino atualizado com sucesso.');
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
