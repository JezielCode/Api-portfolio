<?php

namespace App\Http\Controllers;
use Illuminate\Auth\Access\AuthorizationException;
use App\Models\Project;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
            $proyect= Project::all();
            return $proyect;
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'imagen' => 'nullable|string',
            'link' => 'nullable|string',
            'content' => 'required|string',
        ]);
        try {
            Project::create([
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'imagen' => $request->input('imagen'),
                'link' => $request->input('link'),
                'content' => $request->input('content'),
                'user_id' => auth()->user()->id,
            ]);
            return response()->json(['message' => 'Proyecto creado exitosamente']);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'error al crear Proyecto']);
        }
    }
    public function show(string $id)
    {
        try {
            $project = Project::findOrFail($id);
            return response()->json($project);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Proyecto no encontrado'], 404);
        }
    }
    public function update(Request $request, string $id)
    {
        try {
            $project = Project::findOrFail($id);
            $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'imagen' => 'nullable|string',
                'link' => 'nullable|string',
                'content' => 'required|string',
            ]);
            $project->update([
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'imagen' => $request->input('imagen'),
                'link' => $request->input('link'),
                'content' => $request->input('content'),
            ]);
            return response()->json(['message' => 'Proyecto actualizado exitosamente']);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Proyecto no encontrado'], 404);
        }
    }
    public function destroy(string $id)
    {
        try {
            $project = Project::findOrFail($id);
            $project->delete();
            return response()->json(['message' => 'Proyecto eliminado exitosamente']);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Proyecto no encontrado'], 404);
        }
    }
}
