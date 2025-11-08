<nav
    class="fixed top-0 left-0 right-0 z-50 px-4 sm:px-6 py-3 bg-white/90 shadow-md flex justify-between items-center transition-all duration-300">
    <!-- Logo / Brand -->
    {{-- <div class="text-2xl sm:text-3xl text-green-900 font-bold cursor-pointer">
        <a href="{{ route('welcome') }}"><img src="{{ asset('images/quiz-logo.png') }}" alt=""></a>
    </div> --}}
    <!-- Logo / Brand -->
    <div class="flex items-center">
        <a href="{{ route('welcome') }}">
            <img src="{{ asset('images/quiz-logo.png') }}" alt="Quiz System Logo"
                class=" h-10 sm:h-12 w-auto object-contain cursor-pointer" />
        </a>
    </div>


    <!-- Hamburger button (mobile only) -->
    <button id="menu-toggle"
        class="md:hidden text-green-900 focus:outline-none focus:ring-2 focus:ring-green-300 p-2 rounded-lg"
        aria-label="Open Menu">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"
            stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
    </button>

    <!-- Desktop navigation links -->
    <div class="hidden md:flex md:space-x-6 md:items-center">
        <a class="{{ request()->routeIs('welcome') ? 'text-white font-semibold py-0.5 px-4 bg-green-500 rounded-md shadow-md' : 'text-green-900 font-medium hover:text-blue-600 hover:font-bold transition-colors' }}"
            href="{{ route('welcome') }}">Home</a>
        <a class="{{ request()->routeIs('user.all.quizzes') ? 'text-white font-semibold py-0.5 px-4 bg-green-500 rounded-md shadow-md' : 'text-green-900 font-medium hover:text-blue-600 hover:font-bold transition-colors' }}"
            href="{{ route('user.all.quizzes') }}">Quizzes</a>
        <a class="{{ request()->routeIs('user.certificate.verify.form') ? 'text-white font-semibold py-0.5 px-4 bg-green-500 rounded-md shadow-md' : 'text-green-900 font-medium hover:text-blue-600 hover:font-bold transition-colors' }}"
            href="{{ route('user.certificate.verify.form') }}">Verify Certificate</a>
        <a class="{{ request()->routeIs('user.contact.us.form') ? 'text-white font-semibold py-0.5 px-4 bg-green-500 rounded-md shadow-md' : 'text-green-900 font-medium hover:text-blue-600 hover:font-bold transition-colors' }}"
            href="{{ route('user.contact.us.form') }}">Contact Us</a>

        @if (session()->has('user'))
            <a class="{{ request()->routeIs('user.details') ? 'underline text-green-900 font-bold' : 'text-green-900 font-medium hover:text-blue-600 hover:font-bold transition-colors' }}"
                href="{{ route('user.details') }}">
                Welcome, {{ session()->get('user')->name }}
            </a>
            <a class="{{ request()->routeIs('user.logout') ? 'text-white font-semibold py-0.5 px-4 bg-green-500 rounded-md shadow-md' : 'text-green-900 font-medium hover:font-bold hover:text-red-600 transition-colors' }}"
                href="{{ route('user.logout') }}">Logout</a>
        @else
            <a class="{{ request()->routeIs('user.signup.form') ? 'text-white font-semibold py-0.5 px-4 bg-green-500 rounded-md shadow-md' : 'text-green-900 font-medium hover:font-bold hover:text-blue-600 transition-colors' }}"
                href="{{ route('user.signup.form') }}">Sign Up</a>
            <a class="{{ request()->routeIs('user.login.form') ? 'text-white font-semibold py-0.5 px-4 bg-green-500 rounded-md shadow-md' : 'text-green-900 font-medium hover:font-bold hover:text-blue-600 transition-colors' }}"
                href="{{ route('user.login.form') }}">Login</a>
        @endif
    </div>

    <!-- Backdrop (for mobile when menu open) -->
    <div id="menu-backdrop"
        class="fixed inset-0 bg-black/40 hidden opacity-0 transition-opacity duration-300 md:hidden z-40"></div>

    <!-- Off-canvas Right-side Menu (Mobile) -->
    <div id="menu"
        class="fixed top-0 right-0 h-screen w-52 sm:w-60 bg-white shadow-2xl transform translate-x-full transition-transform duration-300 ease-in-out md:hidden flex flex-col p-6 space-y-3 z-50 rounded-l-2xl overflow-y-auto">

        <!-- Close button -->
        <button id="menu-close"
            class="self-end text-green-900 focus:outline-none mb-5 p-2 hover:bg-green-100 rounded-lg"
            aria-label="Close Menu">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>

        <!-- Links -->
        <a href="{{ route('welcome') }}"
            class="block {{ request()->routeIs('welcome') ? 'text-white font-bold bg-green-500 text-center rounded-md px-4 py-2' : 'text-green-900 text-center font-semibold bg-green-100 rounded-xl px-4 py-2 hover:bg-green-200 hover:text-green-900 transition-all' }}">
            Home
        </a>
        <a href="{{ route('user.all.quizzes') }}"
            class="block {{ request()->routeIs('user.all.quizzes') ? 'text-white font-bold bg-green-500 text-center rounded-md px-4 py-2' : 'text-green-900 text-center font-semibold bg-green-100 rounded-xl px-4 py-2 hover:bg-green-200 hover:text-green-900 transition-all' }}">
            Quizzes
        </a>
        <a href="{{ route('user.certificate.verify.form') }}"
            class="block {{ request()->routeIs('user.certificate.verify.form') ? 'text-white font-bold bg-green-500 text-center rounded-md px-4 py-2' : 'text-green-900 text-center font-semibold bg-green-100 rounded-xl px-4 py-2 hover:bg-green-200 hover:text-green-900 transition-all' }}">
            Verify Certificate
        </a>
        <a href="{{ route('user.contact.us.form') }}"
            class="block {{ request()->routeIs('user.contact.us.form') ? 'text-white font-bold bg-green-500 text-center rounded-md px-4 py-2' : 'text-green-900 text-center font-semibold bg-green-100 rounded-xl px-4 py-2 hover:bg-green-200 hover:text-green-900 transition-all' }}">
            Contact Us
        </a>

        @if (session()->has('user'))
            <a href="{{ route('user.details') }}"
                class="block {{ request()->routeIs('user.details') ? 'text-green-900 text-center font-bold underline' : 'text-green-900 text-center font-semibold hover:text-blue-900 transition-all' }}">
                Welcome, {{ session()->get('user')->name }}
            </a>
            <a href="{{ route('user.logout') }}"
                class="block text-red-900 text-center font-semibold bg-red-100 rounded-xl px-4 py-2 hover:bg-red-200 hover:text-red-900 transition-all">
                Logout
            </a>
        @else
            <a href="{{ route('user.signup.form') }}"
                class="block {{ request()->routeIs('user.signup.form') ? 'text-white font-bold bg-green-500 text-center rounded-md px-4 py-2' : 'text-green-900 text-center font-semibold bg-green-100 rounded-xl px-4 py-2 hover:bg-green-200 hover:text-green-900 transition-all' }}">
                Sign Up
            </a>
            <a href="{{ route('user.login.form') }}"
                class="block {{ request()->routeIs('user.login.form') ? 'text-white font-bold bg-green-500 text-center rounded-md px-4 py-2' : 'text-green-900 text-center font-semibold bg-green-100 rounded-xl px-4 py-2 hover:bg-green-200 hover:text-green-900 transition-all' }}">
                Login
            </a>
        @endif
    </div>
</nav>

<!-- JS for mobile menu toggle -->
<script>
    // 1 Get all required DOM elements
    const menuBtn = document.getElementById('menu-toggle'); // The hamburger button that opens the menu
    const menu = document.getElementById('menu'); // The mobile side menu (drawer)
    const menuClose = document.getElementById('menu-close'); // The close (X) button inside the menu
    const backdrop = document.getElementById('menu-backdrop'); // The dark overlay that appears behind the menu

    // 2 Function to open the menu
    const openMenu = () => {
        menu.classList.remove('translate-x-full'); // Move the menu into view from the right
        menu.classList.add('translate-x-0'); // Set menu position to visible
        backdrop.classList.remove('hidden'); // Show the dark overlay (backdrop)
        setTimeout(() => backdrop.classList.add('opacity-100'), 10); // Add fade-in effect for smooth transition
    };

    // 3 Function to close the menu
    const closeMenu = () => {
        menu.classList.remove('translate-x-0'); // Start hiding the menu
        menu.classList.add('translate-x-full'); // Move the menu out of the screen to the right
        backdrop.classList.remove('opacity-100'); // Start fading out the backdrop
        setTimeout(() => backdrop.classList.add('hidden'), 300); // Fully hide the backdrop after animation ends
    };

    // 4 Add event listeners

    // Open the menu when the hamburger button is clicked
    menuBtn.addEventListener('click', openMenu);

    // Close the menu when the close (X) button is clicked
    menuClose.addEventListener('click', closeMenu);

    // Close the menu when clicking on the dark background (backdrop)
    backdrop.addEventListener('click', closeMenu);

    // Close the menu when clicking any link inside the menu
    menu.querySelectorAll('a').forEach(link => {
        link.addEventListener('click', closeMenu);
    });

    // Close the menu when the Escape key is pressed
    document.addEventListener('keydown', e => {
        if (e.key === "Escape" && menu.classList.contains('translate-x-0')) closeMenu();
    });
</script>
