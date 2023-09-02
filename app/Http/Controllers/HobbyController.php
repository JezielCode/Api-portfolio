<?php

namespace App\Http\Controllers;

use App\Models\Hobby;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class HobbyController extends Controller
{
    public function index()
    {
        try {
            $hobby= Hobby::all();
            return $hobby;
        } catch (\Throwable $th) {
            return response()->json(['error' => 'no encontrado'], 404);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'nullable|string',
        ]);
        try {
            Hobby::create([
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'icon' => $request->input('icon'),
                'user_id' => auth()->user()->id,
            ]);
            return response()->json(['message' => 'Hobby creado exitosamente']);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'error al crear hobby']);
        }
    }

    public function show(string $id)
    {
        try {
            $hobby = Hobby::findOrFail($id);
            return response()->json($hobby);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Hobby no encontrado'], 404);
        }
    }
    public function update(Request $request, string $id)
    {
        try {
            $hobby = Hobby::findOrFail($id);
            $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'icon' => 'nullable|string',
            ]);
            $hobby->update([
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'icon' => $request->input('icon'),
            ]);

            return response()->json(['message' => 'Hobby actualizado exitosamente']);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Hobby no encontrado'], 404);
        }
    }
    public function destroy(string $id)
    {
        try {
            $skill = Hobby::findOrFail($id);
            $skill->delete();
            return response()->json(['message' => 'Hobby eliminado exitosamente']);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Hobby no encontrado'], 404);
        }
    }
}
