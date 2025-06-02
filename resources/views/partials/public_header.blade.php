<header class="bg-white shadow-sm sticky top-0 z-50">
    <nav class="container mx-auto px-6 py-6">
        <div class="flex justify-between items-center">
            <div>
                <a href="{{ route('home') }}" class="text-2xl font-bold text-gray-900 hover:text-red-500 transition-colors">
                    danyakmallun
                </a>
            </div>
            <div class="hidden md:flex space-x-8">
                <a href="{{ route('work.index') }}" 
                   class="text-gray-700 hover:text-red-500 font-medium transition-colors {{ request()->routeIs('work.index') ? 'text-red-500' : '' }}">
                    Works
                </a>
                <a href="{{ route('blog.index') }}" 
                   class="text-gray-700 hover:text-red-500 font-medium transition-colors {{ request()->routeIs('blog.index') || request()->routeIs('blog.show') ? 'text-red-500' : '' }}">
                    Blog
                </a>
                <a href="{{ route('contact.index') }}" 
                   class="text-gray-700 hover:text-red-500 font-medium transition-colors {{ request()->routeIs('contact.index') ? 'text-red-500' : '' }}">
                    Contact
                </a>
            </div>
            {{-- Mobile menu button --}}
            <div class="md:hidden">
                <button id="mobile-menu-button" class="text-gray-700 hover:text-red-500 focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>
        {{-- Mobile menu --}}
        <div id="mobile-menu" class="md:hidden hidden mt-4 pb-4">
            <div class="flex flex-col space-y-4">
                <a href="{{ route('work.index') }}" 
                   class="text-gray-700 hover:text-red-500 font-medium transition-colors {{ request()->routeIs('work.index') ? 'text-red-500' : '' }}">
                    Works
                </a>
                <a href="{{ route('blog.index') }}" 
                   class="text-gray-700 hover:text-red-500 font-medium transition-colors {{ request()->routeIs('blog.index') || request()->routeIs('blog.show') ? 'text-red-500' : '' }}">
                    Blog
                </a>
                <a href="{{ route('contact.index') }}" 
                   class="text-gray-700 hover:text-red-500 font-medium transition-colors {{ request()->routeIs('contact.index') ? 'text-red-500' : '' }}">
                    Contact
                </a>
            </div>
        </div>
    </nav>
</header>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
        
        if (mobileMenuButton && mobileMenu) {
            mobileMenuButton.addEventListener('click', function() {
                mobileMenu.classList.toggle('hidden');
            });
        }
    });
</script>