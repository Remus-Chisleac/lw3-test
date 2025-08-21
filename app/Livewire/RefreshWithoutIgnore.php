<?php

namespace App\Livewire;

use Livewire\Component;

class RefreshWithoutIgnore extends Component
{
    public $selectedUser = 1;
    public $users = [];

    public function mount()
    {
        $this->users = [
            ['id' => 1, 'name' => 'John Doe', 'email' => 'john@example.com'],
            ['id' => 2, 'name' => 'Jane Smith', 'email' => 'jane@example.com'],
            ['id' => 3, 'name' => 'Bob Johnson', 'email' => 'bob@example.com'],
        ];
    }

    public function switchUser($userId)
    {
        dump($this->users);
        $this->selectedUser = $userId;
        // No need to update refresh key - component updates automatically
    }

    public function getCurrentUser()
    {
        return collect($this->users)->firstWhere('id', $this->selectedUser);
    }

    public function render()
    {
        return view('livewire.refresh-without-ignore');
    }
}
