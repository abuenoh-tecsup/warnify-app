<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class ImageUpload extends Component
{
    /**
     * Create a new component instance.
     */
    public $name;
    public $value;

    public function __construct($name, $value = null)
    {
        $this->name = $name;
        $this->value = $value;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.image-upload');
    }
}
