<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function create(Request $request) //Ya Funciona
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'edad' => 'required',


        ]);

        $user = User::create($data);

        return response()->json(['message' => 'Usuario creado correctamente', 'user' => $user]);
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'edad' => 'required',

        ]);

        $user->update($data);

        return response()->json(['message' => 'User actualizado correctamente', 'user' => $user]);
    }

    public function destroy(User $user)
    {
        $user->delete();

        return response()->json(['message' => 'User eliminado correctamente']);
    }

    public function mayoresDe25()
    {

        $usuariosConImagenes = User::with('images')
            ->where('edad', '>', 25)
            ->get();

        $result = [];

        foreach ($usuariosConImagenes as $usuario) {
            $usuarioData = [
                'nombre' => $usuario->name,
                'edad' => $usuario->edad,
                'imagenes' => [],
            ];

            foreach ($usuario->images as $imagen) {
                $usuarioData['imagenes'][] = [
                    'url' => $imagen->url,
                    'es visible' => $imagen->is_visible,
                ];
            }

            $result[] = $usuarioData;
        }

        return response()->json($result, 200, [], JSON_PRETTY_PRINT);
    }
}
