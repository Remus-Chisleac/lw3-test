<div class="p-3 bg-white border border-gray-300 rounded-md">
    <div class="mb-3">
        <h5 class="text-sm font-semibold text-gray-700 mb-2">Child Component</h5>
        <div class="flex items-center justify-between mb-2">
            <span class="text-sm font-medium text-gray-600">Messages sent:</span>
            <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs font-semibold">
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
            class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500"
        >
    </div>
    
    <button 
        wire:click="sendMessage"
        class="w-full px-3 py-2 bg-green-500 text-white rounded-md hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500 disabled:bg-gray-300 disabled:cursor-not-allowed text-sm"
    >
        Send to Parent
    </button>
    
    <div class="mt-2 text-xs text-gray-400">
        Component ID: {{ $this->getId() }}
    </div>
</div>