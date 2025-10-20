<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MCQ:Question</title>
    @vite('resources/css/app.css')
</head>

<body>
    <x-user-nav />
    <div class=" bg-green-100 flex min-h-screen flex-col items-center pt-24 pb-5">
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
            <h2 class="text-2xl text-center font-bold text-green-800">{{ $quiz_name }}</h2>
            <h3 class="text-xl text-center font-bold text-green-800 mt-2">Question.
                {{ Session::get('current_quiz')['current_mcq'] }} of {{ Session::get('current_quiz')['total_mcqs'] }}
            </h3>
        </div>
        <div class="bg-white p-8 rounded-2xl shadow-md w-full max-w-2xl mt-6 mb-6">
            <h3 class="text-lg font-semibold mb-4 text-green-700">Q.{{ Session::get('current_quiz')['current_mcq'] }})
                {{ $mcq->question }}</h3>
            @error('option')
                <div class="text-red-500">{{ $message }}</div>
            @enderror
            <form action="{{ route('user.quiz.submit.next') }}" method="POST">
                @csrf
                <input type="hidden" name="mcq_id" value="{{ $mcq->id }}">
                <div class="space-y-4">
                    <label for="option1"
                        class="flex items-center border border-green-300 p-3 rounded-lg bg-gray-100 cursor-pointer hover:bg-gray-200 hover:shadow-md transition duration-300 hover:border-green-400 hover:scale-105">
                        <input type="radio" id="option1" name="option" value="option_a" class="mr-2">
                        <span class="text-gray-700">{{ $mcq->option_a }}</span>
                    </label>
                    <label for="option2"
                        class="flex items-center border border-green-300 p-3 rounded-lg bg-gray-100 cursor-pointer hover:bg-gray-200 hover:shadow-md transition duration-300 hover:border-green-400 hover:scale-105">
                        <input type="radio" id="option2" name="option" value="option_b" class="mr-2">
                        <span class="text-gray-700">{{ $mcq->option_b }}</span>
                    </label>
                    <label for="option3"
                        class="flex items-center border border-green-300 p-3 rounded-lg bg-gray-100 cursor-pointer hover:bg-gray-200 hover:shadow-md transition duration-300 hover:border-green-400 hover:scale-105">
                        <input type="radio" id="option3" name="option" value="option_c" class="mr-2">
                        <span class="text-gray-700">{{ $mcq->option_c }}</span>
                    </label>
                    <label for="option4"
                        class="flex items-center border border-green-300 p-3 rounded-lg bg-gray-100 cursor-pointer hover:bg-gray-200 hover:shadow-md transition duration-300 hover:border-green-400 hover:scale-105">
                        <input type="radio" id="option4" name="option" value="option_d" class="mr-2">
                        <span class="text-gray-700">{{ $mcq->option_d }}</span>
                    </label>
                </div>
                <div class="mt-6 text-center">
                    <button type="submit"
                        class="bg-green-600 text-white px-6 py-2 rounded-full hover:bg-green-700 transition duration-300">Submit
                        Answer</button>
                </div>
            </form>
        </div>
    </div>
    <x-footer-user />
</body>

</html>
