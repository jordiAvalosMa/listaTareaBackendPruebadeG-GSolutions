<?php

namespace App\Http\Controllers;

use App\Models\Tarea;
use Illuminate\Http\Request;

class TareaController extends Controller
{

    public function index()
    {
        return response()->json(Tarea::paginate(10));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
        ]);

        $tarea = Tarea::create([
            'titulo' => $validated['titulo'],
            'descripcion' => $validated['descripcion'] ?? '',
            'completada' => false,
        ]);

        return response()->json($tarea, 201);
    }


    public function update(Request $request, Tarea $tarea)
    {
        $validated = $request->validate([
            'completada' => 'required|boolean',
        ]);

        $tarea->update(['completada' => $validated['completada']]);

        return response()->json($tarea);
    }


    public function filtradas($completada)
    {
        if (!in_array($completada, [0, 1])) {
            return response()->json(['error' => 'Estado de tarea inválido'], 400);
        }

        return response()->json(Tarea::where('completada', $completada)->paginate(10));
    }
}
