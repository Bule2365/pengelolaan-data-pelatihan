<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-blue-500 flex items-center justify-center min-h-screen">

    <div class="w-full max-w-lg bg-white shadow-lg rounded-lg p-8 m-4">
        <!-- Back to Login Button -->
        <div class="mb-6">
            <button type="button" onclick="window.location.href='{{ route('login.post') }}'"
                class="flex items-center space-x-2 bg-blue-500 text-white font-semibold py-2 px-4 rounded-lg hover:bg-blue-600 transition-transform transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                <!-- Back Icon -->
                <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"></path>
                </svg>
            </button>
        </div>
        <h2 class="text-3xl font-bold text-center text-blue-900 mb-6">Pendaftaran Peserta</h2>

        <!-- Error Messages -->
        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-4 rounded-lg mb-4">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form -->
        <form method="POST" action="{{ route('register.post') }}" class="space-y-6">
            @csrf

            <!-- Email -->
            <div>
                <label for="email" class="block text-lg font-medium text-blue-900">Email</label>
                <input type="email" name="email" id="email"
                    class="w-full mt-1 p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    required>
            </div>

            <!-- Name -->
            <div>
                <label for="name" class="block text-lg font-medium text-blue-900">Name</label>
                <input type="text" name="name" id="name"
                    class="w-full mt-1 p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    required>
            </div>

            <!-- Personal Phone -->
            <div>
                <label for="personal_phone" class="block text-lg font-medium text-blue-900">Personal Phone</label>
                <input type="text" name="personal_phone" id="personal_phone"
                    class="w-full mt-1 p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    required>
            </div>

            <!-- Company -->
            <div>
                <label for="company" class="block text-lg font-medium text-blue-900">Company</label>
                <input type="text" name="company" id="company"
                    class="w-full mt-1 p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>

            <!-- Company Phone -->
            <div>
                <label for="company_phone" class="block text-lg font-medium text-blue-900">Company Phone</label>
                <input type="text" name="company_phone" id="company_phone"
                    class="w-full mt-1 p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>

            <!-- Company Address -->
            <div>
                <label for="company_address" class="block text-lg font-medium text-blue-900">Company Address</label>
                <textarea name="company_address" id="company_address"
                    class="w-full mt-1 p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"></textarea>
            </div>

            <!-- Job Title -->
            <div>
                <label for="job_title" class="block text-lg font-medium text-blue-900">Job Title</label>
                <input type="text" name="job_title" id="job_title"
                    class="w-full mt-1 p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>

            <!-- Gender -->
            <div>
                <label for="gender" class="block text-lg font-medium text-blue-900">Gender</label>
                <select name="gender" id="gender"
                    class="w-full mt-1 p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-lg font-medium text-blue-900">Password</label>
                <input type="password" name="password" id="password"
                    class="w-full mt-1 p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    required>
            </div>

            <!-- Confirm Password -->
            <div>
                <label for="password_confirmation" class="block text-lg font-medium text-blue-900">Confirm
                    Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation"
                    class="w-full mt-1 p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    required>
            </div>

            <!-- Submit Button -->
            <button type="submit"
                class="w-full bg-blue-500 text-white font-bold py-3 rounded-lg hover:bg-blue-800 transition transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                Register
            </button>
        </form>
    </div>

</body>

</html>
