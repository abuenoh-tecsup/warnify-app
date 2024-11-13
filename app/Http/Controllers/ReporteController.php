<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reporte;
use Carbon\Carbon;

class ReporteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('nuevo_reporte');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        /*
        $data = $request->validate([
            'titulo' => 'required|string|max:100',
            'descripcion' => 'required|string',
            'fecha_reporte' => 'required|string',
            'ubicacion' => 'required|string|max:100',
            'latitud' => 'nullable|numeric',
            'longitud' => 'nullable|numeric',
            'img_incidente' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);
        */

        $data = $request->all();

        $data['fecha_reporte'] = Carbon::createFromFormat('M j, Y h:i A', $request->fecha_reporte)->format('Y-m-d H:i:s');

        $data['estado_reporte'] = 'PENDIENTE';
        $data['id_autoridad'] = null;

        $data['id_usuario'] = 1;
        $data['fecha_act'] = Carbon::now();

        if ($request->hasFile('img_incidente')) {
            $nombreArchivo = 'reporte_' . time() . '.' . $request->file('img_incidente')->getClientOriginalExtension();
            $data['img_incidente'] = $request->file('img_incidente')->storeAs('public/reports_images', $nombreArchivo);
            $data['img_incidente'] = 'storage/reports_images/' . $nombreArchivo;
        }

        Reporte::create($data);

        return redirect()->route('reportes.inicio');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    public function list_details_all(string $id = null)
    {
        $reportes = Reporte::all();
        $reporteSeleccionado = $id ? Reporte::find($id) : null;

        return view('reportes', compact('reportes', 'reporteSeleccionado'));
    }
    /*
    public function list_own(string $id)
    {
        $reportes = Reporte::where('id_usuario', 1)->get();
        return view
    }
    */

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
