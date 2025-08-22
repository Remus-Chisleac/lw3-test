<div class="flex items-center justify-between p-3 bg-gray-50 rounded-md border">
    <div class="flex items-center flex-1">
        <input
            type="checkbox"
            wire:click="toggleCompleted"
            {{ $todo['completed'] ? 'checked' : '' }}
            class="mr-3"
        >
        <span class="{{ $todo['completed'] ? 'line-through text-gray-500' : '' }}">
            {{ $todo['text'] }}
        </span>
        <input
            type="text"
            placeholder="Type something - state preserved with nested component!"
            class="ml-3 px-2 py-1 text-xs border border-gray-300 rounded w-48 bg-blue-50"
        >
    </div>

    <div class="flex items-center space-x-2">
        <!-- Priority selector nested inside another div -->
        <div class="bg-white rounded p-1 border">
            <select class="text-xs border-0 bg-transparent focus:ring-0">
                <option>Low</option>
                <option>Medium</option>
                <option>High</option>
            </select>
        </div>

        <!-- Action buttons in nested div -->
        <div class="flex space-x-1">
            <button
                wire:click="moveUp"
                class="px-2 py-1 bg-gray-200 rounded text-xs hover:bg-gray-300"
            >
                ↑
            </button>
            <button
                wire:click="moveDown"
                class="px-2 py-1 bg-gray-200 rounded text-xs hover:bg-gray-300"
            >
                ↓
            </button>
            <button
                wire:click="deleteTodo"
                class="px-2 py-1 bg-red-500 text-white rounded text-xs hover:bg-red-600"
            >
                Delete
            </button>
        </div>
    </div>
</div>
