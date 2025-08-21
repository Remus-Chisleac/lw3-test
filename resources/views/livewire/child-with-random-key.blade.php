<div class="p-3 bg-white border border-gray-300 rounded-md"
    wire:key="{{ rand() }}">
    <div class="mb-3">
        <h5 class="text-sm font-semibold text-gray-700 mb-2">Child Component</h5>
        <div class="flex items-center justify-between mb-2">
            <span class="text-sm font-medium text-gray-600">Messages sent:</span>
            <span class="px-2 py-1 bg-red-100 text-red-800 rounded-full text-xs font-semibold">
                {{ $messageCount }}
            </span>
        </div>
    </div>

    <div class="mb-3">
        <input
            type="text"
            wire:model="inputText"
            wire:keydown.enter="sendMessage"
            placeholder="Type a message to send to parent..."
            class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500"
        >
    </div>

    <button
        wire:click="sendMessage"
        class="w-full px-3 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 disabled:bg-gray-300 disabled:cursor-not-allowed text-sm"
    >
        Send to Parent
    </button>

    <div class="mt-2 text-xs text-gray-400">
        Component ID: {{ $this->getId() }}
    </div>
</div>
