<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Ciclo;

class CicloController extends Controller
{
    public function index()
    {
        $ciclos = Ciclo::all();
       // return response()->json($ciclos);
        return view('ciclo.index', compact('ciclos'));
    }


    public function list(){
        $ciclos = Ciclo::all();
        return response()->json($ciclos);
    }

    public function create()
    {
        return view('ciclo.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'designacao' => 'required|string|max:255',
            //'estado' => 'required|in:ativo,inativo',
        ]);

        Ciclo::create($request->all());

        return response()->json(['message' => 'Ciclo criado com sucesso.'], 201);
    }

    public function show($id)
    {
        $ciclo = Ciclo::find($id);
        return response()->json($ciclo);
       // return view('ciclo.show', compact('ciclo'));
    }
    public function edit($id)
    {
        $ciclo = Ciclo::find($id);
        return response()->json($ciclo);
    }
    public function update(Request $request, $id)
    {
       // return response()->json($request->all());
        $request->validate([
            'designacao' => 'required|string|max:255',
            //'estado' => 'required|in:ativo,inativo',
        ]);

        $ciclo = Ciclo::find($id);
        $ciclo->update($request->all());

        return response()->json(['message' => 'Ciclo actualizado com sucesso.'], 200);
    }
}
