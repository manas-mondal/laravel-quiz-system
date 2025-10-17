<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Quizzes</title>
    @vite('resources/css/app.css')
</head>

<body>
    <x-user-nav />

    <div class="pt-24 h-screen flex flex-col items-center bg-green-100">
        @if (Session::has('success'))
            <div class="bg-green-200 border border-green-500 text-green-800 px-4 py-3 rounded relative max-w-md mx-auto mb-2"
                role="alert">
                <strong class="font-bold">Success!</strong>
                <span class="block sm:inline pr-6">{{ Session::get('success') }}</span>
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3 cursor-pointer"
                    onclick="this.closest('div[role=alert]').remove()">
                    <svg class="fill-current h-6 w-6 text-green-600" role="button" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20">
                        <title>Close</title>
                        <path
                            d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                    </svg>
                </span>
            </div>
        @elseif (Session::has('error'))
            <div class="bg-red-200 border border-red-400 text-red-700 px-4 py-3 rounded relative max-w-md mx-auto mb-2"
                role="alert">
                <strong class="font-bold">Error!</strong>
                <span class="block sm:inline pr-6">{{ Session::get('error') }}</span>
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3 cursor-pointer"
                    onclick="this.closest('div[role=alert]').remove()">
                    <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20">
                        <title>Close</title>
                        <path
                            d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152l2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                    </svg>
                </span>
            </div>
        @endif
        <h1 class="text-4xl font-bold text-green-900 mb-6">Explore Quizzes</h1>

        <div class="w-full flex justify-center max-w-md">
            <div class="relative mt-2 w-96">
                <form action="{{ route('user.all.quizzes') }}" method="GET" class="max-w-md mx-auto mb-6">
                    <input
                        class="w-full px-4 py-2 shadow-sm text-gray-700 border border-green-300 rounded-xl focus:border-green-500 focus:ring-2 focus:ring-green-200 outline-none transition"
                        type="text" name="search" placeholder="Search quiz..." value="{{ request('search') }}">
                    <button type="submit" class="absolute right-3 text-green-500 hover:text-green-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 -ml-8 mt-2 text-green-400 cursor-pointer"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </button>
                </form>
            </div>
        </div>

        <div class="min-w-3xl mx-auto mt-4">
            <h1 class="text-xl text-green-700 font-bold mb-4">Top Quizzes</h1>
            <table class="min-w-full bg-white rounded-xl shadow-md overflow-hidden">
                <thead>
                    <tr class="bg-green-200">
                        <th class="px-4 py-2 border-green-100 text-left text-green-700">SL.No</th>
                        <th class="px-4 py-2 border-green-100 text-left text-green-700">Quiz Name</th>
                        <th class="px-4 py-2 border-green-100 text-left text-green-700">Category</th>
                        <th class="px-4 py-2 border-green-100 text-left text-green-700">Total Mcq</th>
                        <th class="px-4 py-2 border-green-100 text-left text-green-700">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($quizzes as $key => $quiz)
                        <tr class="{{ $loop->even ? 'bg-green-50' : 'bg-white' }}">
                            <td class="px-4 py-2 text-gray-600">{{ $key + $quizzes->firstItem() }}</td>
                            <td class="px-4 py-2 text-gray-600">{{ $quiz->name }}</td>
                            <td class="px-4 py-2 text-gray-600">{{ $quiz->category->name ?? 'N/A' }}</td>
                            <td class="px-4 py-2 text-gray-600">{{ $quiz->mcqs_count }}</td>
                            <td class="px-4 py-2">
                                <a href="{{ route('user.quiz.start', ['id' => $quiz->id, 'quiz_name' => str_replace(' ', '-', $quiz->name)]) }}"
                                    class="bg-green-500 text-sm text-white px-4 py-1.5 rounded-lg hover:bg-green-600 transition">
                                    Start Quiz
                                </a>
                            </td>
                        </tr>
                    @endforeach

                    @if ($quizzes->isEmpty())
                        <tr>
                            <td colspan="5" class="px-4 py-2 text-center text-gray-600">
                                No quizzes found for "{{ request('search') }}"
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
            <div class="mt-4">
                {{ $quizzes->links() }}
            </div>
        </div>
    </div>

    <x-footer-user />
</body>

</html>
