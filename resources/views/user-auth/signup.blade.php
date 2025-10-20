<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Signup</title>
    @vite('resources/css/app.css')
</head>

<body>
    <x-user-nav />
    <div class="bg-green-100 flex items-center justify-center min-h-screen pt-24 pb-10">
        @if (Session::has('success'))
            <div class="flex items-center bg-green-200 border border-green-400 text-green-800 px-4 py-3 rounded-lg shadow relative max-w-md mx-auto mb-4"
                role="alert">
                <span class="flex-1">
                    <strong class="font-semibold">Success!</strong>
                    <span class="block sm:inline"> {{ Session::get('success') }} </span>
                </span>
                <button type="button" onclick="this.closest('div[role=alert]').remove()"
                    class="ml-4 text-green-600 hover:text-green-800 hover:cursor-pointer focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        @elseif (Session::has('error'))
            <div class="flex items-center bg-red-200 border border-red-400 text-red-800 px-4 py-3 rounded-lg shadow relative max-w-md mx-auto mb-4"
                role="alert">
                <span class="flex-1">
                    <strong class="font-semibold">Error!</strong>
                    <span class="block sm:inline"> {{ Session::get('error') }} </span>
                </span>
                <button type="button" onclick="this.closest('div[role=alert]').remove()"
                    class="ml-4 text-red-600 hover:text-red-800 hover:cursor-pointer focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        @endif
        <div class="bg-white p-8 rounded-2xl shadow-md w-full max-w-md">
            <h2 class="text-2xl text-center font-medium text-green-800 mb-6">User Signup</h2>
            @error('user')
                <div class="text-red-500">{{ $message }}</div>
            @enderror
            <form action="{{ route('user.signup') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="text-gray-600 mb-1" for="user_name">User Name</label>
                    <input
                        class="w-full px-4 py-2 border border-green-300 rounded-xl focus:border-green-500 focus:ring-2 focus:ring-green-200 outline-none transition"
                        type="text" name="name" placeholder="Enter User name" id="user_name"
                        value="{{ old('name') }}">
                    @error('name')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>
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
                    <label class="text-gray-600 mb-1" for="confirm_password">Confirm Password</label>
                    <input
                        class="w-full px-4 py-2 border border-green-300 rounded-xl focus:border-green-500 focus:ring-2 focus:ring-green-200 outline-none transition"
                        type="password" name="password_confirmation" placeholder="Enter Confirm password"
                        id="confirm_password">
                </div>
                <div>
                    <button class="w-full bg-green-500 rounded-xl py-2 text-white hover:bg-green-600"
                        type="submit">Signup</button>
                </div>
            </form>
        </div>
    </div>
    <x-footer-user />
</body>

</html>
