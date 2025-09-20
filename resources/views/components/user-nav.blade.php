<nav class="fixed top-0 left-0 right-0 z-5 p-4 bg-white shadow-md flex justify-between items-center">
    <div class="text-2xl text-green-900 font-bold cursor-pointer">
        Quiz System
    </div>
    <div class="space-x-4">
        <a class="text-green-900 font-medium hover:text-blue-500" href="{{ route('welcome') }}">Home</a>
        <a class="text-green-900 font-medium hover:text-blue-500" href="{{ route('admin.categories') }}">Categories</a>
        <a class="text-green-900 font-medium hover:text-blue-500" href="{{ route('admin.logout') }}">Blog</a>
        @if (session()->has('user'))
            <a class="text-green-900 font-medium hover:text-blue-500" href="{{ route('user.signup.form') }}">Welcome,
                {{ session()->get('user')->name }}</a>
            <a class="text-green-900 font-medium hover:text-blue-500" href="{{ route('user.logout') }}">Logout</a>
        @else
            <a class="text-green-900 font-medium hover:text-blue-500" href="{{ route('user.signup.form') }}">Sign Up</a>
            <a class="text-green-900 font-medium hover:text-blue-500" href="{{ route('user.login.form') }}">Login</a>
        @endif
    </div>
</nav>
