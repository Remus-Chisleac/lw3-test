<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\TodoListWithoutKey;
use App\Livewire\TodoListWithKey;
use App\Livewire\TodoListWithRandomKey;
use App\Livewire\ComplexTodoList;
use App\Livewire\PartialKeyTodoList;
use App\Livewire\ParentWithChildRandomKey;
use App\Livewire\ParentWithChildWithoutKey;
use App\Livewire\RefreshWithIgnore;
use App\Livewire\RefreshWithoutIgnore;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/todo-without-key', TodoListWithoutKey::class);
Route::get('/todo-with-key', TodoListWithKey::class);
Route::get('/todo-with-random-key', TodoListWithRandomKey::class);
Route::get('/todo-complex', ComplexTodoList::class);
Route::get('/todo-partial-key', PartialKeyTodoList::class);

Route::get('/parent-child-random-key', ParentWithChildRandomKey::class);
Route::get('/parent-child-without-key', ParentWithChildWithoutKey::class);

Route::get('/refresh-with-ignore', RefreshWithIgnore::class);
Route::get('/refresh-without-ignore', RefreshWithoutIgnore::class);
