<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Provincia;
class ProvinciaController extends Controller
{
    public function index()
    {
        $provincias = Provincia::all();
        return view('provincia.index');
        //return response()->json($provincias);
    }
    public function list(){
        $provincias = Provincia::all();
        return response()->json($provincias);
    }

    public function store(Request $request)
    {
        $request->validate([
            'designacao' => 'required|string|max:255',
            'abreviatura' => 'required|string|max:50',
        ]);

        $provincia = Provincia::create($request->all());

        return response()->json($provincia, 201);
    }

    public function show($id)
    {
        $provincia = Provincia::find($id);
        if (!$provincia) {
            return response()->json(['message' => 'Província não encontrada'], 404);
        }
        return response()->json($provincia);
    }

    public function update(Request $request, $id)
    {
        $provincia = Provincia::find($id);
        if (!$provincia) {
            return response()->json(['message' => 'Província não encontrada'], 404);
        }

        $request->validate([
            'designacao' => 'sometimes|required|string|max:255',
            'abreviatura' => 'sometimes|required|string|max:50',
        ]);

        $provincia->update($request->all());

        return response()->json($provincia);
    }

    public function destroy($id)
    {
        $provincia = Provincia::find($id);
        if (!$provincia) {
            return response()->json(['message' => 'Província não encontrada'], 404);
        }

        $provincia->delete();
        return response()->json(['message' => 'Província eliminada com sucesso']);
    }
}
