<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Start Quiz</title>
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
            <h2 class="text-2xl text-center font-bold text-green-800">{{ $quiz_name }} </h2>
            <p class="text-center text-gray-600 mt-2">Get ready to test your knowledge!</p>
        </div>
        <div class="bg-white p-8 rounded-2xl shadow-md w-full max-w-md mt-6 mb-6">
            <h3 class="text-lg font-semibold mb-4 text-green-700">Quiz Instructions:</h3>
            <ul class="list-disc list-inside text-gray-700 space-y-2">
                <li>Total Questions: {{ $mcqs->count() }}</li>
                <li>Time Limit: No</li>
                <li>Each question carries equal marks.</li>
                <li>No negative marking for wrong answers.</li>
                <li>Make sure to read each question carefully before answering.</li>
                <li>Good luck and do your best!</li>
            </ul>
            <div class="mt-6 text-center">
                @if (session()->has('user'))
                    <a href="{{ route('user.mcq', ['id' => Session('first_mcq')->id, str_replace(' ', '-', $quiz_name)]) }}"
                        class="bg-green-600 text-white px-6 py-2 rounded-full hover:bg-green-700 transition duration-300">Start
                        Quiz</a>
                @else
                    <div>
                        <a href="{{ route('user.signup.quiz') }}"
                            class="bg-green-600 text-white px-6 py-2 rounded-full hover:bg-green-700 transition duration-300">SignUp
                            for Start
                            Quiz</a>
                    </div>

                    <div class="mt-6">
                        <a href="{{ route('user.login.form.quiz') }}"
                            class="bg-blue-600 text-white px-6 py-2 rounded-full hover:bg-blue-700 transition duration-300">Login
                            for Start
                            Quiz</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <x-footer-user />
</body>

</html>
