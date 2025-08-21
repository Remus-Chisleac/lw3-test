<?php

namespace App\Livewire;

use Livewire\Component;

class TodoListWithKey extends Component
{
    public $todos = [];
    public $newTodo = '';

    public function mount()
    {
        $this->todos = [
            ['id' => 1, 'text' => 'Learn Laravel', 'completed' => false],
            ['id' => 2, 'text' => 'Master Livewire', 'completed' => true],
            ['id' => 3, 'text' => 'Build awesome apps', 'completed' => false],
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
        $this->dispatch('todos-updated');
    }

    public function toggleTodo($todoId)
    {
        foreach ($this->todos as &$todo) {
            if ($todo['id'] == $todoId) {
                $todo['completed'] = !$todo['completed'];
                break;
            }
        }
        $this->dispatch('todos-updated');
    }

    public function deleteTodo($todoId)
    {
        $this->todos = array_values(array_filter($this->todos, function($todo) use ($todoId) {
            return $todo['id'] != $todoId;
        }));
        $this->dispatch('todos-updated');
    }

    public function moveUp($todoId)
    {
        $index = array_search($todoId, array_column($this->todos, 'id'));
        if ($index > 0) {
            $temp = $this->todos[$index];
            $this->todos[$index] = $this->todos[$index - 1];
            $this->todos[$index - 1] = $temp;
        }
        $this->dispatch('todos-updated');
    }

    public function moveDown($todoId)
    {
        $index = array_search($todoId, array_column($this->todos, 'id'));
        if ($index < count($this->todos) - 1) {
            $temp = $this->todos[$index];
            $this->todos[$index] = $this->todos[$index + 1];
            $this->todos[$index + 1] = $temp;
        }
        $this->dispatch('todos-updated');
    }

    public function render()
    {
        return view('livewire.todo-list-with-key');
    }
}