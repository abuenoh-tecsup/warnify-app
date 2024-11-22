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
                'nombres' => 'required|string|max:255',
                'apellidos' => 'required|string|max:255',
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
                'nombres' => $request->nombres,
                'apellidos' => $request->apellidos,
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

        public function showChangePasswordForm()
    {
        return view('cuenta.change-password');
    }

    // Método para actualizar la contraseña
    public function changePassword(Request $request)
        {
            // Validar las contraseñas
            $request->validate([
                'actual' => 'required|string',
                'nueva' => 'required|string|min:8|confirmed',  // Verifica que 'nueva' y 'nueva_confirmation' coincidan
                'verificar' => 'required|string|same:nueva',  // Verifica que 'verificar' sea igual a 'nueva'
            ]);

            $user = Auth::user();

            // Verificar si la contraseña actual es correcta
            if (!Hash::check($request->actual, $user->password)) {
                return back()->withErrors(['actual' => 'La contraseña actual no es correcta.']);
            }

            // Actualizar la contraseña
            $user->password = Hash::make($request->nueva);
            $user->save();

            // Retornar un mensaje de éxito
            return redirect()->route('cuenta.index')->with('success', 'Contraseña actualizada correctamente.');
        }

}
