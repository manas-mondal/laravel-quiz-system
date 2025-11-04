<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/quizify-favicon.png') }}">

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fadeUp {
            animation: fadeUp .3s ease-out;
        }
    </style>
</head>

<body class="bg-green-100 font-sans antialiased">

    <x-user-nav />

    <div class="flex items-center justify-center min-h-screen py-12 px-4 mt-12 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-6">

            <!-- Success Alert -->
            @if (isset($success_message))
                <div class="bg-green-200 border border-green-400 text-green-800 px-4 py-3 rounded-lg shadow flex items-center justify-between animate-fadeUp"
                    role="alert">
                    <div>
                        <strong class="font-semibold">Success!</strong>
                        <span class="block sm:inline">{{ $success_message }}</span>
                    </div>
                    <button type="button" onclick="this.closest('div[role=alert]').remove()"
                        class="ml-4 text-green-700 hover:text-green-900 focus:outline-none">
                        ✕
                    </button>
                </div>
            @endif

            <!-- Reset Password Card -->
            <div class="bg-white py-8 px-6 shadow-lg rounded-3xl animate-fadeUp">
                <h2 class="text-3xl font-extrabold text-center text-green-800 mb-6 animate-fadeUp">Reset Your Password
                </h2>

                <form action="{{ route('user.password.update') }}" method="POST" class="space-y-5 animate-fadeUp">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <input type="hidden" name="email" value="{{ $email }}">

                    <!-- New Password -->
                    <div>
                        <label for="user_password" class="block text-sm font-medium text-gray-700">New Password</label>
                        <input type="password" name="password" id="user_password" placeholder="Enter new password"
                            class="mt-1 block w-full px-4 py-3 border border-green-300 rounded-xl shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50 outline-none transition">
                        @error('password')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm
                            Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation"
                            placeholder="Confirm new password"
                            class="mt-1 block w-full px-4 py-3 border border-green-300 rounded-xl shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 focus:ring-opacity-50 outline-none transition">
                        @error('password_confirmation')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div>
                        <button type="submit"
                            class="w-full py-3 bg-green-500 text-white font-semibold rounded-xl shadow-md hover:bg-green-600 focus:ring focus:ring-green-300 focus:ring-opacity-50 transition animate-fadeUp">
                            Reset Password
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <x-footer-user />

</body>

</html>
