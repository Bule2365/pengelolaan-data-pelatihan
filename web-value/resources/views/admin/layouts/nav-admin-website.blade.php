<nav class="bg-white text-blue-700 shadow-md fixed w-full top-0 left-0 z-50 border-b border-gray-200">
    <div class="container mx-auto flex items-center justify-between p-4">
        <a class="text-2xl font-semibold" href="{{ route('admin.dashboard') }}">Admin Website</a>
        <button id="sidebarToggle" class="text-blue-700 lg:hidden focus:outline-none">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
            </svg>
        </button>
    </div>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
</nav>
