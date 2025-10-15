<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Login</title>
    @vite('resources/css/app.css')
</head>

<body>
    <x-user-nav />
    <div class="bg-green-100 flex flex-col items-center justify-center min-h-screen pt-24 pb-10">
        @if (Session::has('success'))
            <div class="bg-green-200 border border-green-500 text-green-800 px-4 py-3 rounded relative max-w-md mx-auto mb-4"
                role="alert">
                <strong class="font-bold">Success!</strong>
                <span class="block sm:inline pr-6">{{ Session::get('success') }}</span>
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3 cursor-pointer"
                    onclick="this.closest('div[role=alert]').remove()">
                    <svg class="fill-current h-6 w-6 text-green-600" role="button" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20">
                        <title>Close</title>
                        <path
                            d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                    </svg>
                </span>
            </div>
        @elseif (Session::has('error'))
            <div class="bg-red-200 border border-red-400 text-red-700 px-4 py-3 rounded relative max-w-md mx-auto mb-4"
                role="alert">
                <strong class="font-bold">Error!</strong>
                <span class="block sm:inline pr-6">{{ Session::get('error') }}</span>
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3 cursor-pointer"
                    onclick="this.closest('div[role=alert]').remove()">
                    <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20">
                        <title>Close</title>
                        <path
                            d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152l2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                    </svg>
                </span>
            </div>
        @endif
        <div class="bg-white p-8 rounded-2xl shadow-md w-full max-w-md">
            <h2 class="text-2xl text-center font-medium text-green-800 mb-6">User Login</h2>
            @error('user')
                <div class="text-red-500">{{ $message }}</div>
            @enderror
            <form action="{{ route('user.login') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="text-gray-600 mb-1" for="user_email">User Email</label>
                    <input
                        class="w-full px-4 py-2 border border-green-300 rounded-xl focus:border-green-500 focus:ring-2 focus:ring-green-200 outline-none transition"
                        type="text" name="email" placeholder="Enter User email" id="user_email"
                        value="{{ old('email') }}">
                    @error('email')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <label class="text-gray-600 mb-1" for="user_password">Password</label>
                    <input
                        class="w-full px-4 py-2 border border-green-300 rounded-xl focus:border-green-500 focus:ring-2 focus:ring-green-200 outline-none transition"
                        type="password" name="password" placeholder="Enter User password" id="user_password">
                    @error('password')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <button
                        class="w-full bg-green-500 rounded-xl py-2 text-white hover:bg-green-600 hover:cursor-pointer"
                        type="submit">Login</button>
                </div>
            </form>
            <div class="text-center mt-2">
                <a href="{{ route('user.password.request') }}" class="text-green-600 font-semibold hover:underline">
                    Forgot Password?
                </a>
            </div>
            <div class="text-center mt-4">
                <p class="text-gray-600">
                    Don't have an account?
                    <a href="{{ route('user.signup.form') }}" class="text-green-600 font-semibold hover:underline">
                        Create one here
                    </a>
                </p>
            </div>

        </div>
    </div>
    <x-footer-user />
</body>

</html>
