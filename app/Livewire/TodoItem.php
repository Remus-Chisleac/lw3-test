<?php

namespace App\Livewire;

use Livewire\Component;

class TodoItem extends Component
{
    public $todo;
    public $index;
    public $totalCount;

    public function mount($todo, $index, $totalCount)
    {
        $this->todo = $todo;
        $this->index = $index;
        $this->totalCount = $totalCount;
    }

    public function toggleCompleted()
    {
        $this->dispatch('toggle-todo', $this->todo['id']);
    }

    public function moveUp()
    {
        $this->dispatch('move-up', $this->todo['id']);
    }

    public function moveDown()
    {
        $this->dispatch('move-down', $this->todo['id']);
    }

    public function deleteTodo()
    {
        $this->dispatch('delete-todo', $this->todo['id']);
    }

    public function render()
    {
        return view('livewire.todo-item');
    }
}