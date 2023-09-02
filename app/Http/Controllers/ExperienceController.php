<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class ExperienceController extends Controller
{
    public function index()
    {
            $experience= Experience::all();
            return $experience;
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'company' => 'required|string',
            'start_date'=> 'required|date',
            'end_date'=> 'required|date',
        ]);
        try {
            Experience::create([
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'company' => $request->input('company'),
                'start_date' => $request->input('start_date'),
                'end_date' => $request->input('end_date'),
                'user_id' => auth()->user()->id,
            ]);
            return response()->json(['message' => 'Experiencia creado exitosamente']);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'error al crear Experiencia']);
        }
    }
    public function show(string $id)
    {
        try {
            $experience = Experience::findOrFail($id);
            return response()->json($experience);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Experiencia no encontrado'], 404);
        }
    }
    public function update(Request $request, string $id)
    {
        try {
            $experience = Experience::findOrFail($id);
            $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'company' => 'required|string',
                'start_date'=> 'required|date',
                'end_date'=> 'required|date',
            ]);
            $experience->update([
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'company' => $request->input('company'),
                'start_date' => $request->input('start_date'),
                'end_date' => $request->input('end_date'),
            ]);
            return response()->json(['message' => 'Experiencia actualizado exitosamente']);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Experiencia no encontrado'], 404);
        }
    }
    public function destroy(string $id)
    {
        try {
            $experience = Experience::findOrFail($id);
            $experience->delete();
            return response()->json(['message' => 'Experiencia eliminado exitosamente']);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Experiencia no encontrado'], 404);
        }
    }
}
