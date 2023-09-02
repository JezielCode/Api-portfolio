<?php

namespace App\Http\Controllers;

use App\Models\Education;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class EducationController extends Controller
{
    public function index()
    {
            $education= Education::all();
            return $education;
    }
    public function store(Request $request)
    {
        $request->validate([
            'degree' => 'required|string|max:255',
            'institution' => 'required|string',
            'description' => 'required|string',
            'start_date'=> 'required|date',
            'end_date'=> 'required|date',
        ]);
        try {
            Education::create([
                'degree' => $request->input('degree'),
                'description' => $request->input('description'),
                'institution' => $request->input('institution'),
                'start_date' => $request->input('start_date'),
                'end_date' => $request->input('end_date'),
                'user_id' => auth()->user()->id,
            ]);
            return response()->json(['message' => 'Educacion creado exitosamente']);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'error al crear Educacion']);
        }
    }
    public function show(string $id)
    {
        try {
            $education = Education::findOrFail($id);
            return response()->json($education);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Educacion no encontrado'], 404);
        }
    }
    public function update(Request $request, string $id)
    {
        try {
            $education = Education::findOrFail($id);
            $request->validate([
                'degree' => 'required|string|max:255',
                'institution' => 'required|string',
                'description' => 'required|string',
                'start_date'=> 'required|date',
                'end_date'=> 'required|date',
            ]);
            $education->update([
                'degree' => $request->input('degree'),
                'description' => $request->input('description'),
                'institution' => $request->input('institution'),
                'start_date' => $request->input('start_date'),
                'end_date' => $request->input('end_date'),
            ]);
            return response()->json(['message' => 'Educacion actualizado exitosamente']);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Educacion no encontrado'], 404);
        }
    }
    public function destroy(string $id)
    {
        try {
            $education = Education::findOrFail($id);
            $education->delete();
            return response()->json(['message' => 'Educacion eliminado exitosamente']);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Educacion no encontrado'], 404);
        }
    }
}
