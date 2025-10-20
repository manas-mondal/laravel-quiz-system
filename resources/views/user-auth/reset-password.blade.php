<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reset Password</title>
    @vite('resources/css/app.css')
</head>

<body>
    <x-user-nav />
    <div class="bg-green-100 flex flex-col items-center justify-center min-h-screen pt-24 pb-10">
        @if (isset($success_message))
            <div class="flex items-center bg-green-200 border border-green-400 text-green-800 px-4 py-3 rounded-lg shadow relative max-w-md mx-auto mb-4"
                role="alert">
                <span class="flex-1">
                    <strong class="font-semibold">Success!</strong>
                    <span class="block sm:inline"> {{ $success_message }} </span>
                </span>
                <button type="button" onclick="this.closest('div[role=alert]').remove()"
                    class="ml-4 text-green-600 hover:text-green-800 hover:cursor-pointer focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        @endif
        <div class="bg-white p-8 rounded-2xl shadow-md w-full max-w-md">
            <h2 class="text-2xl text-center font-medium text-green-800 mb-6">Reset Your Password</h2>
            @error('user')
                <div class="text-red-500">{{ $message }}</div>
            @enderror
            <form action="{{ route('user.password.update') }}" method="POST" class="space-y-4">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <input type="hidden" name="email" value="{{ $email }}">
                <div>
                    <label class="text-gray-600 mb-1" for="user_password">New Password</label>
                    <input
                        class="w-full px-4 py-2 border border-green-300 rounded-xl focus:border-green-500 focus:ring-2 focus:ring-green-200 outline-none transition"
                        type="password" name="password" placeholder="Enter new password" id="user_password">
                    @error('password')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <label class="text-gray-600 mb-1" for="password_confirmation">Confirm Password</label>
                    <input
                        class="w-full px-4 py-2 border border-green-300 rounded-xl focus:border-green-500 focus:ring-2 focus:ring-green-200 outline-none transition"
                        type="password" name="password_confirmation" placeholder="Confirm new password"
                        id="password_confirmation">
                    @error('password_confirmation')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <button
                        class="w-full bg-green-500 rounded-xl py-2 text-white hover:bg-green-600 hover:cursor-pointer transition"
                        type="submit">Reset Password</button>
                </div>
            </form>
        </div>
    </div>
    <x-footer-user />
</body>

</html>
