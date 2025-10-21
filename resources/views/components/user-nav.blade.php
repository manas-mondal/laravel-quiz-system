<nav class="fixed top-0 left-0 right-0 z-50 p-4 bg-white shadow-md flex justify-between items-center">
    <!-- Logo / Brand -->
    <div class="text-2xl text-green-900 font-bold cursor-pointer">
        <a href="{{ route('welcome') }}">Quiz System</a>
    </div>

    <!-- Hamburger button (mobile only) -->
    <button id="menu-toggle" class="md:hidden text-green-900 focus:outline-none" aria-label="Open Menu">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"
            stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
    </button>

    <!-- Desktop navigation links -->
    <div class="hidden md:flex md:space-x-4 md:items-center">
        <a class="text-green-900 font-medium hover:text-blue-500" href="{{ route('welcome') }}">Home</a>
        <a class="text-green-900 font-medium hover:text-blue-500" href="{{ route('user.all.quizzes') }}">Quizzes</a>
        <a class="text-green-900 font-medium hover:text-blue-500" href="#">Blog</a>

        @if (session()->has('user'))
            <a class="text-green-900 font-medium hover:text-blue-500" href="{{ route('user.details') }}">
                Welcome, {{ session()->get('user')->name }}
            </a>
            <a class="text-green-900 font-medium hover:text-blue-500" href="{{ route('user.logout') }}">Logout</a>
        @else
            <a class="text-green-900 font-medium hover:text-blue-500" href="{{ route('user.signup.form') }}">Sign Up</a>
            <a class="text-green-900 font-medium hover:text-blue-500" href="{{ route('user.login.form') }}">Login</a>
        @endif
    </div>

    <!-- Off-canvas Right-side Menu (Mobile) -->
    <div id="menu"
        class="fixed top-0 right-0 h-screen w-48 bg-white shadow-xl transform translate-x-full transition-transform duration-300 md:hidden flex flex-col p-6 space-y-3 z-50">

        <!-- Close button -->
        <button id="menu-close" class="self-end text-green-900 focus:outline-none mb-4" aria-label="Close Menu">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>

        <!-- Links -->
        <a href="{{ route('welcome') }}"
            class="block text-green-900 text-center font-semibold bg-green-100 rounded-lg px-4 py-2 hover:bg-green-200 hover:text-green-900 transition-all">
            Home
        </a>
        <a href="{{ route('user.all.quizzes') }}"
            class="block text-green-900 text-center font-semibold bg-green-100 rounded-lg px-4 py-2 hover:bg-green-200 hover:text-green-900 transition-all">
            Quizzes
        </a>
        <a href="#"
            class="block text-green-900 text-center font-semibold bg-green-100 rounded-lg px-4 py-2 hover:bg-green-200 hover:text-green-900 transition-all">
            Blog
        </a>

        @if (session()->has('user'))
            <a href="{{ route('user.details') }}"
                class="block text-green-900 text-center font-semibold bg-green-100 rounded-lg px-4 py-2 hover:bg-green-200 hover:text-green-900 transition-all">
                Welcome, {{ session()->get('user')->name }}
            </a>
            <a href="{{ route('user.logout') }}"
                class="block text-green-900 text-center font-semibold bg-green-100 rounded-lg px-4 py-2 hover:bg-green-200 hover:text-green-900 transition-all">
                Logout
            </a>
        @else
            <a href="{{ route('user.signup.form') }}"
                class="block text-green-900 text-center font-semibold bg-green-100 rounded-lg px-4 py-2 hover:bg-green-200 hover:text-green-900 transition-all">
                Sign Up
            </a>
            <a href="{{ route('user.login.form') }}"
                class="block text-green-900 text-center font-semibold bg-green-100 rounded-lg px-4 py-2 hover:bg-green-200 hover:text-green-900 transition-all">
                Login
            </a>
        @endif
    </div>
</nav>


<!-- JS for toggle -->
<script>
    const menuBtn = document.getElementById('menu-toggle');
    const menu = document.getElementById('menu');
    const menuClose = document.getElementById('menu-close');

    // Open menu
    menuBtn.addEventListener('click', () => {
        menu.classList.remove('translate-x-full');
        menu.classList.add('translate-x-0');
    });

    // Close menu (X button)
    menuClose.addEventListener('click', () => {
        menu.classList.remove('translate-x-0');
        menu.classList.add('translate-x-full');
    });

    // Optional: close menu when a link is clicked
    menu.querySelectorAll('a').forEach(link => {
        link.addEventListener('click', () => {
            menu.classList.remove('translate-x-0');
            menu.classList.add('translate-x-full');
        });
    });

    // Optional: close menu on Escape key
    document.addEventListener('keydown', (e) => {
        if (e.key === "Escape" && menu.classList.contains('translate-x-0')) {
            menu.classList.remove('translate-x-0');
            menu.classList.add('translate-x-full');
        }
    });
</script>
