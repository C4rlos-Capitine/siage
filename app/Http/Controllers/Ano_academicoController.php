<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ano_academico;

class Ano_academicoController extends Controller
{
    public function index()
    {
        $anos_academicos = Ano_academico::all();
        return view('ano_academico.index', compact('anos_academicos'));
    }

    public function create()
    {
        return view('ano_academico.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'designacao' => 'required|string|max:255',
            'data_inicio' => 'required|date',
            'data_fim' => 'required|date|after:data_inicio',
            'estado' => 'required|in:ativo,inativo',
        ]);

        Ano_academico::create($request->all());

        return redirect()->route('ano_academico.index')
                         ->with('success', 'Ano Académico criado com sucesso.');
    }

    public function show($id)
    {
        $ano_academico = Ano_academico::find($id);
        return view('ano_academico.show', compact('ano_academico'));
    }

    public function edit($id)
    {
        $ano_academico = Ano_academico::find($id);
        return view('ano_academico.edit', compact('ano_academico'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'designacao' => 'required|string|max:255',
            'data_inicio' => 'required|date',
            'data_fim' => 'required|date|after:data_inicio',
            'estado' => 'required|in:ativo,inativo',
        ]);

        $ano_academico = Ano_academico::find($id);
        $ano_academico->update($request->all());

        return redirect()->route('ano_academico.index')
                         ->with('success', 'Ano Académico atualizado com sucesso.');
    }
}
