<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Quiz</title>
    @vite('resources/css/app.css')
</head>

<body>
    <x-user-nav />
    <div class=" bg-green-100 flex flex-col items-center pt-24 pb-5">
        <div class="bg-white p-8 rounded-2xl shadow-md w-full max-w-md">
            <h2 class="text-2xl text-center font-bold text-green-800">{{ $quiz_name }} </h2>
            <p class="text-center text-gray-600 mt-2">Get ready to test your knowledge!</p>
        </div>
        <div class="bg-white p-8 rounded-2xl shadow-md w-full max-w-md mt-6 mb-6">
            <h3 class="text-lg font-semibold mb-4 text-green-700">Quiz Instructions:</h3>
            <ul class="list-disc list-inside text-gray-700 space-y-2">
                <li>Total Questions: {{ $mcqCount }}</li>
                <li>Time Limit: No</li>
                <li>Each question carries equal marks.</li>
                <li>No negative marking for wrong answers.</li>
                <li>Make sure to read each question carefully before answering.</li>
                <li>Good luck and do your best!</li>
            </ul>
            <div class="mt-6 text-center">
                <a href="{{ route('user.quiz.start', ['id' => $id, 'quiz_name' => $quiz_name]) }}"
                    class="bg-green-600 text-white px-6 py-2 rounded-full hover:bg-green-700 transition duration-300">Login/SignUp
                    for Start
                    Quiz</a>
            </div>
        </div>
    </div>
    <x-footer-user />
</body>

</html>
