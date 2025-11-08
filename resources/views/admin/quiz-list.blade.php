<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Quiz</title>
    <script src="https://cdn.tailwindcss.com"></script>
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

<body class="bg-gray-100">
    <x-navbar :admin="$admin" />

    <!-- Alerts -->
    <div class="max-w-md mx-auto mt-24 px-4">
        @if (Session::has('success'))
            <div class="flex items-center bg-green-200 border border-green-400 text-green-800 px-4 py-3 rounded-lg shadow relative animate-fadeUp"
                role="alert">
                <span class="flex-1">
                    <strong class="font-semibold">Success!</strong>
                    <span class="block sm:inline">{{ Session::get('success') }}</span>
                </span>
                <button type="button" onclick="this.closest('div[role=alert]').remove()"
                    class="ml-4 text-green-600 hover:text-green-800 hover:font-bold focus:outline-none">
                    ✕
                </button>
            </div>
        @elseif (Session::has('error'))
            <div class="flex items-center bg-red-200 border border-red-400 text-red-800 px-4 py-3 rounded-lg shadow relative animate-fadeUp"
                role="alert">
                <span class="flex-1">
                    <strong class="font-semibold">Error!</strong>
                    <span class="block sm:inline">{{ Session::get('error') }}</span>
                </span>
                <button type="button" onclick="this.closest('div[role=alert]').remove()"
                    class="ml-4 text-red-600 hover:text-red-800 hover:font-bold focus:outline-none">
                    ✕
                </button>
            </div>
        @endif
    </div>

    <!-- Category Header -->
    <div class="flex justify-center mt-6 px-4 animate-fadeUp">
        <div class="bg-white p-6 rounded-2xl shadow-md w-full max-w-lg text-center">
            <h2 class="text-xl font-semibold text-gray-800">
                Category: {{ $category }}
            </h2>

            <!-- Quiz Count Display -->
            <p class="text-gray-600 text-sm mt-2">
                Total Quizzes: {{ count($quizzes) }}
            </p>

            <a href="{{ route('admin.categories') }}" class="text-blue-500 hover:underline text-sm mt-3 inline-block">
                Back
            </a>
        </div>
    </div>


    <!-- Table Section -->
    <div class="max-w-4xl mx-auto mt-10 mb-10 px-4 animate-fadeUp">
        <div class="overflow-x-auto rounded-xl shadow-md">
            <table class="min-w-full bg-white">
                <thead class="bg-blue-100 text-gray-700 text-left">
                    <tr>
                        <th class="px-4 py-3 border-b text-sm font-semibold">SL.No.</th>
                        <th class="px-4 py-3 border-b text-sm font-semibold">Name</th>
                        <th class="px-4 py-3 border-b text-sm font-semibold">Total MCQs</th>
                        <th class="px-4 py-3 border-b text-sm font-semibold">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($quizzes as $key => $quiz)
                        <tr class="hover:bg-blue-50 transition">
                            <td class="px-4 py-3 border-b text-gray-600">{{ $key + 1 }}</td>
                            <td class="px-4 py-3 border-b text-gray-600">{{ $quiz->name }}</td>
                            <td class="px-4 py-3 border-b text-gray-600">
                                {{ $quiz->mcqs()->count() }}
                            </td>

                            <td class="px-4 py-3 border-b text-gray-600 flex items-center space-x-3">

                                <!-- View -->
                                <a href="{{ route('admin.quiz.show', ['id' => $quiz->id, 'quiz_name' => $quiz->name]) }}"
                                    class="hover:text-blue-500" title="View">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </a>

                                <!-- Edit -->
                                <a href="{{ route('admin.quiz.edit', ['id' => $quiz->id]) }}"
                                    class="hover:text-green-500" title="Edit">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.93z" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19.5 7.125L14.25 11.25" />
                                    </svg>
                                </a>

                                <!-- Delete -->
                                <form action="{{ route('admin.quiz.delete', ['id' => $quiz->id]) }}" method="POST"
                                    onsubmit="return confirm('Are you sure you want to delete this quiz?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="hover:text-red-500" title="Delete">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M1 7h22M8 7V5a2 2 0 012-2h2a2 2 0 012 2v2" />
                                        </svg>
                                    </button>
                                </form>

                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>

</body>

</html>
