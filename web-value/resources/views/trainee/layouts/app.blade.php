<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Trainee Dashboard')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex h-screen bg-gray-100 text-gray-900">
    <!-- Sidebar -->
    <div id="sidebar"
        class="fixed inset-y-0 left-0 w-64 bg-blue-700 text-white p-6 space-y-6 transform -translate-x-full transition-transform duration-500 ease-in-out lg:translate-x-0 lg:relative shadow-lg">
        <!-- Close button -->
        <div class="lg:hidden flex justify-end">
            <button id="closeSidebar" class="text-white focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Profile Section -->
        <div class="flex items-center space-x-4 pb-4 border-b border-blue-600">
            <div>
                <a href="{{ route('trainee.edit-profile') }}"
                    class="flex text-lg font-semibold hover:text-gray-300 transition-colors duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                    </svg>
                    <span class="ml-3">Profile</span>
                </a>
            </div>
        </div>

        <!-- Navigation Links -->
        <nav>
            <ul class="space-y-2">
                <li>
                    <a href="{{ route('trainee.dashboard') }}"
                        class="block py-3 px-4 rounded-lg hover:bg-blue-600 hover:text-white transition-all duration-300 ease-in-out">Dashboard</a>
                </li>
                <li>
                    <a href="{{ route('trainee.posts.index') }}"
                        class="block py-3 px-4 rounded-lg hover:bg-blue-600 hover:text-white transition-all duration-300 ease-in-out">Postingan Pelatihan</a>
                </li>
                <li>
                    <a href="{{ route('trainee.orders.index') }}"
                        class="block py-3 px-4 rounded-lg hover:bg-blue-600 hover:text-white transition-all duration-300 ease-in-out">Pelatihan Kamu</a>
                </li>
                <li>
                    <a href="{{ route('trainee.events.index') }}"
                        class="block py-3 px-4 rounded-lg hover:bg-blue-600 hover:text-white transition-all duration-300 ease-in-out">Event</a>
                </li>
                <li>
                    <a href="{{ route('trainee.my-events') }}"
                        class="block py-3 px-4 rounded-lg hover:bg-blue-600 hover:text-white transition-all duration-300 ease-in-out">Event Kamu</a>
                </li>
                <li>
                    <a href="{{ route('trainings.list') }}"
                        class="block py-3 px-4 rounded-lg hover:bg-blue-600 hover:text-white transition-all duration-300 ease-in-out">Evaluasi
                        Pelatihan</a>
                </li>
            </ul>
        </nav>

        <!-- Logout Button -->
        <form id="logout-form" action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit"
                class="w-full bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-lg transition duration-300 focus:outline-none focus:ring-2 focus:ring-red-500">Logout</button>
        </form>

        <!-- WhatsApp Button -->
        <a href="https://wa.me/+6281523651797" target="_blank"
            class="fixed bottom-4 right-4 bg-green-500 text-white p-4 rounded-full shadow-lg hover:bg-green-600 transition-all duration-300 ease-in-out">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M8.294 7.706a9.013 9.013 0 0 1 4.795-1.34c4.963 0 8.988 4.027 8.988 8.986s-4.027 8.986-8.988 8.986a8.961 8.961 0 0 1-4.795-1.34m.045-2.788a6.994 6.994 0 0 0 3.984 1.246c3.873 0 7.004-3.107 7.004-6.957 0-3.849-3.131-6.955-7.004-6.955a6.965 6.965 0 0 0-3.984 1.247m-1.737-1.48c.33-1.541 1.442-2.938 3.015-3.626m-4.345 2.104c.37-1.658 1.7-2.954 3.337-3.58m-4.024 4.272a6.97 6.97 0 0 0 3.643 2.752m-4.174 1.818c1.053-.81 2.164-1.483 3.297-2.026m3.797 4.788a7.068 7.068 0 0 0 4.201-1.508c1.227-1.048 2.291-2.313 3.075-3.747" />
            </svg>
        </a>
    </div>

    <!-- Main content -->
    <main class="flex-grow p-6 overflow-auto bg-white shadow-md rounded-lg mx-4 my-6">
        <!-- Hamburger menu -->
        <div class="lg:hidden mb-4">
            <button id="hamburger" class="text-orange-500 focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>
        @yield('content')
    </main>

    <script>
        const sidebar = document.getElementById('sidebar');
        const hamburger = document.getElementById('hamburger');
        const closeSidebar = document.getElementById('closeSidebar');

        hamburger.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full');
        });

        closeSidebar.addEventListener('click', () => {
            sidebar.classList.add('-translate-x-full');
        });
    </script>
</body>

</html>
