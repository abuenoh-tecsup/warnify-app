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
            // Validar que el correo no exista en la base de datos
            $validatedData = $request->validate([
                'nombre' => 'required|string|max:255',
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
                'nombre' => $request->nombre,
                'apellidos' => $request->apellidos,
                'email' => $request->correo,
                'telefono' => $request->telefono,
                'direccion' => $request->direccion,
                'notifi_acti' => $request->notificaciones,
            ]);

            // Mensaje de éxito
            session()->flash('success', 'Los cambios se han guardado correctamente.');

            // Redirigir a la misma página si la validación pasó, con los errores si los hubo
            return redirect()->route('cuenta.index')->withInput();
        }

    public function showChangePasswordForm()
            {
                return view('cuenta.change-password');
            }

        public function changePassword(Request $request)
            {
                // Validar las contraseñas
                $request->validate([
                    'actual' => 'required|string',
                    'nueva' => 'required|string|min:8|confirmed',
                ]);

                $user = Auth::user(); // Usuario autenticado

                // Validar si la contraseña actual coincide
                $actualIngresada = $request->actual;
                $actualAlmacenada = $user->password;

                // Comprobar la contraseña actual
                if (!Hash::check($actualIngresada, $actualAlmacenada)) {
                    return back()->withErrors(['actual' => 'La contraseña actual no es correcta.']);
                }

                // Actualizar la contraseña
                $user->password = Hash::make($request->nueva); // Encripta la nueva contraseña antes de guardarla
                $user->save();

                // Retornar un mensaje de éxito
                return redirect()->route('cuenta.index')->with('success', 'Contraseña actualizada correctamente.');
            }

    public function showestados()
            {
                $user = Auth::user(); // Obtener el usuario autenticado

                // Consultar los reportes pendientes del usuario
                $pendientes = Reporte::where('id_ciudadano', $user->id_usuario)
                          ->where('estado_reporte', 'pendiente')
                          ->count();

                // Contar los reportes resueltos
                $resueltos = Reporte::where('id_ciudadano', $user->id_usuario)
                                    ->where('estado_reporte', 'resuelto')
                                    ->count();

                // Retornar la vista con el número de reportes pendientes
                return view('cuenta', compact('user', 'pendientes', 'resueltos'));
            }


}
