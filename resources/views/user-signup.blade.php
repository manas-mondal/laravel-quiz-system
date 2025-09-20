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
