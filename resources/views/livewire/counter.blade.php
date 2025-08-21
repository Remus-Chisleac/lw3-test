<div>
    <button
        wire:key="{{rand()}}"
        x-on:click="$wire.dispatch('increment')"
        class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-lg shadow-md hover:shadow-lg transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 active:scale-95">
        Increment {{$count}}
    </button>
</div>
