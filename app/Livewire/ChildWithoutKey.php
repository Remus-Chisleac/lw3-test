<?php

namespace App\Livewire;

use Livewire\Component;

class ChildWithoutKey extends Component
{
    public $inputText = '';
    public $messageCount = 0;

    public function sendMessage()
    {
        if (trim($this->inputText)) {
            $this->messageCount++;
            $this->dispatch('child-message',
                message: $this->inputText,
                from : $this->getId(),
                time : now()->format('H:i:s')
            );
            $this->inputText = '';
        }
    }

    public function render()
    {
        return view('livewire.child-without-key');
    }
}
