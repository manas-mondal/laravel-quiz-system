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
    <div class=" bg-green-100 h-screen flex flex-col items-center pt-24 pb-5">
        <div class="bg-white p-8 rounded-2xl shadow-md w-full max-w-md">
            <h2 class="text-2xl text-center font-bold text-green-800">Categoty: {{ $category }} </h2>
        </div>

        <div class="min-w-3xl mx-auto mt-10">
            <table class="min-w-full bg-white rounded-xl shadow-md overflow-hidden">
                <thead>
                    <tr class="bg-green-200">
                        <th class="px-4 py-2 border-b border-green-100 text-left text-green-700">SL.No.</th>
                        <th class="px-4 py-2 border-b border-green-100 text-left text-green-700">Name</th>
                        <th class="px-4 py-2 border-b border-green-100 text-left text-green-700">Attempt Quiz</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($quizzes as $key => $quiz)
                        <tr class="{{ $loop->even ? 'bg-blue-50' : 'bg-white' }}">
                            <td class="px-4 py-2 border-blue-100 text-gray-600">{{ $key + 1 }}</td>
                            <td class="px-4 py-2 border-blue-100 text-gray-600">{{ $quiz->name }}</td>
                            <td class="px-4 py-2 border-blue-100">
                                <a href=""
                                    class="bg-green-500 text-sm text-white px-4 py-1.5 rounded-lg hover:bg-green-600 transition">Start
                                    Quiz</a>
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
