<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;

class Counter extends Component
{
    public int $count =0 ;
    public function render()
    {
        return view('livewire.counter');
    }

    #[On('increment')]
    public function increment()
    {
     $this->count++;
    }
}
