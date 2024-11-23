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
    {        $request->validate([
            'contenido' => 'required|string|max:500', 
        ]);
        $ciudadano = Ciudadano::where('id_usuario', auth()->id())->first();

        if (!$ciudadano) {
            return redirect()->route('comentarios.index')->with('error', 'No se encontró tu perfil como ciudadano.');
        }

        Comentario::create([
            'id_ciudadano' => $ciudadano->id_ciudadano, 
            'contenido' => $request->input('contenido'),
        ]);

        return redirect()->route('comentarios.index')->with('success', 'Tu comentario ha sido enviado con éxito.');
    }

    public function edit($id)
        {
            $comentario = Comentario::findOrFail($id);
            if ($comentario->ciudadano->id_usuario !== auth()->id()) {
                return redirect()->route('comentarios.index')->with('error', 'No tienes permiso para editar este comentario.');
            }
            return view('editar_comentario', compact('comentario'));
        }

    
    public function update(Request $request, $id)
        {
            $request->validate([
                'contenido' => 'required|string|max:500',
            ]);

            $comentario = Comentario::findOrFail($id);

            if ($comentario->ciudadano->id_usuario !== auth()->id()) {
                return redirect()->route('comentarios.index')->with('error', 'No tienes permiso para actualizar este comentario.');
            }

            $comentario->update([
                'contenido' => $request->input('contenido'),
            ]);

            return redirect()->route('comentarios.index')->with('success', 'Tu comentario ha sido actualizado con éxito.');
        }
}
