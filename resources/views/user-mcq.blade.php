<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MCQ</title>
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
            <h2 class="text-2xl text-center font-bold text-green-800">{{ $quiz_name }}</h2>
            <h3 class="text-xl text-center font-bold text-green-800">Question No. 3</h3>
        </div>
        <div class="bg-white p-8 rounded-2xl shadow-md w-full max-w-2xl mt-6 mb-6">
            <h3 class="text-lg font-semibold mb-4 text-green-700">Q>1. What is the capital of France?</h3>
            <form action="" method="POST">
                @csrf
                <div class="space-y-4">
                    <label for="option1"
                        class="flex items-center border border-green-300 p-3 rounded-lg bg-gray-100 cursor-pointer hover:bg-gray-200 hover:shadow-md transition duration-300 hover:border-green-400 hover:scale-105">
                        <input type="radio" id="option1" name="answer" value="Berlin" class="mr-2">
                        <span class="text-gray-700">Berlin</span>
                    </label>
                    <label for="option2"
                        class="flex items-center border border-green-300 p-3 rounded-lg bg-gray-100 cursor-pointer hover:bg-gray-200 hover:shadow-md transition duration-300 hover:border-green-400 hover:scale-105">
                        <input type="radio" id="option2" name="answer" value="Madrid" class="mr-2">
                        <span class="text-gray-700">Madrid</span>
                    </label>
                    <label for="option3"
                        class="flex items-center border border-green-300 p-3 rounded-lg bg-gray-100 cursor-pointer hover:bg-gray-200 hover:shadow-md transition duration-300 hover:border-green-400 hover:scale-105">
                        <input type="radio" id="option3" name="answer" value="Paris" class="mr-2">
                        <span class="text-gray-700">Paris</span>
                    </label>
                    <label for="option4"
                        class="flex items-center border border-green-300 p-3 rounded-lg bg-gray-100 cursor-pointer hover:bg-gray-200 hover:shadow-md transition duration-300 hover:border-green-400 hover:scale-105">
                        <input type="radio" id="option4" name="answer" value="Rome" class="mr-2">
                        <span class="text-gray-700">Rome</span>
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
