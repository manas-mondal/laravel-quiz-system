<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/quizify-favicon.png') }}">

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-green-100 font-sans antialiased">

    <x-user-nav />

    <div class="flex items-center justify-center min-h-screen py-12 px-4 mt-12 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-6">

            <!-- Alerts -->
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

            <!-- Forgot Password Card -->
            <div class="bg-white py-8 px-6 shadow-lg rounded-3xl">
                <h2 class="text-3xl font-bold text-center text-green-800 mb-6">Forgot Password</h2>

                <form action="{{ route('user.password.email') }}" method="POST" class="space-y-5">
                    @csrf

                    <!-- Email Input -->
                    <div>
                        <label for="user_email" class="block text-sm font-medium text-gray-700">Enter Your Email</label>
                        <input type="email" name="email" id="user_email" placeholder="Enter your registered email"
                            value="{{ old('email') }}"
                            class="mt-1 block w-full px-4 py-3 border border-green-300 rounded-xl shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50 outline-none transition">
                        @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div>
                        <button type="submit"
                            class="w-full py-3 bg-green-500 text-white font-semibold rounded-xl shadow-md hover:bg-green-600 focus:ring focus:ring-green-300 focus:ring-opacity-50 transition">
                            Send Reset Link
                        </button>
                    </div>
                </form>

                <!-- Login Link -->
                <p class="text-sm text-gray-600 mt-4 text-center">
                    Remember your password?
                    <a href="{{ route('user.login') }}" class="text-green-600 font-semibold hover:underline">
                        Login
                    </a>
                </p>
            </div>
        </div>
    </div>

    <x-footer-user />

</body>

</html>
