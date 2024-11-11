<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class TextareaField extends Component
{
    /**
     * Create a new component instance.
     */
    public $name;
    public $placeholder;
    public $rows;
    public $value;

    public function __construct($name, $placeholder = '', $rows = 5, $value = '')
    {
        $this->name = $name;
        $this->placeholder = $placeholder;
        $this->rows = $rows;
        $this->value = $value;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.textarea-field');
    }
}
