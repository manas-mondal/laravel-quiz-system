<nav class="p-4 bg-white shadow-xl flex justify-between items-center">
    <div class="text-2xl font-bold cursor-pointer">
        Quize System
    </div>
    <div class="space-x-4">
        <a class="text-gray-700 hover:text-blue-500" href="{{ route('dashboard') }}">Dashboard</a>
        <a class="text-gray-700 hover:text-blue-500" href="{{ route('admin.categories') }}">Categories</a>
        <a class="text-gray-700 hover:text-blue-500" href="">Quiz</a>
        <a class="text-gray-700 hover:text-blue-500" href="">Welcome {{ $admin->name }}</a>
        <a class="text-gray-700 hover:text-blue-500" href="{{ route('admin.logout') }}">Logout</a>
    </div>
</nav>
