<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Quiz Result</title>
    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-green-100 font-sans antialiased">

    <x-user-nav />

    <div class="min-h-screen flex flex-col items-center pt-24 pb-10 px-4 sm:px-6 lg:px-8">
        <!-- Alerts -->
        @if (Session::has('success'))
            <div class="flex items-center bg-green-200 border border-green-400 text-green-800 px-4 py-3 rounded-xl shadow max-w-lg w-full mb-6"
                role="alert">
                <div class="flex-1">
                    <strong class="font-semibold">Success!</strong>
                    <span class="block sm:inline">{{ Session::get('success') }}</span>
                </div>
                <button onclick="this.closest('div[role=alert]').remove()"
                    class="ml-3 text-green-700 hover:text-green-900 focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        @elseif (Session::has('error'))
            <div class="flex items-center bg-red-200 border border-red-400 text-red-800 px-4 py-3 rounded-xl shadow max-w-lg w-full mb-6"
                role="alert">
                <div class="flex-1">
                    <strong class="font-semibold">Error!</strong>
                    <span class="block sm:inline">{{ Session::get('error') }}</span>
                </div>
                <button onclick="this.closest('div[role=alert]').remove()"
                    class="ml-3 text-red-700 hover:text-red-900 focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        @endif

        <!-- Result Summary Card -->
        <div class="bg-white p-8 rounded-3xl shadow-lg w-full max-w-2xl text-center">
            <h2 class="text-3xl font-bold text-green-800 mb-3">
                Result for <span class="text-yellow-600">{{ $quiz_name }}</span>
            </h2>
            <h3 class="text-xl font-semibold text-green-600">
                You got <span class="text-green-700 font-bold">{{ $correctAnswers }}</span> out of
                <span class="font-bold">{{ $totalQuestions }}</span> correct!
            </h3>
        </div>

        <!-- Table Section -->
        <div class="w-full max-w-5xl mt-10 shadow-md overflow-x-auto">
            <table class="min-w-full bg-white rounded-2xl shadow-md text-sm sm:text-base">
                <thead>
                    <tr class="bg-green-200 text-green-800">
                        <th class="px-4 py-3 text-left font-semibold">SL. No.</th>
                        <th class="px-4 py-3 text-left font-semibold">Question</th>
                        <th class="px-4 py-3 text-left font-semibold">Selected Option</th>
                        <th class="px-4 py-3 text-left font-semibold">Result</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-green-100">
                    @foreach ($resultData as $key => $result)
                        <tr class="{{ $loop->even ? 'bg-green-50' : 'bg-white' }} hover:bg-green-100 transition">
                            <td class="px-4 py-3 text-gray-700">{{ $key + 1 }}</td>
                            <td class="px-4 py-3 text-gray-700">{{ $result->mcq->question }}</td>
                            <td class="px-4 py-3 text-gray-700">
                                @switch($result->selected_answer)
                                    @case('option_a')
                                        A
                                    @break

                                    @case('option_b')
                                        B
                                    @break

                                    @case('option_c')
                                        C
                                    @break

                                    @case('option_d')
                                        D
                                    @break

                                    @default
                                        N/A
                                @endswitch
                            </td>
                            <td class="px-4 py-3 font-semibold">
                                @if ($result->is_correct == 1)
                                    <span class="text-green-600 bg-green-100 px-3 py-1 rounded-full">Correct</span>
                                @else
                                    <span class="text-red-600 bg-red-100 px-3 py-1 rounded-full">Incorrect</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Action Buttons -->
        <div class="mt-10 flex flex-col sm:flex-row gap-4">
            <a href="{{ route('welcome') }}"
                class="bg-green-500 text-white px-6 py-2 rounded-xl shadow-md hover:bg-green-600 transition text-center">
                Back to Dashboard
            </a>
            <a href="{{ route('user.all.quizzes') }}"
                class="bg-yellow-400 text-yellow-900 px-6 py-2 rounded-xl shadow-md hover:bg-yellow-500 transition text-center">
                Try Another Quiz
            </a>
        </div>
    </div>

    <x-footer-user />

</body>

</html>
