<div class="max-w-4xl mx-auto mt-8 p-6 bg-white rounded-lg shadow-lg">
    <div class="mb-6 flex gap-2 flex-wrap">
        <button class="px-3 py-2 bg-purple-500 text-white rounded text-sm font-semibold">
            WITH wire:ignore.self (Current)
        </button>
        <a 
            href="/refresh-without-ignore" 
            class="px-3 py-2 bg-cyan-500 hover:bg-cyan-600 text-white rounded text-sm font-semibold transition duration-200"
        >
            WITHOUT wire:ignore
        </a>
    </div>
    
    <h2 class="text-2xl font-bold mb-4 text-purple-600">WITH wire:ignore.self (NEEDS REFRESH TRIGGER)</h2>
    
    <div class="mb-6">
        <h3 class="text-lg font-semibold mb-3">Select User:</h3>
        <div class="flex gap-2 flex-wrap">
            @foreach($users as $user)
                <button 
                    wire:click="switchUser({{ $user['id'] }})"
                    class="px-4 py-2 rounded {{ $selectedUser == $user['id'] ? 'bg-purple-500 text-white' : 'bg-gray-200 hover:bg-gray-300' }}"
                >
                    {{ $user['name'] }}
                </button>
            @endforeach
        </div>
    </div>

    <!-- User Form Component with wire:ignore.self and wire:key -->
    <div 
        wire:key="user-form-{{ $selectedUser }}" 
        wire:ignore.self 
        class="p-6 bg-gray-50 rounded-lg border"
    >
        <h4 class="text-lg font-semibold mb-4 text-gray-700">User Form (wire:ignore.self)</h4>
        
        <div class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Name:</label>
                <input 
                    type="text" 
                    value="{{ $this->getCurrentUser()['name'] }}"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500"
                    placeholder="Edit this field to test state preservation"
                >
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Email:</label>
                <input 
                    type="email" 
                    value="{{ $this->getCurrentUser()['email'] }}"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500"
                    placeholder="Edit this field to test state preservation"
                >
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Notes:</label>
                <textarea 
                    rows="3"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500"
                    placeholder="Type something here to test state preservation"
                ></textarea>
            </div>
            
            <p class="text-sm text-gray-600">
                Current User ID: <span class="font-semibold">{{ $selectedUser }}</span>
            </p>
        </div>
    </div>

    <div class="mt-6 p-4 bg-purple-50 border border-purple-200 rounded-md">
        <h4 class="font-semibold text-purple-800">Test Instructions:</h4>
        <ol class="text-sm text-purple-700 mt-2 space-y-1">
            <li>1. Type something in the input fields and textarea</li>
            <li>2. Switch between different users using the buttons above</li>
            <li>3. Notice how the form resets because wire:key (user ID) changes, forcing re-initialization</li>
            <li>4. The component ignores self updates but refreshes when wire:key changes</li>
        </ol>
    </div>

    <div class="mt-6 p-4 bg-gray-50 border border-gray-200 rounded-md max-w-4xl">
        <h4 class="font-semibold text-gray-800 mb-3">Code Structure:</h4>
        
        <div class="mb-4">
            <h5 class="font-medium text-gray-700 mb-2">PHP Component (RefreshWithIgnore.php):</h5>
            <pre class="text-sm text-gray-600 bg-white p-4 rounded border overflow-x-auto"><code>class RefreshWithIgnore extends Component
{
    public $selectedUser = 1;
    
    public function switchUser($userId) {
        $this->selectedUser = $userId;
        // User ID itself triggers re-initialization via wire:key
    }
}</code></pre>
        </div>

        <div>
            <h5 class="font-medium text-gray-700 mb-2">Blade Template:</h5>
            <pre class="text-sm text-gray-600 bg-white p-4 rounded border overflow-x-auto"><code>&lt;div 
    wire:key="user-form-&#123;&#123; $selectedUser &#125;&#125;" 
    wire:ignore.self 
    class="p-6 bg-gray-50 rounded-lg border"
&gt;
    &lt;input type="text" value="&#123;&#123; $this-&gt;getCurrentUser()['name'] &#125;&#125;"&gt;
    &lt;input type="email" value="&#123;&#123; $this-&gt;getCurrentUser()['email'] &#125;&#125;"&gt;
    &lt;textarea placeholder="Type something here"&gt;&lt;/textarea&gt;
&lt;/div&gt;</code></pre>
            <p class="text-sm text-purple-600 mt-2 font-medium">NEEDS TRIGGER: wire:key uses $selectedUser to force refresh since wire:ignore.self prevents updates</p>
        </div>
    </div>
</div>