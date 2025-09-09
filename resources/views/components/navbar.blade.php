<nav class="fixed top-0 left-0 right-0 z-5 p-4 bg-white shadow-md flex justify-between items-center">
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
