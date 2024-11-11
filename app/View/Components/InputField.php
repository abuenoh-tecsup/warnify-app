<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class InputField extends Component
{
    /**
     * Create a new component instance.
     */
    public $name;
    public $type;
    public $placeholder;
    public $value;

    public function __construct($name, $type = 'text', $placeholder = '', $value = '')
    {
        $this->name = $name;
        $this->type = $type;
        $this->placeholder = $placeholder;
        $this->value = $value;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.input-field');
    }
}
