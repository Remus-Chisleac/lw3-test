<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{ $title ?? 'Wire:key Demo' }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
        <!-- Prism.js for syntax highlighting -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/themes/prism-okaidia.min.css" rel="stylesheet" />
    </head>
    <body class="bg-gray-100 min-h-screen py-8">
        <div class="container mx-auto">
            <div class="mb-8 text-center">
                <a href="/" class="inline-block px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition duration-200">
                    ← Back to Home
                </a>
            </div>
            {{ $slot }}
        </div>
        @livewireScripts
        <!-- Prism.js JavaScript -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/prism.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/prism-php.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/prism-markup-templating.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/prism-blade.min.js"></script>
    </body>
</html>