<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>wire:key Demo</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
        <!-- Prism.js for syntax highlighting -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/themes/prism.min.css" rel="stylesheet" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/themes/prism-okaidia.min.css" rel="stylesheet" />
    </head>
    <body class="bg-gray-100 min-h-screen py-8">
        <div class="container mx-auto max-w-6xl px-4">
            <div class="bg-white rounded-lg shadow-lg p-8">
                <h1 class="text-4xl font-bold text-center mb-12 text-gray-800">Livewire wire:key</h1>

                <!-- wire:key explanation -->
                <div class="mb-8 p-6 bg-gray-50 border border-gray-200 rounded-lg">
                    <h3 class="text-xl font-semibold text-gray-700 mb-4">Understanding wire:key</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        <div class="p-4 bg-blue-50 border border-blue-200 rounded-lg">
                            <h4 class="text-md font-semibold text-blue-700 mb-2">Why</h4>
                            <p class="text-sm text-gray-600">It helps Livewire track DOM elements correctly during updates, preventing state mixups and improving performance.</p>
                        </div>

                        <div class="p-4 bg-blue-50 border border-blue-200 rounded-lg">
                            <h4 class="text-md font-semibold text-blue-700 mb-2">When</h4>
                            <p class="text-sm text-gray-600">Essential for places where the same livewire component is included multiple times, like @@foreach statements.</p>
                        </div>

                        <div class="p-4 bg-blue-50 border border-blue-200 rounded-lg">
                            <h4 class="text-md font-semibold text-blue-700 mb-2">Where</h4>
                            <p class="text-sm text-gray-600">Add to the root element inside loops, or any element that needs unique identification across renders.</p>
                        </div>

                        <div class="p-4 bg-blue-50 border border-blue-200 rounded-lg">
                            <h4 class="text-md font-semibold text-blue-700 mb-2">How</h4>
                            <p class="text-sm text-gray-600">Use wire:key="unique-identifier" with stable values like entity IDs. Ex: wire:key="todo-&#123;&#123;$todo['id']&#125;&#125;"</p>
                        </div>
                    </div>
                </div>

                <!-- @@foreach Examples Section -->
                <section class="mb-12">
                    <h2 class="text-2xl font-semibold text-gray-700 mb-6">@@foreach Examples</h2>

                    <p class="text-gray-600 mb-6">Click on each example to see live demo:</p>

                    <!-- Basic Examples Row -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                        <a
                            href="/todo-without-key"
                            class="block p-6 bg-red-50 hover:bg-red-100 hover:shadow-lg border border-red-200 rounded-lg transition duration-200 cursor-pointer transform hover:scale-105"
                        >
                            <h3 class="text-lg font-semibold text-red-700 mb-3">WITHOUT wire:key</h3>
                            <p class="text-sm text-red-600 mb-3 font-medium">BROKEN</p>
                            <p class="text-sm text-gray-600">DOM state gets mixed up when reordering items. Input values stick to wrong positions.</p>
                        </a>

                        <a
                            href="/todo-with-key"
                            class="block p-6 bg-green-50 hover:bg-green-100 hover:shadow-lg border border-green-200 rounded-lg transition duration-200 cursor-pointer transform hover:scale-105"
                        >
                            <h3 class="text-lg font-semibold text-green-700 mb-3">WITH wire:key</h3>
                            <p class="text-sm text-green-600 mb-3 font-medium">CORRECT</p>
                            <p class="text-sm text-gray-600">Stable keys using todo ID preserve DOM state correctly. Input values move with their items.</p>
                        </a>

                        <a
                            href="/todo-with-random-key"
                            class="block p-6 bg-orange-50 hover:bg-orange-100 hover:shadow-lg border border-orange-200 rounded-lg transition duration-200 cursor-pointer transform hover:scale-105"
                        >
                            <h3 class="text-lg font-semibold text-orange-700 mb-3">RANDOM wire:key</h3>
                            <p class="text-sm text-orange-600 mb-3 font-medium">WORST</p>
                            <p class="text-sm text-gray-600">Using rand() causes complete DOM regeneration. Every action scrambles input values.</p>
                        </a>
                    </div>

                    <!-- Advanced Examples Row -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <a
                            href="/todo-partial-key"
                            class="block p-6 bg-yellow-50 hover:bg-yellow-100 hover:shadow-lg border border-yellow-200 rounded-lg transition duration-200 cursor-pointer transform hover:scale-105"
                        >
                            <h3 class="text-lg font-semibold text-yellow-700 mb-3">NESTED COMPONENTS PARTIAL KEY</h3>
                            <p class="text-sm text-gray-600">wire:key only on Livewire component, divs without keys cause DOM state mixing.</p>
                        </a>

                        <a
                            href="/todo-complex"
                            class="block p-6 bg-purple-50 hover:bg-purple-100 hover:shadow-lg border border-purple-200 rounded-lg transition duration-200 cursor-pointer transform hover:scale-105"
                        >
                            <h3 class="text-lg font-semibold text-purple-700 mb-3">NESTED COMPONENTS</h3>
                            <p class="text-sm text-gray-600">wire:key on Livewire component and the root div.</p>
                        </a>
                    </div>
                </section>

                <!-- Child with Random Key Section -->
                <section class="mb-12">
                    <h2 class="text-2xl font-semibold text-gray-700 mb-6">Parent-Child Components with Random wire:key</h2>

                    <p class="text-gray-600 mb-6">Click on each example to see live demo:</p>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <a
                            href="/parent-child-random-key"
                            class="block p-6 bg-red-50 hover:bg-red-100 hover:shadow-lg border border-red-200 rounded-lg transition duration-200 cursor-pointer transform hover:scale-105"
                        >
                            <h3 class="text-lg font-semibold text-red-700 mb-3">Child with RANDOM wire:key</h3>
                            <p class="text-sm text-red-600 mb-3 font-medium">BROKEN COMMUNICATION</p>
                            <p class="text-sm text-gray-600">Child sends events to parent, but random keys cause component re-initialization and console errors on button clicks.</p>
                        </a>

                        <a
                            href="/parent-child-without-key"
                            class="block p-6 bg-green-50 hover:bg-green-100 hover:shadow-lg border border-green-200 rounded-lg transition duration-200 cursor-pointer transform hover:scale-105"
                        >
                            <h3 class="text-lg font-semibold text-green-700 mb-3">Child without wire:key</h3>
                            <p class="text-sm text-green-600 mb-3 font-medium">WORKING CORRECTLY</p>
                            <p class="text-sm text-gray-600">Livewire keeps track of the component. Child-to-parent communication works flawlessly with no console errors.</p>
                        </a>
                    </div>
                </section>

                <!-- Statistics Section -->
                <section class="mb-12">
                    <h2 class="text-2xl font-semibold text-gray-700 mb-6">Statistics from the aico repo</h2>

                    <div class="p-6 bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-200 rounded-lg">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div class="text-center p-4 bg-white rounded-lg shadow-sm">
                                <div class="text-3xl font-bold text-blue-600 mb-2">1,405</div>
                                <div class="text-sm text-gray-600">Total wire:key attributes</div>
                                <div class="text-xs text-gray-500 mt-1">Outside of @@foreach loops</div>
                            </div>

                            <div class="text-center p-4 bg-white rounded-lg shadow-sm">
                                <div class="text-3xl font-bold text-red-600 mb-2">920</div>
                                <div class="text-sm text-gray-600">Using randomly generated keys</div>
                                <div class="text-xs text-gray-500 mt-1">64.6% of all wire:key usage</div>
                            </div>
                        </div>

                        <div class="text-center p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
                            <p class="text-lg font-semibold text-yellow-800 mb-2">
                                Do your part, stop using random keys!
                            </p>
                            <p class="text-sm text-yellow-700 mb-2">
                                Random keys break component state and cause unnecessary re-renders. Use stable, meaningful identifiers instead.
                            </p>
                            <p class="text-sm text-yellow-700 mb-2">
                                <strong>Migration Impact:</strong> The Livewire 3 migration is made harder by these random keys, as each one needs to be analyzed and replaced manually.
                            </p>
                            <p class="text-sm text-yellow-700">
                                <strong>Note:</strong> The collected statistics might not be 100% accurate because aico includes legacy/unused pages that are still tracked in the repository.
                            </p>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        @livewireScripts
        <!-- Prism.js JavaScript -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/prism.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/prism-php.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/prism-blade.min.js"></script>
    </body>
</html>
