<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-gray-100 to-gray-200">

    <div class="w-full max-w-md px-4 py-5">
        @if (Session::has('success'))
            <div class="flex items-center bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded-xl shadow-sm mb-5 animate-fadeIn"
                role="alert">
                <span class="flex-1">
                    <strong class="font-semibold">Success:</strong> {{ Session::get('success') }}
                </span>
                <button onclick="this.closest('div[role=alert]').remove()"
                    class="text-green-700 hover:text-green-900 hover:font-bold">
                    ✕
                </button>
            </div>
        @elseif (Session::has('error'))
            <div class="flex items-center bg-red-100 border border-red-300 text-red-800 px-4 py-3 rounded-xl shadow-sm mb-5 animate-fadeIn"
                role="alert">
                <span class="flex-1">
                    <strong class="font-semibold">Error:</strong> {{ Session::get('error') }}
                </span>
                <button onclick="this.closest('div[role=alert]').remove()"
                    class="text-red-700 hover:text-red-900 hover:font-bold">
                    ✕
                </button>
            </div>
        @endif

        <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300">
            <h2 class="text-2xl font-semibold text-center text-gray-800 mb-6 tracking-wide">Admin Login</h2>

            @error('user')
                <p class="text-red-500 text-sm mb-2">{{ $message }}</p>
            @enderror

            <form action="{{ route('admin.login') }}" method="POST" class="space-y-5">
                @csrf

                <div>
                    <label for="admin_name" class="text-gray-700 font-medium">Admin Name</label>
                    <input type="text" name="name" id="admin_name"
                        class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-300 focus:border-blue-500 outline-none transition"
                        placeholder="Enter Admin name" value="{{ old('name') }}">
                    @error('name')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="admin_password" class="text-gray-700 font-medium">Password</label>
                    <input type="password" name="password" id="admin_password"
                        class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-300 focus:border-blue-500 outline-none transition"
                        placeholder="Enter Admin password">
                    @error('password')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit"
                    class="w-full py-2.5 bg-blue-600 text-white rounded-lg text-lg hover:bg-blue-700 active:scale-[.98] transition">
                    Login
                </button>
            </form>
        </div>
    </div>

</body>

</html>
