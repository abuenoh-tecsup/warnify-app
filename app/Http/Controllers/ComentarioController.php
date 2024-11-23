<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comentario; // Importar el modelo Comentario
use App\Models\Ciudadano; // Importar el modelo Ciudadano

class ComentarioController extends Controller
{
    /**
     * Mostrar la página "Acerca de" con los comentarios existentes.
     */
    public function index()
    {
        // Cargar los comentarios con las relaciones 'ciudadano' y 'usuario'
        $comentarios = Comentario::with('ciudadano.usuario')->latest()->get();

        // Retornar la vista "acerca" con los comentarios
        return view('acerca', compact('comentarios'));
    }

    /**
     * Almacenar un nuevo comentario enviado por el usuario.
     */
    public function store(Request $request)
    {
        // Validar la entrada del formulario
        $request->validate([
            'contenido' => 'required|string|max:500', // Campo obligatorio con un máximo de 500 caracteres
        ]);

        // Obtener el ciudadano relacionado con el usuario autenticado
        $ciudadano = Ciudadano::where('id_usuario', auth()->id())->first();

        // Si no se encuentra el ciudadano, retornar con un mensaje de error
        if (!$ciudadano) {
            return redirect()->route('comentarios.index')->with('error', 'No se encontró tu perfil como ciudadano.');
        }

        // Crear el comentario asociado al ciudadano autenticado
        Comentario::create([
            'id_ciudadano' => $ciudadano->id_ciudadano, // Relacionar el comentario con el ciudadano autenticado
            'contenido' => $request->input('contenido'),
        ]);

        // Redirigir a la página "Acerca de" con un mensaje de éxito
        return redirect()->route('comentarios.index')->with('success', 'Tu comentario ha sido enviado con éxito.');
    }

    /**
     * Mostrar el formulario de edición de un comentario.
     */
    public function edit($id)
    {
        // Obtener el comentario con su relación
        $comentario = Comentario::findOrFail($id);

        // Validar que el comentario pertenezca al usuario autenticado
        if ($comentario->ciudadano->id_usuario !== auth()->id()) {
            return redirect()->route('comentarios.index')->with('error', 'No tienes permiso para editar este comentario.');
        }

        // Retornar la vista con el comentario a editar
        return view('editar_comentario', compact('comentario'));
    }

    /**
     * Actualizar un comentario existente.
     */
    public function update(Request $request, $id)
    {
        // Validar la entrada del formulario
        $request->validate([
            'contenido' => 'required|string|max:500', // Campo obligatorio con un máximo de 500 caracteres
        ]);

        // Obtener el comentario
        $comentario = Comentario::findOrFail($id);

        // Validar que el comentario pertenezca al usuario autenticado
        if ($comentario->ciudadano->id_usuario !== auth()->id()) {
            return redirect()->route('comentarios.index')->with('error', 'No tienes permiso para actualizar este comentario.');
        }

        // Actualizar el contenido del comentario
        $comentario->update([
            'contenido' => $request->input('contenido'),
        ]);

        // Redirigir con un mensaje de éxito
        return redirect()->route('comentarios.index')->with('success', 'Tu comentario ha sido actualizado con éxito.');
    }
}
