<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Start Quiz</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/quizify-favicon.png') }}">

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-green-50 text-gray-800">
    <!-- Navbar -->
    <x-user-nav />

    <!-- Main Content -->
    <div class="min-h-screen flex flex-col items-center pt-24 pb-8 px-4 sm:px-6 lg:px-8">

        <!-- Alert Messages -->
        @if (Session::has('success'))
            <div class="flex items-center bg-green-200 border border-green-400 text-green-800 px-4 py-3 sm:px-5 sm:py-4 rounded-lg shadow relative w-full max-w-md mb-6 transition-all duration-200"
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
            <div class="flex items-center bg-red-200 border border-red-400 text-red-800 px-4 py-3 sm:px-5 sm:py-4 rounded-lg shadow relative w-full max-w-md mb-6 transition-all duration-200"
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

        <!-- Quiz Header Card -->
        <div class="bg-white p-6 sm:p-8 rounded-2xl shadow-md w-full text-center max-w-md">
            <h2 class="text-xl sm:text-2xl font-bold text-green-800 tracking-wide">{{ $quiz_name }}</h2>
            <p class="text-gray-600 mt-2 text-sm sm:text-base">Get ready to test your knowledge!</p>
        </div>

        <!-- Premium Certificate Banner -->
        <div
            class="bg-yellow-500 text-white font-semibold text-center mt-4 px-4 py-2 rounded-full shadow-md max-w-md w-full flex items-center justify-center gap-2 animate-pulse">
            <img src="{{ asset('images/gold-badge.png') }}" class="h-5 w-5 block" alt="Badge">
            <p>Score <span class="font-bold">70%+</span> to earn a Verified Certificate 🏅</p>
        </div>

        <!-- Instructions Card -->
        <div class="bg-white p-6 sm:p-8 rounded-2xl shadow-md w-full max-w-md mt-6 mb-6">
            <h3 class="text-lg sm:text-xl font-semibold mb-4 text-green-700">Quiz Instructions:</h3>
            <ul class="list-disc list-inside text-gray-700 space-y-2 text-sm sm:text-base leading-relaxed">
                <li>Total Questions: <span class="font-medium">{{ $mcqs->count() }}</span></li>
                <li>Time Limit: <span class="font-medium">No</span></li>
                <li>Each question carries equal marks.</li>
                <li>No negative marking for wrong answers.</li>
                <li>Read each question carefully before answering.</li>
            </ul>

            <!-- Buttons Section -->
            <div class="mt-8 text-center flex flex-col sm:flex-row sm:justify-center gap-4 sm:gap-6">
                @if (session()->has('user'))
                    <a href="{{ route('user.mcq', ['id' => Session('first_mcq')->id, str_replace(' ', '-', $quiz_name)]) }}"
                        class="inline-block w-full sm:w-auto bg-green-600 text-white font-medium text-sm sm:text-base md:text-lg px-6 py-3 rounded-full hover:bg-green-700 active:scale-95 transition-all shadow-md focus:ring-2 focus:ring-green-400">
                        Start Quiz
                    </a>
                @else
                    <a href="{{ route('user.signup.quiz') }}"
                        class="w-full sm:w-auto bg-green-600 text-white font-medium text-sm sm:text-base md:text-lg px-6 py-3 rounded-full hover:bg-green-700 active:scale-95 transition-all shadow-md focus:ring-2 focus:ring-green-400">
                        Sign Up to Start Quiz
                    </a>

                    <a href="{{ route('user.login.form.quiz') }}"
                        class="w-full sm:w-auto bg-blue-600 text-white font-medium text-sm sm:text-base md:text-lg px-6 py-3 rounded-full hover:bg-blue-700 active:scale-95 transition-all shadow-md focus:ring-2 focus:ring-blue-400">
                        Login to Start Quiz
                    </a>
                @endif
            </div>

        </div>
    </div>

    <!-- Footer -->
    <x-footer-user />
</body>

</html>
