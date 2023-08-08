<?php

namespace App\Http\Livewire\Dash;

use App\Models\Pages\Faq;
use Livewire\Component;

class Faqs extends Component
{
    public Faq $faq;

    public $loopIteration;

    public function render()
    {
        return view('livewire.dash.faqs');
    }

    function destroy(){

        Faq::find($this->faq->id)->delete();

        session()->flash('success', 'Faq successfully Deleted...');

        return redirect()->route('dash.pricing.index');

    }
}
