<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        // Lógica para listar usuários
        $users = User::all();
        return response()->json($users);
    }
    public function store(Request $request)
    {
        // Lógica para criar um novo usuário
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create($request->all());

        return response()->json($user, 201);
    }
    public function show($id)
    {
        // Lógica para mostrar um usuário específico
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'Usuário não encontrado'], 404);
        }
        return response()->json($user);
    }
    public function update(Request $request, $id)
    {
        // Lógica para atualizar um usuário específico
        $user = User::find($id);                
        if (!$user) {
            return response()->json(['message' => 'Usuário não encontrado'], 404);
        }
        $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|string|email|max:255|unique:users,email,'.$id,
            'password' => 'sometimes|required|string|min:8',
        ]);
        $user->update($request->all());
        return response()->json($user);
    }

    public function destroy($id)
    {
        // Lógica para deletar um usuário específico
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'Usuário não encontrado'], 404);
        }
        $user->delete();
        return response()->json(['message' => 'Usuário deletado com sucesso']);
    }
    
}
