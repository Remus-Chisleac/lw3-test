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
        <a
            href="/todo-partial-key"
            class="px-3 py-2 bg-yellow-500 hover:bg-yellow-600 text-white rounded text-sm font-semibold transition duration-200"
        >
            PARTIAL KEY
        </a>
        <button class="px-3 py-2 bg-purple-500 text-white rounded text-sm font-semibold">
            NESTED COMPONENTS (Current)
        </button>
    </div>

    <h2 class="text-2xl font-bold mb-4 text-purple-600">NESTED COMPONENTS (wire:key on root div and component)</h2>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Todo List Column -->
        <div class="lg:col-span-2">
            <div class="mb-4">
                <input
                    type="text"
                    wire:model="newTodo"
                    wire:keydown.enter="addTodo"
                    placeholder="Add new todo..."
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500"
                >
                <button
                    wire:click="addTodo"
                    class="mt-2 w-full bg-purple-500 text-white px-4 py-2 rounded-md hover:bg-purple-600 focus:outline-none focus:ring-2 focus:ring-purple-500"
                >
                    Add Todo
                </button>
            </div>

            <div class="space-y-2">
                @foreach($todos as $index => $todo)
                    <!-- Root container div WITH wire:key - CORRECT -->
                    <div  wire:key="todo-item-{{ $todo['id'] }}" class="bg-gradient-to-r from-purple-50 to-blue-50 p-2 rounded-lg border-2 border-purple-200">
                        <!-- Inner wrapper div without wire:key -->
                        <div class="bg-white rounded border border-gray-200 p-1">
                            <!-- Nested Livewire component with wire:key -->
                            <livewire:todo-item
                                :todo="$todo"
                                :index="$index"
                                :totalCount="count($todos)"
                                wire:key="todo-item-{{ $todo['id'] }}"
                            />
                        </div>

                        <!-- Additional nested div without wire:key for comparison -->
                        <div class="mt-2 px-2 py-1 bg-purple-50 rounded text-xs text-purple-600">
                            <span class="font-medium">ID: {{ $todo['id'] }}</span> |
                            <span>Position: {{ $index + 1 }}</span> |
                            <span>Status: {{ $todo['completed'] ? 'Completed' : 'Pending' }}</span>
                            <!-- Input field within nested structure -->
                            <input
                                type="text"
                                placeholder="State preserved - root div has wire:key!"
                                class="ml-2 px-1 py-0.5 text-xs border border-purple-300 rounded w-40 bg-white"
                            >
                        </div>

                        <!-- Another div for demonstration -->
                        <div class="mt-1 px-2 py-1 bg-blue-50 rounded text-xs">
                            <span class="text-blue-600">Extra content in div</span>
                            <input
                                type="checkbox"
                                class="ml-2"
                            >
                            <label class="ml-1 text-blue-600">Check me - state preserved!</label>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Test Instructions Sidebar -->
        <div class="lg:col-span-1">
            <div class="sticky top-4">
                <div class="p-4 bg-purple-50 border border-purple-200 rounded-md">
                    <h4 class="font-semibold text-purple-800 text-lg mb-3">Nested Components Test</h4>
                    <ol class="text-sm text-purple-700 space-y-2">
                        <li class="flex items-start">
                            <span class="flex-shrink-0 w-5 h-5 bg-purple-200 text-purple-800 rounded-full text-xs flex items-center justify-center mr-2 mt-0.5">1</span>
                            <span>Type in ALL input fields (component and div inputs)</span>
                        </li>
                        <li class="flex items-start">
                            <span class="flex-shrink-0 w-5 h-5 bg-purple-200 text-purple-800 rounded-full text-xs flex items-center justify-center mr-2 mt-0.5">2</span>
                            <span>Check the checkboxes in the blue sections</span>
                        </li>
                        <li class="flex items-start">
                            <span class="flex-shrink-0 w-5 h-5 bg-purple-200 text-purple-800 rounded-full text-xs flex items-center justify-center mr-2 mt-0.5">3</span>
                            <span>Use ↑/↓ buttons to reorder items</span>
                        </li>
                        <li class="flex items-start">
                            <span class="flex-shrink-0 w-5 h-5 bg-purple-200 text-purple-800 rounded-full text-xs flex items-center justify-center mr-2 mt-0.5">4</span>
                            <span>Notice: ALL inputs move correctly with their items!</span>
                        </li>
                        <li class="flex items-start">
                            <span class="flex-shrink-0 w-5 h-5 bg-purple-200 text-purple-800 rounded-full text-xs flex items-center justify-center mr-2 mt-0.5">5</span>
                            <span>Notice: Checkboxes maintain their state!</span>
                        </li>
                        <li class="flex items-start">
                            <span class="flex-shrink-0 w-5 h-5 bg-purple-200 text-purple-800 rounded-full text-xs flex items-center justify-center mr-2 mt-0.5">6</span>
                            <span>Delete items - all state preserved correctly</span>
                        </li>
                    </ol>

                    <div class="mt-4 p-3 bg-green-50 border border-green-200 rounded">
                        <h5 class="text-sm font-semibold text-green-800 mb-1">Key Point:</h5>
                        <p class="text-xs text-green-700">Root div has wire:key, so ALL nested DOM elements preserve their state correctly during reordering!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div wire:ignore class="mt-6 p-4 bg-gray-50 border border-gray-200 rounded-md">
        <h4 class="font-semibold text-gray-800 mb-3">Nested Components Code Structure:</h4>

        <div class="mb-4">
            <h5 class="font-medium text-gray-700 mb-2">Parent Component (ComplexTodoList):</h5>
            <pre class="text-sm bg-gray-900 text-gray-100 p-4 rounded border overflow-x-auto"><code class="language-php">class ComplexTodoList extends Component
{
    public $todos = [];

    #[On('toggle-todo')]
    public function toggleTodo($todoId) { /* handles child events */ }

    #[On('move-up')]
    public function moveUp($todoId) { /* reorder logic */ }
}</code></pre>
        </div>

        <div class="mb-4">
            <h5 class="font-medium text-gray-700 mb-2">Child Component (TodoItem):</h5>
            <pre class="text-sm bg-gray-900 text-gray-100 p-4 rounded border overflow-x-auto"><code class="language-php">class TodoItem extends Component
{
    public $todo, $index, $totalCount;

    public function toggleCompleted() {
        $this->dispatch('toggle-todo', $this->todo['id']);
    }
}</code></pre>
        </div>

        <div>
            <h5 class="font-medium text-gray-700 mb-2">Template with wire:key on Root Div and Component:</h5>
<pre class="text-sm bg-gray-900 text-gray-100 p-4 rounded border overflow-x-auto"><code class="language-php">&#64;foreach($todos as $index => $todo)
    &lt;!-- Root container div WITH wire:key --&gt;
    &lt;div wire:key="todo-item-&#123;&#123; $todo['id'] &#125;&#125;" class="bg-gradient-to-r from-purple-50 to-blue-50 p-2 rounded-lg"&gt;
        &lt;!-- Inner wrapper div without wire:key --&gt;
        &lt;div class="bg-white rounded border p-1"&gt;
            &lt;!-- Nested Livewire component with wire:key --&gt;
            &lt;livewire:todo-item
                :todo="$todo"
                :index="$index"
                :totalCount="count($todos)"
                wire:key="todo-item-&#123;&#123; $todo['id'] &#125;&#125;"
            /&gt;
        &lt;/div&gt;

        &lt;!-- Additional nested div without wire:key --&gt;
        &lt;div class="mt-2 px-2 py-1 bg-purple-50"&gt;
            &lt;span&gt;ID: &#123;&#123; $todo['id'] &#125;&#125;&lt;/span&gt; |
            &lt;input type="text" placeholder="State preserved!" class="ml-2" /&gt;
        &lt;/div&gt;

        &lt;!-- Another div without wire:key --&gt;
        &lt;div class="mt-1 px-2 py-1 bg-blue-50"&gt;
            &lt;input type="checkbox" /&gt;
            &lt;label&gt;Check me - state preserved!&lt;/label&gt;
        &lt;/div&gt;
    &lt;/div&gt;
&#64;endforeach</code></pre>
            <div class="mt-3 space-y-2">
                <p class="text-sm text-green-600 font-medium">CORRECT: Root div has wire:key with stable todo ID</p>
                <p class="text-sm text-green-600 font-medium">CORRECT: Livewire component has wire:key with stable todo ID</p>
                <p class="text-sm text-green-600 font-medium">CORRECT: All nested divs inherit proper DOM tracking from root div</p>
            </div>
        </div>
    </div>
</div>
