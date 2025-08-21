<div class="max-w-4xl mx-auto mt-8 p-6 bg-white rounded-lg shadow-lg">
    <div class="mb-6 flex gap-2 flex-wrap">
        <a 
            href="/refresh-with-ignore" 
            class="px-3 py-2 bg-purple-500 hover:bg-purple-600 text-white rounded text-sm font-semibold transition duration-200"
        >
            WITH wire:ignore.self
        </a>
        <button class="px-3 py-2 bg-cyan-500 text-white rounded text-sm font-semibold">
            WITHOUT wire:ignore (Current)
        </button>
    </div>
    
    <h2 class="text-2xl font-bold mb-4 text-cyan-600">WITHOUT wire:ignore (SELF-UPDATING)</h2>
    
    <div class="mb-6">
        <h3 class="text-lg font-semibold mb-3">Select User:</h3>
        <div class="flex gap-2 flex-wrap">
            @foreach($users as $user)
                <button 
                    wire:click="switchUser({{ $user['id'] }})"
                    class="px-4 py-2 rounded {{ $selectedUser == $user['id'] ? 'bg-cyan-500 text-white' : 'bg-gray-200 hover:bg-gray-300' }}"
                >
                    {{ $user['name'] }}
                </button>
            @endforeach
        </div>
    </div>

    <!-- User Form Component without wire:ignore -->
    <div class="p-6 bg-gray-50 rounded-lg border">
        <h4 class="text-lg font-semibold mb-4 text-gray-700">User Form (auto-updating)</h4>
        
        <div class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Name:</label>
                <input 
                    type="text" 
                    value="{{ $this->getCurrentUser()['name'] }}"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-cyan-500"
                    placeholder="Edit this field to test state preservation"
                >
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Email:</label>
                <input 
                    type="email" 
                    value="{{ $this->getCurrentUser()['email'] }}"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-cyan-500"
                    placeholder="Edit this field to test state preservation"
                >
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Notes:</label>
                <textarea 
                    rows="3"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-cyan-500"
                    placeholder="Type something here to test state preservation"
                ></textarea>
            </div>
            
            <p class="text-sm text-gray-600">
                Current User ID: <span class="font-semibold">{{ $selectedUser }}</span>
            </p>
        </div>
    </div>

    <div class="mt-6 p-4 bg-cyan-50 border border-cyan-200 rounded-md">
        <h4 class="font-semibold text-cyan-800">Test Instructions:</h4>
        <ol class="text-sm text-cyan-700 mt-2 space-y-1">
            <li>1. Type something in the input fields and textarea</li>
            <li>2. Switch between different users using the buttons above</li>
            <li>3. Notice how input values update automatically with new user data</li>
            <li>4. Your typed text gets replaced because component updates normally</li>
        </ol>
    </div>

    <div class="mt-6 p-4 bg-gray-50 border border-gray-200 rounded-md max-w-4xl">
        <h4 class="font-semibold text-gray-800 mb-3">Code Structure:</h4>
        
        <div class="mb-4">
            <h5 class="font-medium text-gray-700 mb-2">PHP Component (RefreshWithoutIgnore.php):</h5>
            <pre class="text-sm text-gray-600 bg-white p-4 rounded border overflow-x-auto"><code>class RefreshWithoutIgnore extends Component
{
    public $selectedUser = 1;
    
    public function switchUser($userId) {
        $this->selectedUser = $userId;
        // No refresh key needed - component updates automatically
    }
}</code></pre>
        </div>

        <div>
            <h5 class="font-medium text-gray-700 mb-2">Blade Template:</h5>
            <pre class="text-sm text-gray-600 bg-white p-4 rounded border overflow-x-auto"><code>&lt;div class="p-6 bg-gray-50 rounded-lg border"&gt;
    &lt;input type="text" value="&#123;&#123; $this-&gt;getCurrentUser()['name'] &#125;&#125;"&gt;
    &lt;input type="email" value="&#123;&#123; $this-&gt;getCurrentUser()['email'] &#125;&#125;"&gt;
    &lt;textarea placeholder="Type something here"&gt;&lt;/textarea&gt;
&lt;/div&gt;</code></pre>
            <p class="text-sm text-cyan-600 mt-2 font-medium">SELF-UPDATING: No wire:ignore means component updates automatically when data changes</p>
        </div>
    </div>
</div>