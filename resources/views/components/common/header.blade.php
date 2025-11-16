<header class="w-full flex justify-between items-center px-8 py-4 bg-bce-blue/90 backdrop-blur top-0 z-50">
        <a href="/" class="flex items-center space-x-3">
            <img src="{{ asset('images/bcelogo.png') }}" alt="BCE Logo" class="h-10">
            <span class="text-sm italic opacity-80 hidden sm:block">sine scientia ars nihil est</span>
        </a>

        <div class="flex-1 mx-6 max-w-xl">
            <form action="{{ route('products.index') }}" method="GET" class="w-full">
                <input
                    type="text"
                    name="search"
                    placeholder="Search for products..."
                    value="{{ request('search') }}"
                    class="w-full border rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
            </form>
        </div>
        <nav class="flex space-x-6 text-sm uppercase tracking-wide">
            <a href="/" class="hover:text-bce-accent transition">Home</a>
            <a href="/products" class="hover:text-bce-accent transition">Products</a>
            <a href="#" class="hover:text-bce-accent transition">About</a>
            <a href="#" class="hover:text-bce-accent transition">Contact</a>
        </nav>


        <!-- Cart Button -->
        <a href="/" class="relative flex items-center text-gray-100 hover:text-gray-200">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
              </svg>
              
            <span class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full text-xs w-5 h-5 flex items-center justify-center">
                {{-- {{ session('cart') ? count(session('cart')) : 0 }} --}}
            </span>
        </a>

        <!-- User / Account Button -->
        @auth
            <a href="{{ route('dashboard') }}" class="text-gray-100 hover:text-gray-200 flex items-center space-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                  </svg>
                  
                  
            </a>
        @else
            <a href="{{ route('login') }}" class="text-gray-700 hover:text-gray-900">Login</a>
        @endauth
    </div>
</header>