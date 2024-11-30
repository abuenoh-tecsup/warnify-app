<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Reporte;


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
            $request->validate([
                'nombre' => 'required|string|max:255',
                'apellidos' => 'required|string|max:255',
                'correo' => 'required|email|unique:users,email,' . auth()->id(), 
                'telefono' => 'required|string|max:20',
                'direccion' => 'required|string|max:255',
                'notificaciones' => 'required|boolean',
                'ocupacion' => 'required|string|max:255',
                'documento_identidad' => 'required|string|max:255',
            ], [
                'correo.unique' => 'El correo electrónico ya está registrado para otro usuario. Por favor ingrese otro correo.'
            ]);

            try {
                $user = auth()->user();
                $user->update([
                    'nombre' => $request->nombre,
                    'apellidos' => $request->apellidos,
                    'email' => $request->correo,
                    'telefono' => $request->telefono,
                    'direccion' => $request->direccion,
                    'notifi_acti' => $request->notificaciones,
                ]);

                $ciudadano = Auth::user()->ciudadano;

                if ($ciudadano) {
                    $ciudadano->update([
                        'ocupacion' => $request->ocupacion,
                        'documento_identidad' => $request->documento_identidad,
                    ]);
                } else {
                    // Error si no se encuentra el ciudadano
                    return back()->withErrors(['message' => 'Ciudadano no encontrado para este usuario.']);
                }

                // Mensaje de éxito
                session()->flash('success', 'Los cambios se han guardado correctamente.');
                return redirect()->route('cuenta.index')->withInput();

            } catch (\Exception $e) {
                // Si ocurre algún error inesperado
                return back()->withErrors(['message' => 'Ocurrió un error al actualizar los datos. Intenta de nuevo.']);
            }
        }

        public function changePassword(Request $request)
        {
            // Validar las contraseñas
            $request->validate([
                'actual' => 'required|string',
                'nueva' => 'required|string|min:8|confirmed',  
            ], [
                'nueva.min' => 'La nueva contraseña debe tener al menos 8 caracteres.',
                'nueva.confirmed' => 'La confirmación de la nueva contraseña no coincide.',
            ]);
            $user = Auth::user();
            $actualIngresada = $request->actual;
            $actualAlmacenada = $user->password;

            if (!Hash::check($actualIngresada, $actualAlmacenada)) {
                return back()->withErrors(['actual' => 'La contraseña actual no es correcta.']);
            }
            $user->password = Hash::make($request->nueva);
            $user->save();

            return redirect()->route('cuenta.index')->with('success', 'Contraseña actualizada correctamente.');
        }


              

        public function showestados()
                {
                    $user = Auth::user();
                    $pendientes = Reporte::where('id_ciudadano', $user->id_usuario)
                            ->where('estado_reporte', 'pendiente')
                            ->count();
                    $resueltos = Reporte::where('id_ciudadano', $user->id_usuario)
                                        ->where('estado_reporte', 'resuelto')
                                        ->count();
                    return view('cuenta', compact('user', 'pendientes', 'resueltos'));
                }


}
