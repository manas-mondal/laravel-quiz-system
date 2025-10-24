<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Details</title>
    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- @vite('resources/css/app.css') --}}
</head>

<body class="bg-green-100 min-h-screen flex flex-col">

    <!-- Navbar -->
    <x-user-nav />

    <div class="pt-24 pb-10 flex flex-col items-center w-full px-4 sm:px-6 lg:px-8">

        <!-- Alert Messages -->
        @if (Session::has('success'))
            <div class="flex items-center bg-green-200 border border-green-400 text-green-800 px-4 py-3 sm:px-5 sm:py-4 rounded-2xl shadow relative max-w-md mx-auto mb-6 transition-all duration-200"
                role="alert">
                <span class="flex-1">
                    <strong class="font-semibold">Success!</strong>
                    <span class="block sm:inline"> {{ Session::get('success') }} </span>
                </span>
                <button type="button" onclick="this.closest('div[role=alert]').remove()"
                    class="ml-4 text-green-600 hover:text-green-800 focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 sm:w-6 sm:h-6" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        @elseif (Session::has('error'))
            <div class="flex items-center bg-red-200 border border-red-400 text-red-800 px-4 py-3 sm:px-5 sm:py-4 rounded-2xl shadow relative max-w-md mx-auto mb-6 transition-all duration-200"
                role="alert">
                <span class="flex-1">
                    <strong class="font-semibold">Error!</strong>
                    <span class="block sm:inline"> {{ Session::get('error') }} </span>
                </span>
                <button type="button" onclick="this.closest('div[role=alert]').remove()"
                    class="ml-4 text-red-600 hover:text-red-800 focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 sm:w-6 sm:h-6" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        @endif

        <!-- User Info Header -->
        <div class="bg-white p-6 sm:p-8 rounded-2xl shadow-md w-full max-w-md text-center mb-20">
            <h2 class="text-2xl sm:text-3xl font-bold text-green-800">User Details</h2>
            <h3 class="text-xl sm:text-2xl font-semibold text-green-600 mt-2">Attempted Quiz</h3>
        </div>

        <!-- Records Table -->
        <div class="w-full max-w-5xl overflow-x-auto rounded-2xl shadow-md bg-white">
            <table class="min-w-full divide-y divide-green-200 text-sm sm:text-base">
                <thead class="bg-green-200">
                    <tr>
                        <th class="px-4 py-3 text-left text-green-700 font-semibold whitespace-nowrap">SL.No.</th>
                        <th class="px-4 py-3 text-left text-green-700 font-semibold whitespace-nowrap">Name</th>
                        <th class="px-4 py-3 text-left text-green-700 font-semibold whitespace-nowrap">Correct / Total
                        </th>
                        <th class="px-4 py-3 text-left text-green-700 font-semibold whitespace-nowrap">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-green-100">
                    @foreach ($records as $key => $record)
                        <tr class="{{ $loop->even ? 'bg-blue-50' : 'bg-white' }} hover:bg-green-50 transition-colors">
                            <td class="px-4 py-3 text-gray-600 whitespace-nowrap">{{ $key + $records->firstItem() }}
                            </td>
                            <td class="px-4 py-3 text-gray-600 break-words hover:text-blue-800">
                                <a
                                    href="{{ route('user.quiz.list', ['id' => $record->quiz->category->id, 'category' => str_replace(' ', '-', $record->quiz->name)]) }}">
                                    {{ $record->quiz->name }}
                                </a>
                            </td>
                            <td class="px-4 py-3 text-gray-600 whitespace-nowrap">
                                @if ($record->status == 2)
                                    {{ $record->correct_answers }} / {{ $record->total_questions }}
                                @else
                                    <span class="text-gray-400 italic">Not available yet</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-gray-600 whitespace-nowrap">
                                @if ($record->status == 2)
                                    <span class="text-green-600 font-semibold">Completed</span>
                                @else
                                    <span class="text-red-600 font-semibold">Incomplete</span>
                                    <a href="{{ route('user.mcq', [$record->quiz->mcqs->first()->id, str_replace(' ', '-', $record->quiz->name)]) }}"
                                        class="inline-block ml-2 text-white text-xs sm:text-sm px-2.5 py-1 rounded-lg bg-green-600 hover:bg-green-700 shadow-sm transition duration-200">
                                        Continue →
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    @if ($records->isEmpty())
                        <tr>
                            <td colspan="4" class="px-4 py-4 text-center text-gray-600">No records found</td>
                        </tr>
                    @endif
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="mt-4 px-4 pb-4 text-center">
                {{ $records->links() }}
            </div>
        </div>
    </div>

    <!-- Footer -->
    <x-footer-user />

</body>

</html>
