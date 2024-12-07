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
                'ocupacion' => 'nullable|string|max:255',
                'documento_identidad' => 'nullable|string|max:255',
                'cargo' => 'nullable|string|max:50',
                'tipo_autoridad' => 'nullable|string|max:50',
                'area_supervision' => 'nullable|string|max:100',
            ], [
                'correo.unique' => 'El correo electrónico ya está registrado para otro usuario. Por favor ingrese otro correo.',
                'required' => 'Campo vacío, por favor revisar los campos antes de envíar el formulario.',
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
        
                // Verificar y actualizar datos dependiendo del tipo de usuario
                if ($user->ciudadano) {
                    $ciudadano = $user->ciudadano;
                    $ciudadano->update([
                        'ocupacion' => $request->ocupacion,
                        'documento_identidad' => $request->documento_identidad,
                    ]);
                }
        
                if ($user->moderador) {
                    $moderador = $user->moderador;
                    $moderador->update([
                        'area_supervision' => $request->area_supervision,
                    ]);
                } elseif ($user->autoridad) {
                    $autoridad = $user->autoridad;
                    $autoridad->update([
                        'cargo' => $request->cargo,
                        'tipo_autoridad' => $request->tipo_autoridad,
                    ]);
                }
                session()->flash('success', 'Los cambios se han guardado correctamente.');
                return redirect()->route('cuenta.index')->withInput();
        
            } catch (\Exception $e) {
                return back()->withErrors(['message' => 'Ocurrió un error al actualizar los datos. Intenta de nuevo.']);
            }
        }        


        public function changePassword(Request $request)
        {
            try {
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

                // Redirigir con mensaje de éxito
                return redirect()->route('cuenta.index')->with('success', 'Contraseña actualizada correctamente.');

            } catch (\Exception $e) {
                \Log::error('Error al cambiar la contraseña del usuario ID ' . Auth::id() . ': ' . $e->getMessage());

                return back()->withErrors(['message' => 'Ocurrió un error al actualizar la contraseña. Intenta de nuevo.']);
            }
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
