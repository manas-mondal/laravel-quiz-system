<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Login</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-2xl shadow-md w-full max-w-md">
        <h2 class="text-2xl text-center text-gray-800 mb-6">Admin Login</h2>
        @error('user')
            <div class="text-red-500">{{ $message }}</div>
        @enderror
        <form action="/admin-login" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="text-gray-600 mb-1" for="admin_name">Admin name</label>
                <input
                    class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition"
                    type="text" name="name" placeholder="Enter Admin name" id="admin_name">
                @error('name')
                    <div class="text-red-500">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label class="text-gray-600 mb-1" for="admin_password">Password</label>
                <input
                    class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition"
                    type="password" name="password" placeholder="Enter Admin password" id="admin_password">
                @error('password')
                    <div class="text-red-500">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <button class="w-full bg-blue-500 rounded-xl py-2 text-white hover:bg-blue-600"
                    type="submit">Login</button>
            </div>
        </form>
    </div>
</body>

</html>
