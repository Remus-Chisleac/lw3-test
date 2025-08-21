<?php

namespace App\Livewire;


use Illuminate\Support\Facades\Log;
use Livewire\Component;

class EventTest extends Component
{
    public array $array = [1,2,3,4,5];
    public function render()
    {
        return view('livewire.event-test');
    }

}

