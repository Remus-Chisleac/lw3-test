<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;

class PartialKeyTodoList extends Component
{
    public $todos = [];
    public $newTodo = '';

    public function mount()
    {
        $this->todos = [
            ['id' => 1, 'text' => 'Learn about partial wire:key usage', 'completed' => false],
            ['id' => 2, 'text' => 'Understand div state vs component state', 'completed' => true],
            ['id' => 3, 'text' => 'See mixed behavior in action', 'completed' => false],
            ['id' => 4, 'text' => 'Notice the difference in behavior', 'completed' => false],
        ];
    }

    public function addTodo()
    {
        if (trim($this->newTodo)) {
            $newId = count($this->todos) ? max(array_column($this->todos, 'id')) + 1 : 1;
            array_unshift($this->todos, [
                'id' => $newId,
                'text' => $this->newTodo,
                'completed' => false
            ]);
            $this->newTodo = '';
        }
    }

    #[On('toggle-todo')]
    public function toggleTodo($todoId)
    {
        foreach ($this->todos as &$todo) {
            if ($todo['id'] == $todoId) {
                $todo['completed'] = !$todo['completed'];
                break;
            }
        }
    }

    #[On('delete-todo')]
    public function deleteTodo($todoId)
    {
        $this->todos = array_values(array_filter($this->todos, function($todo) use ($todoId) {
            return $todo['id'] != $todoId;
        }));
    }

    #[On('move-up')]
    public function moveUp($todoId)
    {
        $index = array_search($todoId, array_column($this->todos, 'id'));
        if ($index > 0) {
            $temp = $this->todos[$index];
            $this->todos[$index] = $this->todos[$index - 1];
            $this->todos[$index - 1] = $temp;
        }
    }

    #[On('move-down')]
    public function moveDown($todoId)
    {
        $index = array_search($todoId, array_column($this->todos, 'id'));
        if ($index < count($this->todos) - 1) {
            $temp = $this->todos[$index];
            $this->todos[$index] = $this->todos[$index + 1];
            $this->todos[$index + 1] = $temp;
        }
    }

    public function render()
    {
        return view('livewire.partial-key-todo-list');
    }
}