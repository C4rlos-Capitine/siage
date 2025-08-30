<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nivel_academico;
class Nivel_academicoController extends Controller
{
    public function index()
    {
        $niveis_academicos = Nivel_academico::all();
        return view('nivel_academico.index', compact('niveis_academicos'));
    }

    public function create()
    {
        return view('nivel_academico.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'designacao' => 'required|string|max:255',
            'abreviatura' => 'required|string|max:50',
        ]);

        Nivel_academico::create($request->all());

        return redirect()->route('nivel_academico.index')
                         ->with('success', 'Nível Académico criado com sucesso.');
    }

    public function show($id)
    {
        $nivel_academico = Nivel_academico::find($id);
        return view('nivel_academico.show', compact('nivel_academico'));
    }

    public function edit($id)
    {
        $nivel_academico = Nivel_academico::find($id);
        return view('nivel_academico.edit', compact('nivel_academico'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'designacao' => 'required|string|max:255',
            'abreviatura' => 'required|string|max:50',
        ]);

        $nivel_academico = Nivel_academico::find($id);
        $nivel_academico->update($request->all());

        return redirect()->route('nivel_academico.index')
                         ->with('success', 'Nível Académico atualizado com sucesso.');
    }
}
