<div class="max-w-7xl mx-auto mt-8 p-6 bg-white rounded-lg shadow-lg">
    <div class="mb-6 flex gap-2 flex-wrap">
        <button class="px-3 py-2 bg-red-500 text-white rounded text-sm font-semibold">
            CHILD with RANDOM key (Current)
        </button>
        <a
            href="/parent-child-without-key"
            class="px-3 py-2 bg-green-500 hover:bg-green-600 text-white rounded text-sm font-semibold transition duration-200"
        >
            CHILD without key
        </a>
    </div>

    <h2 class="text-2xl font-bold mb-4 text-red-600">Child-to-Parent with Random wire:key</h2>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Parent and Child Components ---->
        <div class="lg:col-span-2">
            <!-- Parent Component -->
            <div class="mb-6 p-6 bg-blue-50 border border-blue-200 rounded-lg">
                <h3 class="text-lg font-semibold text-blue-800 mb-4">Parent Component</h3>

                <div class="mb-4">
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-sm font-medium text-gray-600">Messages received from child:</span>
                        <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded-full text-xs font-semibold">
                            {{ $messageCount }}
                        </span>
                    </div>

                    <div class="max-h-40 overflow-y-auto space-y-2">
                        @forelse($receivedMessages as $msg)
                            <div class="p-2 bg-blue-100 rounded-md text-blue-700 text-sm">
                                <strong>{{ $msg['time'] }}</strong>: {{ $msg['message'] }}
                                <br><small class="text-blue-500">From: {{ $msg['from'] }}</small>
                            </div>
                        @empty
                            <div class="p-2 bg-gray-100 text-gray-500 rounded-md text-sm italic">
                                Waiting for child messages...
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Child Component with Random Key -->
            <div class="p-4 bg-red-50 border border-red-200 rounded-lg">
                <h4 class="text-md font-semibold text-red-700 mb-3">Child Component (Random Key)</h4>
                <livewire:child-with-random-key />
            </div>
        </div>

        <!-- Test Instructions Sidebar -->
        <div class="lg:col-span-1">
            <div class="sticky top-4">
                <div class="p-4 bg-red-50 border border-red-200 rounded-md">
                    <h4 class="font-semibold text-red-800 text-lg mb-3">Test Instructions</h4>
                    <ol class="text-sm text-red-700 space-y-2">
                        <li class="flex items-start">
                            <span class="flex-shrink-0 w-5 h-5 bg-red-200 text-red-800 rounded-full text-xs flex items-center justify-center mr-2 mt-0.5">1</span>
                            <span>Open the browser console (F12)</span>
                        </li>
                        <li class="flex items-start">
                            <span class="flex-shrink-0 w-5 h-5 bg-red-200 text-red-800 rounded-full text-xs flex items-center justify-center mr-2 mt-0.5">2</span>
                            <span>Type a message in the child component input field</span>
                        </li>
                        <li class="flex items-start">
                            <span class="flex-shrink-0 w-5 h-5 bg-red-200 text-red-800 rounded-full text-xs flex items-center justify-center mr-2 mt-0.5">3</span>
                            <span>Click "Send to Parent" button</span>
                        </li>
                        <li class="flex items-start">
                            <span class="flex-shrink-0 w-5 h-5 bg-red-200 text-red-800 rounded-full text-xs flex items-center justify-center mr-2 mt-0.5">4</span>
                            <span>Check the error message in the console</span>
                        </li>
                    </ol>

                    <div class="mt-4 p-3 bg-orange-50 border border-orange-200 rounded-md">
                        <h5 class="text-sm font-semibold text-orange-800 mb-2">What's Happening:</h5>
                        <p class="text-xs text-orange-700 leading-relaxed">
                            When you click "Send to Parent", the button triggers <code>wire:click="sendMessage"</code>.
                            However, the random <code>wire:key="{{ rand() }}"</code> causes the child component to get a new ID.
                            Livewire then tries to find the old component ID to execute the click handler, but it no longer exists,
                            resulting in a "Component not found" error in the console.
                            The component is not stuck displaying the old state and is no longer usable unless the page is refreshed.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div wire:ignore class="mt-6 p-4 bg-gray-50 border border-gray-200 rounded-md">
        <h4 class="font-semibold text-gray-800 mb-3">Code Structure:</h4>

        <div class="mb-4">
            <h5 class="font-medium text-gray-700 mb-2">Parent Component:</h5>
            <pre class="text-sm bg-gray-900 text-gray-100 p-4 rounded border overflow-x-auto"><code class="language-php">class Parent extends Component
{
    public $receivedMessages = [];
    public $messageCount = 0;

    #[On('child-message')]
    public function handleChildMessage($message, $from, $time)
    {
        $this->messageCount++;
        array_unshift($this->receivedMessages, [
            'message' => $message,
            'from' => $from,
            'time' => $time
        ]);
    }
}</code></pre>
        </div>

        <div class="mb-4">
            <h5 class="font-medium text-gray-700 mb-2">Child Component:</h5>
            <pre class="text-sm bg-gray-900 text-gray-100 p-4 rounded border overflow-x-auto"><code class="language-php">class ChildWithRandomKey extends Component
{
    public $inputText = '';
    public $messageCount = 0;

    public function sendMessage()
    {
        if (trim($this->inputText)) {
            $this->messageCount++;
            $this->dispatch('child-message', [
                'message' => $this->inputText,
                'from' => $this->getId(),
                'time' => now()->format('H:i:s')
            ]);
            $this->inputText = '';
        }
    }
}</code></pre>
        </div>

        <div>
            <h5 class="font-medium text-gray-700 mb-2">Blade Template:</h5>
<pre class="text-sm bg-gray-900 text-gray-100 p-4 rounded border overflow-x-auto"><code class="language-php">&lt;!-- Child Component Template --&gt;
&lt;div wire:key="&#123;&#123; rand() &#125;&#125;"&gt;
    &lt;input type="text" wire:model="inputText" placeholder="Type message..."&gt;
    &lt;button wire:click="sendMessage"&gt;Send to Parent&lt;/button&gt;
    &lt;span&gt;Messages sent: &#123;&#123; $messageCount &#125;&#125;&lt;/span&gt;
&lt;/div&gt;

&lt;!-- Parent includes child --&gt;
&lt;livewire:child-with-random-key /&gt;</code></pre>
            <p class="text-sm text-red-600 mt-2 font-medium">BROKEN: Random wire:key causes child components to re-initialize on every parent update!</p>
        </div>
    </div>
</div>
