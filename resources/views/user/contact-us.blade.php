<!-- Responsive Modern Contact Us Page (Quizify Style) -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Contact Us | Quizify</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/quizify-favicon.png') }}">

    <style>
        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fadeUp {
            animation: fadeUp .3s ease-out;
        }
    </style>
</head>

<body class="bg-green-100 min-h-screen flex flex-col">
    <!-- Navbar -->
    <x-user-nav />

    <!-- Main Section -->
    <main class="flex-grow flex flex-col items-center justify-center pt-24 pb-16 px-4 sm:px-6">
        <!-- Alert Messages -->
        @if (Session::has('success'))
            <div class="flex items-center bg-green-200 border border-green-400 text-green-800 px-4 py-3 sm:px-5 sm:py-4 rounded-lg shadow relative w-full max-w-md mb-6 transition-all duration-200 animate-fadeUp"
                role="alert">
                <span class="flex-1 text-sm sm:text-base leading-relaxed">
                    <strong class="font-semibold">Success!</strong>
                    <span class="block sm:inline">{{ Session::get('success') }}</span>
                </span>
                <button type="button" onclick="this.closest('div[role=alert]').remove()"
                    class="ml-4 text-green-600 hover:text-green-800 focus:outline-none">
                    ✕
                </button>
            </div>
        @elseif (Session::has('error'))
            <div class="flex items-center bg-red-200 border border-red-400 text-red-800 px-4 py-3 sm:px-5 sm:py-4 rounded-lg shadow relative w-full max-w-md mb-6 transition-all duration-200 animate-fadeUp"
                role="alert">
                <span class="flex-1 text-sm sm:text-base leading-relaxed">
                    <strong class="font-semibold">Error!</strong>
                    <span class="block sm:inline">{{ Session::get('error') }}</span>
                </span>
                <button type="button" onclick="this.closest('div[role=alert]').remove()"
                    class="ml-4 text-red-600 hover:text-red-800 focus:outline-none">
                    ✕
                </button>
            </div>
        @endif
        <div class="bg-white shadow-xl rounded-2xl p-6 sm:p-10 w-full max-w-2xl animate-fadeUp">
            <h1 class="text-center text-green-800 text-2xl sm:text-3xl font-bold mb-6">Contact Us</h1>
            <p class="text-center text-gray-600 mb-8 text-sm sm:text-base">Got a question or feedback? We'd love to hear
                from you! Fill out the form below and we will get back soon.</p>

            <form action="{{ route('user.contact.us.submit') }}" method="POST" class="space-y-5">
                @csrf

                <!-- Full Name -->
                <div>
                    <label class="block text-green-700 font-semibold mb-1">Full Name</label>
                    <input type="text" name="name" placeholder="Enter your full name"
                        value="{{ Session::has('user') ? Session::get('user')->name : old('name') }}"
                        class="w-full p-3 rounded-lg border
                   focus:border-green-500 focus:ring-2 focus:ring-green-200 outline-none shadow-sm">

                    @error('name')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label class="block text-green-700 font-semibold mb-1">Email Address</label>
                    <input type="email" name="email" placeholder="Enter your email"
                        value="{{ Session::has('user') ? Session::get('user')->email : old('email') }}"
                        class="w-full p-3 rounded-lg border 
                   focus:border-green-500 focus:ring-2 focus:ring-green-200 outline-none shadow-sm">

                    @error('email')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Message -->
                <div>
                    <label class="block text-green-700 font-semibold mb-1">Message</label>
                    <textarea name="message" rows="5" placeholder="Write your message..."
                        class="w-full p-3 rounded-lg border
                   focus:border-green-500 focus:ring-2 focus:ring-green-200 outline-none shadow-sm">{{ old('message') }}</textarea>

                    @error('message')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                @if (Session::has('user'))
                    <!-- Submit Button for Logged-in Users -->
                    <button type="submit"
                        class="w-full bg-green-600 text-white font-medium py-3 rounded-lg hover:bg-green-700 active:scale-95 transition-all">
                        Send Message
                    </button>
                @else
                    <!-- Disabled Button for Guests -->
                    <button type="button" disabled
                        class="w-full bg-gray-400 text-white font-medium py-3 rounded-lg cursor-not-allowed">
                        Login Required to Send Message
                    </button>

                    <!-- Login Message -->
                    <p class="text-center text-red-600 font-medium mt-3 text-sm sm:text-base">
                        Please <a href="{{ route('user.login.form.contact') }}"
                            class="underline text-green-700 font-semibold">
                            Login</a> or <a href="{{ route('user.signup.contact') }}"
                            class="underline text-green-700 font-semibold">
                            Signup</a> to contact us!
                    </p>
                @endif
            </form>

        </div>

        <!-- Contact Info + Google Map -->
        <div class="w-full max-w-4xl mt-10">
            <!-- Contact Info Cards -->
            <div
                class="grid grid-cols-1 sm:grid-cols-2 gap-6 text-center text-gray-700 text-sm sm:text-base mb-8 animate-fadeUp">
                <!-- Email Card -->
                <a href="mailto:support@quizify.com"
                    class="bg-white p-5 rounded-xl shadow hover:shadow-md transition flex flex-col items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-8 h-8 text-green-600">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21.75 6.75v10.125a2.625 2.625 0 01-2.625 2.625H4.875a2.625 2.625 0 01-2.625-2.625V6.75m19.5 0A2.625 2.625 0 0019.125 4.125H4.875A2.625 2.625 0 002.25 6.75m19.5 0l-9.75 6.375L2.25 6.75" />
                    </svg>
                    <p class="font-semibold text-green-700">Email Us</p>
                    <p class="underline">manasmondal035@gmail.com</p>
                </a>

                <!-- Phone Card -->
                <a href="tel:+916291083635"
                    class="bg-white p-5 rounded-xl shadow hover:shadow-md transition flex flex-col items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-8 h-8 text-green-600">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.25 6.75c0 8.284 6.716 15 15 15h1.125a2.625 2.625 0 002.625-2.625v-1.17a1.125 1.125 0 00-.852-1.092l-4.26-1.065a1.125 1.125 0 00-1.173.417l-.97 1.293a.75.75 0 01-.967.198 11.25 11.25 0 01-5.51-5.51.75.75 0 01.198-.967l1.293-.97a1.125 1.125 0 00.417-1.173L6.939 3.327A1.125 1.125 0 005.847 2.25H4.875A2.625 2.625 0 002.25 4.875v1.875z" />
                    </svg>
                    <p class="font-semibold text-green-700">Call Us</p>
                    <p class="underline">+91 629 108 3635</p>
                </a>
            </div>

            <!-- Social Icons -->
            <div class="flex justify-center gap-6 mb-10 animate-fadeUp">

                <a href="https://www.linkedin.com/posts/manas-mondal-7989a2306_laravel-aws-docker-activity-7416365322108096512-wxu1?utm_source=share&utm_medium=member_desktop&rcm=ACoAAE4Zx-QBO2oV_ff6YJHYEfsPt4UZXV4dUso"
                    target="_blank" class="text-green-700 hover:text-green-900 transition"
                    title="View project announcement on LinkedIn">
                    <i class="fab fa-linkedin text-2xl"></i>
                </a>

                <a href="https://github.com/manas-mondal/laravel-quiz-system" target="_blank"
                    class="text-green-700 hover:text-green-900 transition" title="Browse project source code">
                    <i class="fab fa-github text-2xl"></i>
                </a>

                <a href="https://youtu.be/I-iupeU_kzg?si=wlaIK2Y6ZTqBh7O8" target="_blank"
                    class="text-green-700 hover:text-green-900 transition"
                    title="Watch full project walkthrough on YouTube">
                    <i class="fab fa-youtube text-2xl"></i>
                </a>

            </div>

            <!-- Google Map -->
            <div class="w-full h-64 sm:h-80 rounded-xl overflow-hidden shadow-md animate-fadeUp">
                <iframe class="w-full h-full border-0"
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3683.8372612149996!2d88.363895!3d22.572646!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a0277bb1bdc0e17%3A0x9e90cfef2f2fdef3!2sKolkata%2C%20West%20Bengal!5e0!3m2!1sen!2sin!4v1730650091234"
                    loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <x-footer-user />
</body>

</html>
