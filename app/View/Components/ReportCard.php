<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class ReportCard extends Component
{
    /**
     * Create a new component instance.
     */
    public $titulo;
    public $fecha;
    public $descripcion;
    public $estado;
    public $reporteId;

    public function __construct($titulo, $fecha, $descripcion, $estado = '', $reporteId)
    {
        $this->titulo = $titulo;
        $this->fecha = $fecha;
        $this->descripcion = $descripcion;
        $this->estado = $estado;
        $this->reporteId = $reporteId;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.report-card');
    }
}
