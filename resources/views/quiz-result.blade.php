<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Quiz Result</title>
    @vite('resources/css/app.css')
</head>

<body>
    <x-user-nav />
    <div class=" bg-green-100 h-screen flex flex-col items-center pt-24 pb-5">
        <div class="bg-white p-8 rounded-2xl shadow-md inline-block">
            <h2 class="text-2xl text-center font-bold text-green-800">Check Your Result For <span
                    class="bg-yellow-300 text-yellow-700 px-1 rounded-xl">{{ $quiz_name }}</span></h2>
            <h3 class="text-xl text-center font-bold text-green-600 mt-2">
                {{ $correctAnswers }} Out of {{ $totalQuestions }} Correct
            </h3>
        </div>

        <div class="min-w-3xl mx-auto mt-10">
            <table class="min-w-full bg-white rounded-xl shadow-md overflow-hidden">
                <thead>
                    <tr class="bg-green-200">
                        <th class="px-4 py-2 border-b border-green-100 text-left text-green-700">SL.No.</th>
                        <th class="px-4 py-2 border-b border-green-100 text-left text-green-700">Question</th>
                        <th class="px-4 py-2 border-b border-green-100 text-left text-green-700">Select Option</th>
                        <th class="px-4 py-2 border-b border-green-100 text-left text-green-700">Result</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($resultData as $key => $result)
                        <tr class="{{ $loop->even ? 'bg-blue-50' : 'bg-white' }}">
                            <td class="px-4 py-2 border-blue-100 text-gray-600">{{ $key + 1 }}</td>
                            <td class="px-4 py-2 border-blue-100 text-gray-600">{{ $result->mcq->question }}</td>
                            <td class="px-4 py-2 border-blue-100 text-gray-600">{{ $result->selected_answer }}</td>
                            <td class="px-4 py-2 border-blue-100 text-gray-600">
                                @if ($result->is_correct == 1)
                                    <span class="text-green-600 font-semibold">Correct</span>
                                @else
                                    <span class="text-red-600 font-semibold">Incorrect</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <x-footer-user />
</body>

</html>
