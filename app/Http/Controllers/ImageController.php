<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageController extends Controller
{
    //
    public function create(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'url' => 'required',
            'is_visible' => 'required|boolean',

        ]);

        $image = Image::create($data);

        return response()->json(['message' => 'Imagen creada correctamente', 'image' => $image]);
    }

    public function update(Request $request, Image $image)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'url' => 'required',
            'is_visible' => 'required|boolean',

        ]);

        $image->update($data);

        return response()->json(['message' => 'Imagen actualizada correctamente', 'image' => $image]);
    }

    public function destroy(Image $image)
    {
        $image->delete();

        return response()->json(['message' => 'Imagen eliminada correctamente']);
    }
}
