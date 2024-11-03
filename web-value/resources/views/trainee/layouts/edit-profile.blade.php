@extends('trainee.layouts.app')

@section('title', 'Edit Profile')

@section('content')
    <div class="bg-white p-8 rounded-lg shadow-lg max-w-lg mx-auto mt-10">
        <h2 class="text-3xl font-bold text-center text-blue-600 mb-6">Edit Profile</h2>

        @if ($errors->any())
            <div class="bg-red-500 text-white p-4 rounded mb-4">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('trainee.update-profile') }}">
            @csrf
            <!-- Name Field -->
            <div class="mb-4">
                <label for="name" class="block text-lg font-medium text-gray-700">Name</label>
                <input type="text" name="name" id="name" value="{{ old('name', $trainee->name) }}"
                    class="w-full p-3 bg-gray-100 text-gray-800 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                    required>
            </div>

            <!-- Personal Phone Field -->
            <div class="mb-4">
                <label for="personal_phone" class="block text-lg font-medium text-gray-700">Personal Phone</label>
                <input type="text" name="personal_phone" id="personal_phone"
                    value="{{ old('personal_phone', $trainee->personal_phone) }}"
                    class="w-full p-3 bg-gray-100 text-gray-800 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                    required>
            </div>

            <!-- Company Field -->
            <div class="mb-4">
                <label for="company" class="block text-lg font-medium text-gray-700">Company</label>
                <input type="text" name="company" id="company" value="{{ old('company', $trainee->company) }}"
                    class="w-full p-3 bg-gray-100 text-gray-800 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Company Phone Field -->
            <div class="mb-4">
                <label for="company_phone" class="block text-lg font-medium text-gray-700">Company Phone</label>
                <input type="text" name="company_phone" id="company_phone"
                    value="{{ old('company_phone', $trainee->company_phone) }}"
                    class="w-full p-3 bg-gray-100 text-gray-800 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Company Address Field -->
            <div class="mb-4">
                <label for="company_address" class="block text-lg font-medium text-gray-700">Company Address</label>
                <input type="text" name="company_address" id="company_address"
                    value="{{ old('company_address', $trainee->company_address) }}"
                    class="w-full p-3 bg-gray-100 text-gray-800 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Job Title Field -->
            <div class="mb-4">
                <label for="job_title" class="block text-lg font-medium text-gray-700">Job Title</label>
                <input type="text" name="job_title" id="job_title" value="{{ old('job_title', $trainee->job_title) }}"
                    class="w-full p-3 bg-gray-100 text-gray-800 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Gender Field -->
            <div class="mb-4">
                <label for="gender" class="block text-lg font-medium text-gray-700">Gender</label>
                <select name="gender" id="gender"
                    class="w-full p-3 bg-gray-100 text-gray-800 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                    required>
                    <option value="male" {{ old('gender', $trainee->gender) == 'male' ? 'selected' : '' }}>Male</option>
                    <option value="female" {{ old('gender', $trainee->gender) == 'female' ? 'selected' : '' }}>Female
                    </option>
                </select>
            </div>

            <!-- Password Field -->
            <div class="mb-4">
                <label for="password" class="block text-lg font-medium text-gray-700">Password</label>
                <input type="password" name="password" id="password"
                    class="w-full p-3 bg-gray-100 text-gray-800 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                <small class="text-gray-500">Leave blank if you don't want to change the password.</small>
            </div>

            <!-- Password Confirmation Field -->
            <div class="mb-4">
                <label for="password_confirmation" class="block text-lg font-medium text-gray-700">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation"
                    class="w-full p-3 bg-gray-100 text-gray-800 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Submit Button -->
            <button type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition duration-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
                Update Profile
            </button>
        </form>
    </div>
@endsection
