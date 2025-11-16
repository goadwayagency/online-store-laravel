<div class="z-10 hidden md:flex md:flex-shrink-0">
    {{$company = "";}}
    <!-- Desktop Sidebar -->
    <div class="relative flex flex-col w-64 bg-[#eef3fb] overflow-hidden">

        <!-- Background glows -->
        <div class="absolute top-10 -left-10 w-40 h-40 bg-gradient-to-tr from-[#c4d7ff]/40 to-transparent rounded-full blur-3xl"></div>
        <div class="absolute bottom-10 -right-10 w-48 h-48 bg-gradient-to-bl from-[#d4f1ff]/50 to-transparent rounded-full blur-3xl"></div>

        <!-- Logo -->
        <div class="grid grid-cols-2 items-center h-16 px-4  relative">
            <a href="{{ route('admin.dashboard.index') }}" class="flex items-center">
                <img 
                    src="/public{{ $company && $company->logo_path ? Storage::url($company->logo_path) : 'https://pub-56989421c96a4a83a6c1e963a31939e6.r2.dev/emotions-travel/emotions-morocco-logo%20(1).webp' }}"
                    alt="Logo"
                    class="p-2 rounded-full h-16 w-auto"
                />
            </a>
            <span class="truncate text-gray-700 dark:text-gray-100">
                {{$company->name ?? ''}}
            </span>
        </div>

        <!-- Navigation -->
        <div class="z-10 flex flex-col flex-grow px-4 py-4 overflow-y-auto">
            <nav class="flex flex-col space-y-6 text-gray-800 dark:text-gray-100">

                @foreach(config('navigation.sections') as $section)
                    <div class="space-y-2">

                        <!-- Section Title -->
                        {{-- <p class="px-2 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase">
                            {{ __('messages.' . $section['title']) }}
                        </p> --}}

                        <!-- Always-visible links -->
                        <div class="space-y-1 mt-2">
                            @foreach ($section['items'] as $item)
                                @php $isActive = request()->routeIs($item['route'].'*'); @endphp
                        
                                <a 
                                    href="{{ route($item['route']) }}"
                                    wire:navigate
                                    class="
                                        group flex items-center gap-4 px-4 py-3 rounded-2xl cursor-pointer
                                        text-[15px] font-medium
                                        transition-all duration-200
                        
                                        {{ $isActive 
                                            ? 'bg-[#c2e7ff] text-gray-900' 
                                            : 'text-gray-700 hover:bg-gray-100 hover:text-gray-900' 
                                        }}
                                    "
                                >
                        
                                    <x-dynamic-icon
                                        :name="$item['icon']"
                                        class="
                                            w-6 h-6 
                                            {{ $isActive 
                                                ? 'text-gray-900' 
                                                : 'text-gray-500 group-hover:text-gray-700' 
                                            }}
                                            transition-colors
                                        "
                                    />
                        
                                    <span>{{ $item['name'] }}</span>
                                </a>
                        
                            @endforeach
                        </div>
                        
                        

                    </div>
                @endforeach

            </nav>

            <!-- User -->
            <div class="mt-auto pt-4 ">
                <a href="#" class="flex items-center px-2 py-2">
                    <svg class="w-8 h-8 text-gray-400 dark:text-gray-500" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 14.75c2.67 0 8 1.34 8 4v1.25H4v-1.25c0-2.66 5.33-4 8-4zm0-9.5c-2.22 0-4 1.78-4 4s1.78 4 4 4 4-1.78 4-4-1.78-4-4-4z" />
                    </svg>
                    <div class="ml-3">
                        <p class="text-sm font-medium">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-gray-500">{{ Auth::user()->email }}</p>
                    </div>
                </a>

                <button wire:click="logout"
                    class="w-full flex items-center px-2 py-2 text-sm font-medium text-gray-600 dark:text-gray-300 hover:bg-gray-50">
                    <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                    {{ __('Log Out') }}
                </button>
            </div>
        </div>
    </div>
</div>
