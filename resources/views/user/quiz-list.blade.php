<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Category : {{ $category }}</title>
    @vite('resources/css/app.css')
</head>

<body>
    <x-user-nav />
    <div class=" bg-green-100 min-h-screen flex flex-col items-center pt-24 pb-5">
        @if (Session::has('success'))
            <div class="flex items-center bg-green-200 border border-green-400 text-green-800 px-4 py-3 rounded-lg shadow relative max-w-md mx-auto mb-4"
                role="alert">
                <span class="flex-1">
                    <strong class="font-semibold">Success!</strong>
                    <span class="block sm:inline"> {{ Session::get('success') }} </span>
                </span>
                <button type="button" onclick="this.closest('div[role=alert]').remove()"
                    class="ml-4 text-green-600 hover:text-green-800 hover:cursor-pointer focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        @elseif (Session::has('error'))
            <div class="flex items-center bg-red-200 border border-red-400 text-red-800 px-4 py-3 rounded-lg shadow relative max-w-md mx-auto mb-4"
                role="alert">
                <span class="flex-1">
                    <strong class="font-semibold">Error!</strong>
                    <span class="block sm:inline"> {{ Session::get('error') }} </span>
                </span>
                <button type="button" onclick="this.closest('div[role=alert]').remove()"
                    class="ml-4 text-red-600 hover:text-red-800 hover:cursor-pointer focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        @endif
        <div class="bg-white p-8 rounded-2xl shadow-md w-full max-w-md">
            <h2 class="text-2xl text-center font-bold text-green-800">Categoty: {{ $category }} </h2>
        </div>

        <div class="min-w-3xl mx-auto mt-10">
            <table class="min-w-full bg-white rounded-xl shadow-md overflow-hidden">
                <thead>
                    <tr class="bg-green-200">
                        <th class="px-4 py-2 border-b border-green-100 text-left text-green-700">SL.No.</th>
                        <th class="px-4 py-2 border-b border-green-100 text-left text-green-700">Name</th>
                        <th class="px-4 py-2 border-b border-green-100 text-left text-green-700">Total Mcq</th>
                        <th class="px-4 py-2 border-b border-green-100 text-left text-green-700">Attempt Quiz</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($quizzes as $key => $quiz)
                        <tr class="{{ $loop->even ? 'bg-blue-50' : 'bg-white' }}">
                            <td class="px-4 py-2 border-blue-100 text-gray-600">{{ $key + $quizzes->firstItem() }}</td>
                            <td class="px-4 py-2 border-blue-100 text-gray-600">{{ $quiz->name }}</td>
                            <td class="px-4 py-2 border-blue-100 text-gray-600">{{ $quiz->mcqs->count() }}</td>
                            <td class="px-4 py-2 border-blue-100">
                                <a href="{{ route('user.quiz.start', ['id' => $quiz->id, 'quiz_name' => str_replace(' ', '-', $quiz->name)]) }}"
                                    class="bg-green-500 text-sm text-white px-4 py-1.5 rounded-lg hover:bg-green-600 transition">Start
                                    Quiz</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-2">
                {{ $quizzes->links() }}
            </div>
        </div>
    </div>
    <x-footer-user />
</body>

</html>
