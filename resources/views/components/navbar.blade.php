<nav class="fixed top-0 left-0 right-0 z-5 p-4 bg-white shadow-md flex justify-between items-center">
    <div class="text-2xl font-bold cursor-pointer">
        <a href="{{ route('dashboard') }}">Quiz System</a>
    </div>
    <div class="space-x-4">
        <a class="text-gray-700 font-medium hover:text-blue-500" href="{{ route('dashboard') }}">Dashboard</a>
        <a class="text-gray-700 font-medium hover:text-blue-500" href="{{ route('admin.categories') }}">Categories</a>
        <a class="text-gray-700 font-medium hover:text-blue-500" href="{{ route('admin.quiz.form') }}">Quiz</a>
        <a class="text-gray-700 font-medium hover:text-blue-500" href="">Welcome {{ $admin->name }}</a>
        <a class="text-gray-700 font-medium hover:text-blue-500" href="{{ route('admin.logout') }}">Logout</a>
    </div>
</nav>
