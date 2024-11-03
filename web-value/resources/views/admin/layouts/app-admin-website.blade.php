<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') | Admin Website</title>
    @stack('styles')
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<body class="font-sans bg-gray-50 text-gray-900">

    @include('admin.layouts.nav-admin-website')

    <div class="flex">
        <!-- Sidebar -->
        <aside id="sidebar"
            class="fixed inset-y-0 left-0 w-64 bg-blue-50 text-blue-800 transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out shadow-md lg:shadow-none z-40 overflow-y-auto">
            <div class="p-8 space-y-6">
                <ul class="mt-16 space-y-2">

                    <a class="flex w-full py-3 px-6 text-lg font-medium text-blue-800 rounded-lg transition-colors duration-300 ease-in-out hover:bg-blue-800 hover:text-blue-100"
                        href="{{ route('admin.edit-profile') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        </svg>
                        <span class="ml-1">Informasi</span>
                    </a>

                    <a class="flex w-full py-3 px-6 text-lg font-medium text-blue-800 rounded-lg transition-colors duration-300 ease-in-out hover:bg-blue-800 hover:text-blue-100"
                        href="{{ route('admin.dashboard') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.666 3.888A2.25 2.25 0 0 0 13.5 2.25h-3c-1.03 0-1.9.693-2.166 1.638m7.332 0c.055.194.084.4.084.612v0a.75.75 0 0 1-.75.75H9a.75.75 0 0 1-.75-.75v0c0-.212.03-.418.084-.612m7.332 0c.646.049 1.288.11 1.927.184 1.1.128 1.907 1.077 1.907 2.185V19.5a2.25 2.25 0 0 1-2.25 2.25H6.75A2.25 2.25 0 0 1 4.5 19.5V6.257c0-1.108.806-2.057 1.907-2.185a48.208 48.208 0 0 1 1.927-.184" />
                        </svg>
                        <span class="ml-1">Dashboard</span>
                    </a>

                    <button type="button"
                        class="flex w-full py-3 px-6 text-lg font-medium text-blue-800 rounded-lg transition-colors duration-300 ease-in-out hover:bg-blue-800 hover:text-blue-100"
                        aria-controls="dropdown-pages" data-collapse-toggle="dropdown-pages">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                            <path
                                d="M5.625 3.75a2.625 2.625 0 1 0 0 5.25h12.75a2.625 2.625 0 0 0 0-5.25H5.625ZM3.75 11.25a.75.75 0 0 0 0 1.5h16.5a.75.75 0 0 0 0-1.5H3.75ZM3 15.75a.75.75 0 0 1 .75-.75h16.5a.75.75 0 0 1 0 1.5H3.75a.75.75 0 0 1-.75-.75ZM3.75 18.75a.75.75 0 0 0 0 1.5h16.5a.75.75 0 0 0 0-1.5H3.75Z" />
                        </svg>
                        <span class="flex ml-1 text-left whitespace-nowrap">Pages</span>
                    </button>
                    <ul id="dropdown-pages" class="hidden py-2 space-y-2 transform transition duration-500 ease-in-out">
                        <a class="block py-3 px-6 rounded-lg text-lg font-medium transition-colors duration-300 ease-in-out hover:bg-blue-100 hover:text-blue-800"
                            href="{{ url('trainers') }}">Trainer</a>
                        <a class="block py-3 px-6 rounded-lg text-lg font-medium transition-colors duration-300 ease-in-out hover:bg-blue-100 hover:text-blue-800"
                            href="{{ url('hotels') }}">Hotel</a>
                        <a class="block py-3 px-6 rounded-lg text-lg font-medium transition-colors duration-300 ease-in-out hover:bg-blue-100 hover:text-blue-800"
                            href="{{ url('/type_trainings') }}">Jenis Pelatihan</a>
                        <a class="block py-3 px-6 rounded-lg text-lg font-medium transition-colors duration-300 ease-in-out hover:bg-blue-100 hover:text-blue-800"
                            href="{{ url('/categories') }}">Kategori</a>
                        <a class="block py-3 px-6 rounded-lg text-lg font-medium transition-colors duration-300 ease-in-out hover:bg-blue-100 hover:text-blue-800"
                            href="{{ url('/certificates') }}">Sertifikat</a>
                        <a class="block py-3 px-6 rounded-lg text-lg font-medium transition-colors duration-300 ease-in-out hover:bg-blue-100 hover:text-blue-800"
                            href="{{ url('/data-prices') }}">Harga Training</a>
                        <a class="block py-3 px-6 rounded-lg text-lg font-medium transition-colors duration-300 ease-in-out hover:bg-blue-100 hover:text-blue-800"
                            href="{{ url('/training_materials') }}">Data Materi</a>
                        <a class="block py-3 px-6 rounded-lg text-lg font-medium transition-colors duration-300 ease-in-out hover:bg-blue-100 hover:text-blue-800"
                            href="{{ url('/schedule') }}">Jadwal</a>
                        <a class="block py-3 px-6 rounded-lg text-lg font-medium transition-colors duration-300 ease-in-out hover:bg-blue-100 hover:text-blue-800"
                            href="{{ url('/manage-posts') }}">Postingan</a>
                        <a class="block py-3 px-6 rounded-lg text-lg font-medium transition-colors duration-300 ease-in-out hover:bg-blue-100 hover:text-blue-800"
                            href="{{ url('/admin/payment-methods') }}">Metode Pembayaran</a>
                        <a class="block py-3 px-6 rounded-lg text-lg font-medium transition-colors duration-300 ease-in-out hover:bg-blue-100 hover:text-blue-800"
                            href="{{ url('/admin/payments') }}">Transaksi</a>
                        <a class="block py-3 px-6 rounded-lg text-lg font-medium transition-colors duration-300 ease-in-out hover:bg-blue-100 hover:text-blue-800"
                            href="{{ url('admin/evaluations') }}">Evaluasi Form</a>
                        <a class="block py-3 px-6 rounded-lg text-lg font-medium transition-colors duration-300 ease-in-out hover:bg-blue-100 hover:text-blue-800"
                            href="{{ url('/events') }}">Acara</a>
                    </ul>
                    <a class="flex w-full py-3 px-6 text-lg font-medium text-blue-800 rounded-lg transition-colors duration-300 ease-in-out hover:bg-blue-800 hover:text-blue-100"
                        href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15" />
                        </svg>
                        <span class="flex-1 ml-1 text-left whitespace-nowrap">Logout</span>
                    </a>
                </ul>
            </div>
        </aside>
        <!-- Main Content -->
        <main class="flex-1 lg:ml-64 p-6 lg:p-8 transition-all duration-300 ease-in-out pt-20 lg:pt-24">
            <div class="bg-white shadow-lg rounded-lg p-8 border border-gray-200">
                <h1 class="text-4xl font-bold mb-2 text-blue-700">@yield('header')</h1>
                @yield('content')
            </div>
            @stack('scripts')
        </main>
    </div>

    <script>
        // JavaScript to toggle sidebar visibility on mobile
        document.getElementById('sidebarToggle')?.addEventListener('click', function() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('-translate-x-full');
        });

        // dropwdown menu
        document.addEventListener('DOMContentLoaded', function() {
            const toggleButton = document.querySelector('[data-collapse-toggle="dropdown-pages"]');
            const dropdownMenu = document.getElementById('dropdown-pages');

            toggleButton.addEventListener('click', function() {
                dropdownMenu.classList.toggle('hidden');
            });
        });
    </script>
</body>

</html>
