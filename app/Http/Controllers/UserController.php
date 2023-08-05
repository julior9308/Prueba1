<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function mayoresDe25()
    {
        $usuariosConImagenes = User::with('images')
            ->where('edad', '>', 25)
            ->get();

        $result = [];

        foreach ($usuariosConImagenes as $usuario) {
            $usuarioData = [
                'nombre' => $usuario->name, // Reemplaza con el campo correcto
                'edad' => $usuario->edad,     // Reemplaza con el campo correcto
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
