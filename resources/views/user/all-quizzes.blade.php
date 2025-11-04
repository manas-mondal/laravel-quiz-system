<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Quizzes</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/quizify-favicon.png') }}">

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- @vite('resources/css/app.css') --}}
    <!-- Smooth animations -->
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

    <!-- Main Content -->
    <div class="pt-24 pb-10 flex flex-col items-center w-full px-4 sm:px-6 lg:px-8">

        <!-- Alert Messages -->
        @if (Session::has('success'))
            <div class="flex items-center bg-green-200 border border-green-400 text-green-800 px-4 py-3 sm:px-5 sm:py-4 rounded-2xl shadow relative max-w-md mx-auto mb-6 transition-all duration-200 animate-fadeUp"
                role="alert">
                <span class="flex-1">
                    <strong class="font-semibold">Success!</strong>
                    <span class="block sm:inline"> {{ Session::get('success') }} </span>
                </span>
                <button type="button" onclick="this.closest('div[role=alert]').remove()"
                    class="ml-4 text-green-600 hover:text-green-800 focus:outline-none">
                    ✕
                </button>
            </div>
        @elseif (Session::has('error'))
            <div class="flex items-center bg-red-200 border border-red-400 text-red-800 px-4 py-3 sm:px-5 sm:py-4 rounded-2xl shadow relative max-w-md mx-auto mb-6 transition-all duration-200 animate-fadeUp"
                role="alert">
                <span class="flex-1">
                    <strong class="font-semibold">Error!</strong>
                    <span class="block sm:inline"> {{ Session::get('error') }} </span>
                </span>
                <button type="button" onclick="this.closest('div[role=alert]').remove()"
                    class="ml-4 text-red-600 hover:text-red-800 focus:outline-none">
                    ✕
                </button>
            </div>
        @endif

        <!-- Page Heading -->
        <h1
            class="text-3xl sm:text-4xl md:text-5xl font-bold text-green-900 text-center leading-tight mb-10 animate-fadeUp">
            Explore Quizzes
        </h1>

        <!-- Search Box -->
        <div class="w-full flex justify-center max-w-md mb-20 animate-fadeUp">
            <form action="{{ route('user.all.quizzes') }}" method="GET" class="relative w-full flex items-center">
                <input
                    class="w-full px-4 py-3 sm:py-3.5 shadow-sm text-gray-700 border border-green-300 rounded-2xl focus:border-green-500 focus:ring-2 focus:ring-green-200 outline-none text-base sm:text-lg transition"
                    type="text" name="search" placeholder="Search quiz..." value="{{ request('search') }}">
                <button type="submit"
                    class="absolute right-3 flex items-center justify-center text-green-600 hover:text-green-800 focus:outline-none h-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 sm:h-6 sm:w-6" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </button>
            </form>
        </div>


        <!-- Top Quizzes Heading -->
        <div class="w-full max-w-3xl mb-4 animate-fadeUp">
            <h2 class="text-lg sm:text-xl text-green-700 font-bold text-center sm:text-left">
                Top Quizzes
            </h2>
        </div>

        <!-- Quizzes Table -->
        <div class="w-full max-w-5xl overflow-x-auto rounded-2xl shadow-md bg-white animate-fadeUp">
            <table class="min-w-full divide-y divide-green-200 text-sm sm:text-base">
                <thead class="bg-green-200">
                    <tr>
                        <th class="px-4 py-3 text-left text-green-700 font-semibold whitespace-nowrap">SL.No</th>
                        <th class="px-4 py-3 text-left text-green-700 font-semibold whitespace-nowrap">Quiz Name</th>
                        <th class="px-4 py-3 text-left text-green-700 font-semibold whitespace-nowrap">Category</th>
                        <th class="px-2 py-3 text-left text-green-700 font-semibold whitespace-nowrap">Total Mcq</th>
                        <th class="px-4 py-3 text-left text-green-700 font-semibold whitespace-nowrap">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($quizzes as $key => $quiz)
                        <tr class="{{ $loop->even ? 'bg-green-50' : 'bg-white' }} hover:bg-green-100 transition-colors">
                            <td class="px-4 py-3 text-gray-600 whitespace-nowrap">{{ $key + $quizzes->firstItem() }}
                            </td>
                            <td class="px-4 py-3 text-gray-600 break-words">{{ $quiz->name }}</td>
                            <td class="px-4 py-3 text-gray-600 whitespace-nowrap">{{ $quiz->category->name ?? 'N/A' }}
                            </td>
                            <td class="px-2 py-3 text-gray-600 whitespace-nowrap">{{ $quiz->mcqs_count }}</td>
                            <td class="px-4 py-3 text-center sm:text-left whitespace-nowrap">
                                <a href="{{ route('user.quiz.start', ['id' => $quiz->id, 'quiz_name' => str_replace(' ', '-', $quiz->name)]) }}"
                                    class="inline-block w-full sm:w-auto bg-green-500 text-white text-sm sm:text-base px-4 py-2 rounded-2xl shadow-md hover:bg-green-600 active:scale-95 transition text-center">
                                    Start Quiz
                                </a>
                            </td>
                        </tr>
                    @endforeach

                    @if ($quizzes->isEmpty())
                        <tr>
                            <td colspan="5" class="px-4 py-4 text-center text-gray-600">
                                No quizzes found for "{{ request('search') }}"
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="mt-4 px-4 pb-4 text-center">
                {{ $quizzes->links() }}
            </div>
        </div>
    </div>

    <!-- Footer -->
    <x-footer-user />

</body>

</html>
