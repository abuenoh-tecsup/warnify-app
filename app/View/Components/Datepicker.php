<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class Datepicker extends Component
{
    /**
     * Create a new component instance.
     */
    public $name;
    public $value;
    public $placeholder;

    public function __construct($name = '', $value = '', $placeholder = '')
    {
        // Asignamos los valores pasados al constructor a las propiedades
        $this->name = $name;
        $this->value = $value;
        $this->placeholder = $placeholder;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.datepicker');
    }
}
