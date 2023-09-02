<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    public function index()
    {
        try {
            $skill= Skill::all();
            return $skill;
        } catch (\Throwable $th) {
            return response()->json(['error' => 'no encontrado'], 404);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'nullable|string',
        ]);
        try {
            Skill::create([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'icon' => $request->input('icon'),
                'user_id' => auth()->user()->id,
            ]);
            return response()->json(['message' => 'Skill creado exitosamente']);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'error al crear skill']);
        }
    }

    public function show(string $id)
    {
        try {
            $skill = Skill::findOrFail($id);
            return response()->json($skill);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Skill no encontrado'], 404);
        }
    }

    public function update(Request $request, string $id)
    {
        try {
            $skill = Skill::findOrFail($id);
            $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'required|string',
                'icon' => 'nullable|string',
            ]);
            $skill->update([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'icon' => $request->input('icon'),
            ]);

            return response()->json(['message' => 'Skill actualizado exitosamente']);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Skill no encontrado'], 404);
        }
    }
    public function destroy(string $id)
    {
        try {
            $skill = Skill::findOrFail($id);
            $skill->delete();
            return response()->json(['message' => 'Skill eliminado exitosamente']);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Skill no encontrado'], 404);
        }
    }
}
