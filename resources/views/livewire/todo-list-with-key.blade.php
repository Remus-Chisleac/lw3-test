<div class="max-w-7xl mx-auto mt-8 p-6 bg-white rounded-lg shadow-lg">
    <div class="mb-6 flex gap-2 flex-wrap">
        <a
            href="/todo-without-key"
            class="px-3 py-2 bg-red-500 hover:bg-red-600 text-white rounded text-sm font-semibold transition duration-200"
        >
            WITHOUT wire:key
        </a>
        <button class="px-3 py-2 bg-green-500 text-white rounded text-sm font-semibold">
            WITH wire:key (Current)
        </button>
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
        <a
            href="/todo-complex"
            class="px-3 py-2 bg-purple-500 hover:bg-purple-600 text-white rounded text-sm font-semibold transition duration-200"
        >
            NESTED COMPONENTS
        </a>
    </div>

    <h2 class="text-2xl font-bold mb-4 text-green-600">WITH wire:key (CORRECT)</h2>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Todo List Column -->
        <div class="lg:col-span-2">
            <div class="mb-4">
                <input
                    type="text"
                    wire:model="newTodo"
                    wire:keydown.enter="addTodo"
                    placeholder="Add new todo..."
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
                <button
                    wire:click="addTodo"
                    class="mt-2 w-full bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
                    Add Todo
                </button>
            </div>
            <div class="space-y-2">
                @foreach($todos as $index => $todo)
                    <div wire:key="todo-{{ $todo['id'] }}" class="flex items-center justify-between p-3 bg-gray-50 rounded-md border">
                        <div class="flex items-center flex-1">
                            <input
                                type="checkbox"
                                wire:click="toggleTodo({{ $todo['id'] }})"
                                {{ $todo['completed'] ? 'checked' : '' }}
                                class="mr-3"
                            >
                            <span class="{{ $todo['completed'] ? 'line-through text-gray-500' : '' }}">
                                {{ $todo['text'] }}
                            </span>
                            <input
                                type="text"
                                placeholder="Type something - state preserved!"
                                class="ml-3 px-2 py-1 text-xs border border-gray-300 rounded w-40"
                            >
                        </div>
                        <div class="flex space-x-1">
                            <button
                                wire:click="moveUp({{ $todo['id'] }})"
                                class="px-2 py-1 bg-gray-200 rounded text-xs hover:bg-gray-300"
                                {{ $index === 0 ? 'disabled' : '' }}
                            >
                                ↑
                            </button>
                            <button
                                wire:click="moveDown({{ $todo['id'] }})"
                                class="px-2 py-1 bg-gray-200 rounded text-xs hover:bg-gray-300"
                                {{ $index === count($todos) - 1 ? 'disabled' : '' }}
                            >
                                ↓
                            </button>
                            <button
                                wire:click="deleteTodo({{ $todo['id'] }})"
                                class="px-2 py-1 bg-red-500 text-white rounded text-xs hover:bg-red-600"
                            >
                                Delete
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Test Instructions Sidebar -->
        <div class="lg:col-span-1">
            <div class="sticky top-4">
                <div class="p-4 bg-green-50 border border-green-200 rounded-md">
                    <h4 class="font-semibold text-green-800 text-lg mb-3">Test Instructions</h4>
                    <ol class="text-sm text-green-700 space-y-2">
                        <li class="flex items-start">
                            <span class="flex-shrink-0 w-5 h-5 bg-green-200 text-green-800 rounded-full text-xs flex items-center justify-center mr-2 mt-0.5">1</span>
                            <span>Type different text in each input field</span>
                        </li>
                        <li class="flex items-start">
                            <span class="flex-shrink-0 w-5 h-5 bg-green-200 text-green-800 rounded-full text-xs flex items-center justify-center mr-2 mt-0.5">2</span>
                            <span>Use the ↑/↓ buttons to reorder items</span>
                        </li>
                        <li class="flex items-start">
                            <span class="flex-shrink-0 w-5 h-5 bg-green-200 text-green-800 rounded-full text-xs flex items-center justify-center mr-2 mt-0.5">3</span>
                            <span>Notice the input values move with their todo items!</span>
                        </li>
                        <li class="flex items-start">
                            <span class="flex-shrink-0 w-5 h-5 bg-green-200 text-green-800 rounded-full text-xs flex items-center justify-center mr-2 mt-0.5">4</span>
                            <span>Delete an item and see how the state is preserved correctly</span>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div wire:ignore class="mt-6 p-4 bg-gray-50 border border-gray-200 rounded-md">
        <h4 class="font-semibold text-gray-800 mb-3">Code Structure:</h4>

        <div class="mb-4">
            <h5 class="font-medium text-gray-700 mb-2">PHP Component:</h5>
            <pre class="text-sm bg-gray-900 text-gray-100 p-4 rounded border overflow-x-auto"><code class="language-php">class TodoListWithKey extends Component
{
    public $todos = [];

    public function moveUp($todoId) { /* reorder logic */ }
    public function moveDown($todoId) { /* reorder logic */ }
    public function deleteTodo($todoId) { /* delete logic */ }
}</code></pre>
        </div>

        <div>
            <h5 class="font-medium text-gray-700 mb-2">Blade Template:</h5>
<pre class="text-sm bg-gray-900 text-gray-100 p-4 rounded border overflow-x-auto"><code class="language-php">&#64;foreach($todos as $index => $todo)
    &lt;div wire:key="todo-&#123;&#123; $todo['id'] &#125;&#125;" class="flex items-center justify-between p-3 bg-gray-50 rounded-md border"&gt;
        &lt;div class="flex items-center flex-1"&gt;
            &lt;input
                type="checkbox"
                wire:click="toggleTodo(&#123;&#123; $todo['id'] &#125;&#125;)"
                &#123;&#123; $todo['completed'] ? 'checked' : '' &#125;&#125;
                class="mr-3"
            &gt;
            &lt;span class="&#123;&#123; $todo['completed'] ? 'line-through text-gray-500' : '' &#125;&#125;"&gt;
                &#123;&#123; $todo['text'] &#125;&#125;
            &lt;/span&gt;
            &lt;input
                type="text"
                placeholder="Type something - state preserved!"
                class="ml-3 px-2 py-1 text-xs border border-gray-300 rounded w-40"
            &gt;
        &lt;/div&gt;
        &lt;div class="flex space-x-1"&gt;
            &lt;button wire:click="moveUp(&#123;&#123; $todo['id'] &#125;&#125;)"&gt;↑&lt;/button&gt;
            &lt;button wire:click="moveDown(&#123;&#123; $todo['id'] &#125;&#125;)"&gt;↓&lt;/button&gt;
            &lt;button wire:click="deleteTodo(&#123;&#123; $todo['id'] &#125;&#125;)"&gt;Delete&lt;/button&gt;
        &lt;/div&gt;
    &lt;/div&gt;
&#64;endforeach</code></pre>
            <p class="text-sm text-green-600 mt-2 font-medium">CORRECT: Stable wire:key="todo-&#123;&#123; $todo['id'] &#125;&#125;" using the todo ID!</p>
        </div>
    </div>
</div>
