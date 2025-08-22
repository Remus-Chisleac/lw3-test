<div class="max-w-7xl mx-auto mt-8 p-6 bg-white rounded-lg shadow-lg">
    <div class="mb-6 flex gap-2 flex-wrap">
        <a
            href="/todo-without-key"
            class="px-3 py-2 bg-red-500 hover:bg-red-600 text-white rounded text-sm font-semibold transition duration-200"
        >
            WITHOUT wire:key
        </a>
        <a
            href="/todo-with-key"
            class="px-3 py-2 bg-green-500 hover:bg-green-600 text-white rounded text-sm font-semibold transition duration-200"
        >
            WITH wire:key
        </a>
        <a
            href="/todo-with-random-key"
            class="px-3 py-2 bg-orange-500 hover:bg-orange-600 text-white rounded text-sm font-semibold transition duration-200"
        >
            RANDOM wire:key
        </a>
        <button class="px-3 py-2 bg-yellow-500 text-white rounded text-sm font-semibold">
            PARTIAL KEY (Current)
        </button>
        <a
            href="/todo-complex"
            class="px-3 py-2 bg-purple-500 hover:bg-purple-600 text-white rounded text-sm font-semibold transition duration-200"
        >
            NESTED COMPONENTS
        </a>
    </div>

    <h2 class="text-2xl font-bold mb-4 text-yellow-600">PARTIAL wire:key (MIXED BEHAVIOR - Component Only)</h2>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Todo List Column -->
        <div class="lg:col-span-2">
            <div class="mb-4">
                <input
                    type="text"
                    wire:model="newTodo"
                    wire:keydown.enter="addTodo"
                    placeholder="Add new todo..."
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500"
                >
                <button
                    wire:click="addTodo"
                    class="mt-2 w-full bg-yellow-500 text-white px-4 py-2 rounded-md hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500"
                >
                    Add Todo
                </button>
            </div>

            <div class="space-y-2">
                @foreach($todos as $index => $todo)
                    <div class="bg-gradient-to-r from-yellow-50 to-orange-50 p-2 rounded-lg border-2 border-yellow-200">
                        <div class="bg-white rounded border border-gray-200 p-1">
                            <livewire:todo-item
                                :todo="$todo"
                                :index="$index"
                                :totalCount="count($todos)"
                                wire:key="todo-item-{{ $todo['id'] }}"
                            />
                        </div>

                        <div class="mt-2 px-2 py-1 bg-yellow-50 rounded text-xs text-yellow-600">
                            <span class="font-medium">ID: {{ $todo['id'] }}</span> |
                            <span>Position: {{ $index + 1 }}</span> |
                            <span>Status: {{ $todo['completed'] ? 'Completed' : 'Pending' }}</span>
                            <input
                                type="text"
                                placeholder="This input will lose state when reordering!"
                                class="ml-2 px-1 py-0.5 text-xs border border-yellow-400 rounded w-40 bg-red-50"
                            >
                        </div>

                        <div class="mt-1 px-2 py-1 bg-orange-50 rounded text-xs">
                            <span class="text-orange-600">Extra content in div</span>
                            <input
                                type="checkbox"
                                class="ml-2"
                            >
                            <label class="ml-1 text-orange-600">Check me</label>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Test Instructions Sidebar -->
        <div class="lg:col-span-1">
            <div class="sticky top-4">
                <div class="p-4 bg-yellow-50 border border-yellow-200 rounded-md">
                    <h4 class="font-semibold text-yellow-800 text-lg mb-3">Test Instructions</h4>
                    <ol class="text-sm text-yellow-700 space-y-2">
                        <li class="flex items-start">
                            <span class="flex-shrink-0 w-5 h-5 bg-yellow-200 text-yellow-800 rounded-full text-xs flex items-center justify-center mr-2 mt-0.5">1</span>
                            <span>As long as the action only affects the component, Livewire will work normally</span>
                        </li>
                        <li class="flex items-start">
                            <span class="flex-shrink-0 w-5 h-5 bg-yellow-200 text-yellow-800 rounded-full text-xs flex items-center justify-center mr-2 mt-0.5">2</span>
                            <span>Check off one of the tasks</span>
                        </li>
                        <li class="flex items-start">
                            <span class="flex-shrink-0 w-5 h-5 bg-red-200 text-red-800 rounded-full text-xs flex items-center justify-center mr-2 mt-0.5">3</span>
                            <span>Open your browser's Developer Console (F12)</span>
                        </li>
                        <li class="flex items-start">
                            <span class="flex-shrink-0 w-5 h-5 bg-red-200 text-red-800 rounded-full text-xs flex items-center justify-center mr-2 mt-0.5">4</span>
                            <span>Use ↑/↓ buttons to reorder items</span>
                        </li>
                        <li class="flex items-start">
                            <span class="flex-shrink-0 w-5 h-5 bg-red-200 text-red-800 rounded-full text-xs flex items-center justify-center mr-2 mt-0.5">5</span>
                            <span>See console error! - "Snapshot missing on Livewire component with id: [ID]"</span>
                        </li>
                    </ol>

                    <div class="mt-4 p-3 bg-red-50 border border-red-200 rounded">
                        <h5 class="text-sm font-semibold text-red-800 mb-1">Critical Issue:</h5>
                        <p class="text-xs text-red-700">Without wire:key on the root div, Livewire components lose their connection to the backend. Button clicks fail with console errors, and the DOM state gets scrambled!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div wire:ignore class="mt-6 p-4 bg-gray-50 border border-gray-200 rounded-md">
        <h4 class="font-semibold text-gray-800 mb-3">Partial wire:key Code Structure:</h4>

        <div>
            <h5 class="font-medium text-gray-700 mb-2">Template with Mixed wire:key Usage:</h5>
<pre class="text-sm bg-gray-900 text-gray-100 p-4 rounded border overflow-x-auto"><code class="language-php">&#64;foreach($todos as $index => $todo)
    &lt;div class="bg-gradient-to-r from-yellow-50 to-orange-50 p-2 rounded-lg"&gt;
        &lt;div class="bg-white rounded border p-1"&gt;
            &lt;livewire:todo-item
                :todo="$todo"
                :index="$index"
                :totalCount="count($todos)"
                wire:key="todo-item-&#123;&#123; $todo['id'] &#125;&#125;"
            /&gt;
        &lt;/div&gt;

        &lt;div class="mt-2 px-2 py-1 bg-yellow-50"&gt;
            &lt;span&gt;ID: &#123;&#123; $todo['id'] &#125;&#125;&lt;/span&gt; |
            &lt;input
                type="text"
                placeholder="This input will lose state!"
                class="ml-2 border border-yellow-400"
            /&gt;
        &lt;/div&gt;

        &lt;div class="mt-1 px-2 py-1 bg-orange-50"&gt;
            &lt;input type="checkbox" class="ml-2" /&gt;
            &lt;label&gt;Check me - this state will be lost!&lt;/label&gt;
        &lt;/div&gt;
    &lt;/div&gt;
&#64;endforeach</code></pre>
            <div class="mt-3 space-y-2">
                <p class="text-sm text-orange-600 font-medium">INSUFFICIENT: Livewire component has wire:key but root div doesn't</p>
            </div>
        </div>

        <div class="mt-4 p-3 bg-red-50 border border-red-200 rounded">
            <h5 class="text-sm font-semibold text-red-800 mb-1">Key Takeaway:</h5>
            <p class="text-xs text-red-700">Having wire:key only on the Livewire component is NOT enough! Without wire:key on the root div of the @@foreach loop, Livewire completely breaks. The root div wire:key is absolutely essential.</p>
        </div>
    </div>
</div>
