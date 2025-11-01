<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Signup</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/quizify-favicon.png') }}">

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-green-100 font-sans antialiased">

    <x-user-nav />

    <div class="flex items-center justify-center min-h-screen py-12 px-4 mt-12 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-6">

            <!-- Success / Error Alerts -->
            @if (Session::has('success'))
                <div class="bg-green-200 border border-green-400 text-green-800 px-4 py-3 rounded-lg shadow flex items-center justify-between"
                    role="alert">
                    <div>
                        <strong class="font-semibold">Success!</strong>
                        <span class="block sm:inline">{{ Session::get('success') }}</span>
                    </div>
                    <button type="button" onclick="this.closest('div[role=alert]').remove()"
                        class="ml-4 text-green-700 hover:text-green-900 focus:outline-none">
                        ✕
                    </button>
                </div>
            @elseif (Session::has('error'))
                <div class="bg-red-200 border border-red-400 text-red-800 px-4 py-3 rounded-lg shadow flex items-center justify-between"
                    role="alert">
                    <div>
                        <strong class="font-semibold">Error!</strong>
                        <span class="block sm:inline">{{ Session::get('error') }}</span>
                    </div>
                    <button type="button" onclick="this.closest('div[role=alert]').remove()"
                        class="ml-4 text-red-700 hover:text-red-900 focus:outline-none">
                        ✕
                    </button>
                </div>
            @endif

            <!-- Signup Card -->
            <div class="bg-white py-8 px-6 shadow-lg rounded-3xl">
                <h2 class="text-3xl font-bold text-center text-green-800 mb-6">User Signup</h2>

                <form action="{{ route('user.signup') }}" method="POST" class="space-y-5">
                    @csrf

                    <!-- Name -->
                    <div>
                        <label for="user_name" class="block text-sm font-medium text-gray-700">User Name</label>
                        <input type="text" name="name" id="user_name" placeholder="Enter User name"
                            value="{{ old('name') }}"
                            class="mt-1 block w-full px-4 py-3 border border-green-300 rounded-xl shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50 outline-none transition">
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="user_email" class="block text-sm font-medium text-gray-700">User Email</label>
                        <input type="email" name="email" id="user_email" placeholder="Enter User email"
                            value="{{ old('email') }}"
                            class="mt-1 block w-full px-4 py-3 border border-green-300 rounded-xl shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50 outline-none transition">
                        @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="user_password" class="block text-sm font-medium text-gray-700">Password</label>
                        <input type="password" name="password" id="user_password" placeholder="Enter Password"
                            class="mt-1 block w-full px-4 py-3 border border-green-300 rounded-xl shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50 outline-none transition">
                        @error('password')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label for="confirm_password" class="block text-sm font-medium text-gray-700">Confirm
                            Password</label>
                        <input type="password" name="password_confirmation" id="confirm_password"
                            placeholder="Confirm Password"
                            class="mt-1 block w-full px-4 py-3 border border-green-300 rounded-xl shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50 outline-none transition">
                    </div>

                    <!-- Submit -->
                    <div>
                        <button type="submit"
                            class="w-full py-3 bg-green-500 text-white font-semibold rounded-xl shadow-md hover:bg-green-600 focus:ring focus:ring-green-300 focus:ring-opacity-50 transition">
                            Signup
                        </button>
                    </div>

                </form>
            </div>

        </div>
    </div>

    <x-footer-user />

</body>

</html>
