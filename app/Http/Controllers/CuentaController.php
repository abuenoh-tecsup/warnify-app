<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CuentaController extends Controller
{
    // Método para mostrar los datos de la cuenta
            public function show()
            {
            $user = Auth::user();
            return view('cuenta', compact('user'));
            }

    // Método para actualizar los datos 
    public function update(Request $request)
        {
            // Validar que el correo no exista en la base de datos
            $validatedData = $request->validate([
                'nombre_completo' => 'required|string|max:255',
                'correo' => 'required|email|unique:users,email,' . auth()->id(),  // Verificar si el correo ya está en uso
                'telefono' => 'required|string|max:20',
                'direccion' => 'required|string|max:255',
                'notificaciones' => 'required|boolean',
            ], [
                'correo.unique' => 'El correo electrónico ya está registrado para otro usuario. Por favor ingrese otro correo.'
            ]);

            // Si la validación pasa, actualizamos los datos del usuario
            $user = auth()->user();
            $user->update([
                'nombre_apellido' => $request->nombre_completo,
                'email' => $request->correo,
                'telefono' => $request->telefono,
                'direccion' => $request->direccion,
                'notifi_acti' => $request->notificaciones,
            ]);

            // Enviar un mensaje de éxito
            session()->flash('success', 'Los cambios se han guardado correctamente.');

            // Redirigir a la misma página si la validación pasó, con los errores si los hubo
            return redirect()->route('cuenta.index')->withInput();  // withInput() mantiene los valores ingresados en el formulario
        }
  
}
