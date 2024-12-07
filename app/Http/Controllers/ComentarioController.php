<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comentario;
use App\Models\Ciudadano;

class ComentarioController extends Controller
{
    /**
     * Mostrar la página "Acerca de" con los comentarios existentes.
     */
    public function index()
    {        $comentarios = Comentario::with('ciudadano.usuario')->latest()->get();
        return view('acerca', compact('comentarios'));
    }

    /**
     * Almacenar un nuevo comentario enviado por el usuario.
     */
    public function store(Request $request)
    {
        // Validación de los campos
        $request->validate([
            'contenido' => 'required|string|max:500', // Validación del contenido
        ], [
            'required' => 'Este campo no puede estar estar vacío. Por favor, ingresa un comentario.',  
            'string' => 'El contenido debe ser un texto válido.',  
            'max' => 'El contenido no puede tener más de 500 caracteres.',  
        ]);
    
        // Obtener el ciudadano actual
        $ciudadano = Ciudadano::where('id_usuario', auth()->id())->first();
    
        // Si no se encuentra el ciudadano, redirigir con mensaje de error
        if (!$ciudadano) {
            return redirect()->route('comentarios.index')->with('error', 'No se encontró tu perfil como ciudadano.');
        }
    
        // Crear el comentario
        Comentario::create([
            'id_ciudadano' => $ciudadano->id_ciudadano,
            'contenido' => $request->input('contenido'),
        ]);
    
        return redirect()->route('comentarios.index')->with('success', 'Tu comentario ha sido enviado con éxito.');
    }    

    
    public function update(Request $request, $id)
    {
        // Validación del contenido
        $request->validate([
            'contenido' => 'required|string|max:500',
        ], [
            'required' => 'Este campo no puede estar estar vacío. Por favor, ingresa un comentario.',
            'string' => 'El contenido debe ser un texto válido.',
            'max' => 'El contenido no puede tener más de 500 caracteres.',
        ]);
    
        // Obtener el comentario
        $comentario = Comentario::findOrFail($id);
    
        // Verificar si el usuario es el propietario del comentario
        if ($comentario->ciudadano->id_usuario !== auth()->id()) {
            return redirect()->route('comentarios.index')->with('error', 'No tienes permiso para actualizar este comentario.');
        }
    
        // Actualizar el comentario
        $comentario->update([
            'contenido' => $request->input('contenido'),
        ]);
    
        return redirect()->route('comentarios.index')->with('success', 'Tu comentario ha sido actualizado con éxito.');
    }    
}
