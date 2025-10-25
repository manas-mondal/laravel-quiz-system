<nav class="fixed top-0 left-0 right-0 z-50 p-4 bg-white shadow-md flex justify-between items-center">
    <!-- Brand -->
    <div class="text-2xl sm:text-3xl font-bold cursor-pointer">
        <a href="{{ route('dashboard') }}">Quiz System</a>
    </div>

    <!-- Hamburger for Mobile -->
    <button id="admin-menu-toggle" class="md:hidden text-gray-700 focus:outline-none p-2" aria-label="Open Menu">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"
            stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
    </button>

    <!-- Desktop Menu -->
    <div class="hidden md:flex items-center space-x-6">
        <a class="{{ request()->routeIs('dashboard') ? 'text-blue-700 font-semibold' : 'text-gray-700 font-medium hover:text-blue-500' }}"
            href="{{ route('dashboard') }}">Dashboard</a>

        <a class="{{ request()->routeIs('admin.categories') ? 'text-blue-700 font-semibold' : 'text-gray-700 font-medium hover:text-blue-500' }}"
            href="{{ route('admin.categories') }}">Categories</a>

        <a class="{{ request()->routeIs('admin.quiz.form') ? 'text-blue-700 font-semibold' : 'text-gray-700 font-medium hover:text-blue-500' }}"
            href="{{ route('admin.quiz.form') }}">Quiz</a>

        <span class="text-gray-600 font-medium">Welcome {{ $admin->name }}</span>

        <a class="text-gray-700 font-medium hover:text-red-500" href="{{ route('admin.logout') }}">Logout</a>
    </div>

    <!-- Backdrop -->
    <div id="admin-menu-backdrop"
        class="fixed inset-0 bg-black/40 hidden opacity-0 transition-opacity duration-300 md:hidden z-40">
    </div>

    <!-- Mobile Drawer -->
    <div id="admin-menu"
        class="fixed top-0 right-0 h-screen w-52 sm:w-60 bg-white shadow-2xl transform translate-x-full transition-transform duration-300 ease-in-out md:hidden flex flex-col p-6 space-y-3 z-50 rounded-l-2xl">

        <!-- Close Button -->
        <button id="admin-menu-close" class="self-end text-gray-700 mb-4" aria-label="Close Menu">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>

        <!-- Mobile Menu Items -->
        <a href="{{ route('dashboard') }}"
            class="block text-center font-medium rounded-xl px-4 py-3 bg-blue-100 {{ request()->routeIs('dashboard') ? 'text-blue-800 font-semibold bg-blue-300' : 'text-gray-700 hover:text-blue-500 hover:bg-blue-200' }}">
            Dashboard
        </a>

        <a href="{{ route('admin.categories') }}"
            class="block text-center font-medium rounded-xl px-4 py-3 bg-blue-100 {{ request()->routeIs('admin.categories') ? 'text-blue-800 font-semibold bg-blue-300' : 'text-gray-700 hover:text-blue-500 hover:bg-blue-200' }}">
            Categories
        </a>

        <a href="{{ route('admin.quiz.form') }}"
            class="block text-center font-medium rounded-xl px-4 py-3 bg-blue-100 {{ request()->routeIs('admin.quiz.form') ? 'text-blue-800 font-semibold bg-blue-300' : 'text-gray-700 hover:text-blue-500 hover:bg-blue-200' }} ">
            Quiz
        </a>

        <span class="block text-center font-medium text-gray-600 ">Welcome
            {{ $admin->name }}</span>

        <a href="{{ route('admin.logout') }}"
            class="block text-center font-medium rounded-xl px-4 py-3 bg-red-100 text-gray-700 hover:text-red-500 hover:bg-red-200">
            Logout
        </a>
    </div>
</nav>

<script>
    const toggle = document.getElementById('admin-menu-toggle');
    const closeBtn = document.getElementById('admin-menu-close');
    const menu = document.getElementById('admin-menu');
    const backdrop = document.getElementById('admin-menu-backdrop');

    const openMenu = () => {
        menu.classList.remove('translate-x-full');
        backdrop.classList.remove('hidden');
        setTimeout(() => backdrop.classList.add('opacity-100'), 10);
    };

    const closeMenu = () => {
        menu.classList.add('translate-x-full');
        backdrop.classList.remove('opacity-100');
        setTimeout(() => backdrop.classList.add('hidden'), 300);
    };

    toggle.addEventListener('click', openMenu);
    closeBtn.addEventListener('click', closeMenu);
    backdrop.addEventListener('click', closeMenu);

    menu.querySelectorAll('a').forEach(link => link.addEventListener('click', closeMenu));
</script>
