<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reporte;
use Carbon\Carbon;

class ReporteController extends Controller
{
    public function index()
    {
        // Obtener los reportes más recientes (últimos 5) y formatear las fechas
        $reportesRecientes = Reporte::orderBy('fecha_reporte', 'desc')
            ->limit(5)
            ->get()
            ->map(function ($reporte) {
                $reporte->fecha_reporte = \Carbon\Carbon::parse($reporte->fecha_reporte)->format('M j, Y h:i A');
                return $reporte;
            });
        $misReportes = Reporte::where('id_ciudadano', Auth::user()->id_usuario)
            ->orderBy('fecha_reporte', 'desc')
            ->limit(5)
            ->get()
            ->map(function ($reporte) {
                $reporte->fecha_reporte = \Carbon\Carbon::parse($reporte->fecha_reporte)->format('M j, Y h:i A');
                return $reporte;
            });
        $totalReportes = Reporte::count();
        $pendientes = Reporte::where('estado_reporte', 'PENDIENTE')->count();
        $resueltos = Reporte::where('estado_reporte', 'RESUELTO')->count();
        $enProceso = Reporte::where('estado_reporte', 'EN PROCESO')->count();

        return view('inicio', compact(
            'reportesRecientes',
            'misReportes',
            'totalReportes',
            'pendientes',
            'resueltos',
            'enProceso'
        ));
    }


    public function create()
        {
            return view('nuevo_reporte');
        }


        public function store(Request $request)
        {
            $data = $request->validate([
                'titulo' => 'required|string|max:100',
                'descripcion' => 'required|string',
                'fecha_reporte' => 'required|string',
                'ubicacion' => 'required|string|max:100',
                'latitud' => 'nullable|numeric',
                'longitud' => 'nullable|numeric',
                'img_incidente' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
            ]);
            $data['fecha_reporte'] = Carbon::createFromFormat('M j, Y h:i A', $request->fecha_reporte)->format('Y-m-d H:i:s');
            $data['estado_reporte'] = 'PENDIENTE';
            $data['id_autoridad'] = null;
            $data['fecha_act'] = Carbon::now();
            $data['id_ciudadano'] = Auth::user()->id_usuario;
            if ($request->hasFile('img_incidente')) {
                $nombreArchivo = 'reporte_' . time() . '.' . $request->file('img_incidente')->getClientOriginalExtension();
                $data['img_incidente'] = $request->file('img_incidente')->storeAs('/reports_images', $nombreArchivo, 'public');
                $data['img_incidente'] = 'storage/reports_images/' . $nombreArchivo;
            }
            Reporte::create($data);
            return redirect()->route('reportes.inicio')->with('success', 'Reporte guardado con éxito');
        }


    public function show(string $id){

    }

    public function list_details_all(string $filter = 'all', string $state = null, string $order = 'desc', string $id = null)
    {
        $user = Auth::user();

        $query = Reporte::query();

        // Filtrar por usuario
        if ($filter === 'own') {
            $query->where('id_ciudadano', $user->id_usuario);
        }

        // Filtrar por estado
        if ($state) {
            $query->where('estado_reporte', $state);
        }

        // Ordenar por fecha
        $query->orderBy('fecha_reporte', $order);

        // Obtener los reportes y reporte seleccionado
        $reportes = $query->get();
        $reporteSeleccionado = $id ? Reporte::find($id) : null;

        return view('reportes', compact('reportes', 'reporteSeleccionado', 'filter', 'state', 'order'));
    }






    public function edit(string $id)
        {
            $reporte = Reporte::findOrFail($id);
            return view('editar_reporte', compact('reporte'));
        }


    public function update(Request $request, string $id)
        {
            $data = $request->validate([
                'titulo' => 'required|string|max:100',
                'descripcion' => 'required|string',
                'fecha_reporte' => 'required|string',
                'ubicacion' => 'required|string|max:100',
                'latitud' => 'nullable|numeric',
                'longitud' => 'nullable|numeric',
                'img_incidente' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
            ]);

            $data['fecha_reporte'] = Carbon::createFromFormat('M j, Y h:i A', $request->fecha_reporte)->format('Y-m-d H:i:s');
            $data['fecha_act'] = Carbon::now();

            if ($request->hasFile('img_incidente')) {
                $nombreArchivo = 'reporte_' . time() . '.' . $request->file('img_incidente')->getClientOriginalExtension();
                $data['img_incidente'] = $request->file('img_incidente')->storeAs('/reports_images', $nombreArchivo, 'public');
                $data['img_incidente'] = 'storage/reports_images/' . $nombreArchivo;
            }

            $reporte = Reporte::findOrFail($id);

            $reporte->update($data);

            return redirect()->route('reportes.inicio');
        }

    public function edit_moderador(string $id)
        {
            $reporte = Reporte::findOrFail($id);
            return view('moderar_reporte', compact('reporte'));
        }

        public function update_moderador(Request $request, string $id)
        {
            // Buscar el reporte
            $reporte = Reporte::findOrFail($id);

            // Modificar el estado del reporte
            $reporte->estado_reporte = $request->input('estado_reporte');
            $reporte->save();

            // Redirigir al listado de todos los reportes
            return redirect()->route('reportes.list', ['filter' => 'all']);
        }


    public function edit_autoridad(string $id)
        {
            $reporte = Reporte::findOrFail($id);
            return view('resolver_reporte', compact('reporte'));
        }
    public function update_autoridad(Request $request, string $id)
        {
            $reporte = Reporte::findOrFail($id);
            $reporte->estado_reporte = $request->input('estado_reporte');
            $reporte->save();
            return redirect()->route('reportes.list', ['filter' => 'all']);
        }


    public function destroy(string $id)
        {
            //
        }
}
