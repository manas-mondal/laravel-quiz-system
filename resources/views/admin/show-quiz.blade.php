<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Mcq</title>
    @vite('resources/css/app.css')
</head>

<body>
    <x-navbar :admin="$admin"></x-navbar>
    <div class="bg-gray-100 flex  justify-center pt-24 pb-5">
        <div class="bg-white p-8 rounded-2xl shadow-md w-full max-w-md">
            <h2 class="text-2xl text-center text-gray-800">Quiz: {{ $quiz_name }}</h2>
        </div>
    </div>
    <div class="max-w-4xl mx-auto mt-10 mb-10">
        <table class="min-w-full bg-white rounded-xl shadow-md overflow-hidden">
            <thead>
                <tr class="bg-blue-100">
                    <th class="px-4 py-2 border-b border-blue-100 text-left text-gray-700">MCQ Id</th>
                    <th class="px-4 py-2 border-b border-blue-100 text-left text-gray-700">Question</th>
                    <th class="px-4 py-2 border-b border-blue-100 text-left text-gray-700">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($mcqs as $mcq)
                    <tr class="{{ $loop->even ? 'bg-blue-50' : 'bg-white' }}">
                        <td class="px-4 py-2 border-b border-blue-100 text-gray-600">{{ $mcq->id }}</td>
                        <td class="px-4 py-2 border-b border-blue-100 text-gray-600">{{ $mcq->question }}</td>
                        <td class="px-4 py-2 border-b border-blue-100">
                            <form action="" method="POST"
                                onsubmit="return confirm('Are you sure you want to delete this category?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="bg-transparent border-none p-0 m-0 cursor-pointer inline-flex items-center justify-center text-gray-700 hover:text-red-500 transition-colors"
                                    title="Delete">
                                    <!-- Trash SVG icon, lighter weight -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M1 7h22M8 7V5a2 2 0 012-2h2a2 2 0 012 2v2" />
                                    </svg>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
