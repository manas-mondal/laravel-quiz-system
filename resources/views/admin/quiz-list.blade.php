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
    <x-navbar :admin="$admin"></x-navbar>
    @if (Session::has('success'))
        <div class="flex items-center bg-green-200 border border-green-400 text-green-800 px-4 py-3 mt-20 rounded-lg shadow relative max-w-md mx-auto mb-4"
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
        <div class="flex items-center bg-red-200 border border-red-400 text-red-800 px-4 py-3 mt-20 rounded-lg shadow relative max-w-md mx-auto mb-4"
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
    <div class="bg-gray-100 flex  justify-center pt-24 pb-5">
        <div class="bg-white p-8 rounded-2xl shadow-md w-full max-w-md">
            <h2 class="text-2xl text-center text-gray-800">Categoty: {{ $category }} <a
                    class="text-blue-500 hover:underline text-sm" href="{{ route('admin.categories') }}">Back</a></h2>
        </div>
    </div>
    <div class="max-w-2xl mx-auto mt-10">
        <table class="min-w-full bg-white rounded-xl shadow-md overflow-hidden">
            <thead>
                <tr class="bg-blue-100">
                    <th class="px-4 py-2 border-b border-blue-100 text-left text-gray-700">Quiz Id</th>
                    <th class="px-4 py-2 border-b border-blue-100 text-left text-gray-700">Name</th>
                    <th class="px-4 py-2 border-b border-blue-100 text-left text-gray-700">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($quizzes as $quiz)
                    <tr class="{{ $loop->even ? 'bg-blue-50' : 'bg-white' }}">
                        <td class="px-4 py-2 border-b border-blue-100 text-gray-600">{{ $quiz->id }}</td>
                        <td class="px-4 py-2 border-b border-blue-100 text-gray-600">{{ $quiz->name }}</td>
                        <td class="px-4 py-2 border-b border-blue-100 flex space-x-2">
                            <!-- View Button -->
                            <a href="{{ route('admin.quiz.show', ['id' => $quiz->id, 'quiz_name' => $quiz->name]) }}"
                                class="text-gray-700 hover:text-blue-500 transition-colors" title="View">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </a>
                            <!-- Edit/Update Button -->
                            <a href="{{ route('admin.quiz.edit', ['id' => $quiz->id]) }}"
                                class="text-gray-700 hover:text-green-500 transition-colors" title="Edit">
                                <!-- Pencil SVG icon, lighter weight -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.93z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 7.125L14.25 11.25" />
                                </svg>
                            </a>

                            <form action="{{ route('admin.quiz.delete', ['id' => $quiz->id]) }}" method="POST"
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
