<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles
    
    <style>
        .notification-badge {
            position: absolute;
            top: -6px;
            right: -6px;
            background-color: #ef4444;
            color: white;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            font-size: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
</head>

<body class="font-sans antialiased bg-[#eef3fb] text-gray-900">

    @if(session('success'))
    <x-flash type="success"
        :title="session('success-title', 'Success')"
        :message="session('success')" />
    @endif

    @if(session('error'))
    <x-flash type="error"
        :title="session('error-title', 'Error')"
        :message="session('error')" />
    @endif
    
    @if ($errors->any())
    <x-flash type="error"
        title="Validation Error"
        :message="$errors->all()" />
    @endif

    <div class="flex flex-col md:flex-row h-screen relative overflow-hidden">
        
        @include('layouts.navigation')
        
        <div class="z-10 flex-1 flex flex-col">
            <!-- Top Navigation Bar -->
            @include('layouts.top-navigation')
            <!-- Main Content Area -->
            <div class="flex-1 p-4 overflow-auto">
                @isset($header)
                <header class="mt-4 p-1">
                    <div class="max-w-3xl sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
                @endisset

                <main>
                    {{ $slot }}
                </main>
            </div>
        </div>
    </div>
    
    @livewireScripts
    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('closeModal', () => {
                Livewire.emit('resetSelectedItemId');
            });
            
            Livewire.on('costAdded', () => {
                Livewire.emit('refresh');
            });
        });
    </script>
</body>
</html>