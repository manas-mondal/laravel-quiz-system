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
    <div class=" bg-green-100 flex flex-col items-center pt-24 pb-5">
        @if (Session::has('success'))
            <div class="bg-green-200 border border-green-500 text-green-800 px-4 py-3 rounded relative max-w-md mx-auto mb-4"
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
                    <a href="{{ route('user.mcq', ['id' => Session('first_mcq')->id, $quiz_name]) }}"
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
