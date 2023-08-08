<?php

namespace App\View\Components;

use Illuminate\View\Component;

class PdfLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     *
     * @return mixed
     */
    public function render()
    {
        return view('layouts.pdf');
    }
}
