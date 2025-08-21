<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;

class ParentWithChildRandomKey extends Component
{
    public $receivedMessages = [];
    public $messageCount = 0;

    #[On('child-message')]
    public function handleChildMessage($message, $from, $time)
    {
        $this->messageCount++;
        array_unshift($this->receivedMessages, [
            'message' => $message,
            'from' => $from,
            'time' => $time
        ]);
        
        // Keep only the last 5 messages
        $this->receivedMessages = array_slice($this->receivedMessages, 0, 5);
    }

    public function render()
    {
        return view('livewire.parent-with-child-random-key');
    }
}