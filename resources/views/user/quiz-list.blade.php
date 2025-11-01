<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Category : {{ $category }}</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/quizify-favicon.png') }}">

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- @vite('resources/css/app.css') --}}
</head>

<body class="bg-green-100 min-h-screen flex flex-col">
    <!-- Navbar -->
    <x-user-nav />

    <!-- Main Content -->
    <main class="flex-grow flex flex-col items-center pt-24 pb-10 px-4 sm:px-6 lg:px-8 w-full">
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

        <!-- Category Header -->
        <div class="bg-white p-6 sm:p-8 rounded-2xl shadow-md w-full max-w-md text-center">
            <h2 class="text-lg sm:text-2xl font-bold text-green-800 break-words">
                Category: {{ $category }}
            </h2>
        </div>

        <!-- Quiz Table -->
        <div class="w-full max-w-5xl mt-8 overflow-x-auto rounded-xl shadow-md bg-white">
            <table class="min-w-full divide-y divide-green-200 text-sm sm:text-base">
                <thead class="bg-green-200">
                    <tr>
                        <th class="px-4 py-3 text-left text-green-700 font-semibold whitespace-nowrap">SL. No.</th>
                        <th class="px-4 py-3 text-left text-green-700 font-semibold whitespace-nowrap">Name</th>
                        <th class="px-4 py-3 text-left text-green-700 font-semibold whitespace-nowrap">Total MCQ</th>
                        <th class="px-4 py-3 text-left text-green-700 font-semibold whitespace-nowrap">Attempt Quiz</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-green-100">
                    @foreach ($quizzes as $key => $quiz)
                        <tr class="{{ $loop->even ? 'bg-blue-50' : 'bg-white' }} hover:bg-green-50 transition-colors">
                            <td class="px-4 py-3 text-gray-700 whitespace-nowrap">
                                {{ $key + $quizzes->firstItem() }}
                            </td>
                            <td class="px-4 py-3 text-gray-700 break-words">
                                {{ $quiz->name }}
                            </td>
                            <td class="px-4 py-3 text-gray-700 whitespace-nowrap">
                                {{ $quiz->mcqs->count() }}
                            </td>
                            <td class="px-4 py-3 text-center sm:text-left whitespace-nowrap">
                                <a href="{{ route('user.quiz.start', ['id' => $quiz->id, 'quiz_name' => str_replace(' ', '-', $quiz->name)]) }}"
                                    class="inline-block bg-green-500 text-white font-medium text-xs sm:text-sm md:text-base px-4 py-2 sm:px-6 sm:py-2.5 rounded-lg hover:bg-green-600 active:scale-95 transition w-full sm:w-auto text-center shadow-sm">
                                    Start Quiz
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="mt-4 px-4 pb-4 text-center">
                {{ $quizzes->links() }}
            </div>
        </div>
    </main>

    <!-- Footer -->
    <x-footer-user />
</body>

</html>
