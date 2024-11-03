<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Trainer Dashboard')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Transition for smooth toggle */
        .transition-all {
            transition: all 0.3s ease;
        }

        .hidden-sidebar {
            width: 0;
            opacity: 0;
        }
    </style>
</head>

<body class="flex h-screen bg-gray-100">
    <div class="flex flex-1">
        <!-- Sidebar -->
        <aside id="sidebar" class="w-64 bg-green-800 text-white p-6 transition-all">
            <div class="flex items-center mb-8">
                <h1 class="text-2xl font-semibold">Trainer Dashboard</h1>
            </div>
            <nav>
                <ul>
                    <li>
                        <a href="{{ route('trainer.dashboard') }}"
                            class="block py-2 px-4 rounded hover:bg-green-700">Dashboard</a>
                    </li>
                    <li>
                        <a href="{{ route('trainer.send_materials.index') }}"
                            class="block py-2 px-4 rounded hover:bg-green-700">Materi Pelatihan</a>
                    </li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST" class="mt-6">
                            @csrf
                            <button type="submit"
                                class="w-full py-2 px-4 bg-red-600 rounded hover:bg-red-700 text-white">
                                Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-6 overflow-auto">
            @yield('content')
        </main>
    </div>
</body>

</html>
