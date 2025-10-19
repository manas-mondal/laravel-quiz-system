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
    @if (Session::has('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative max-w-md mx-auto mt-20 mb-5"
            role="alert">
            <strong class="font-bold">Success!</strong>
            <span class="block sm:inline">{{ Session::get('success') }}</span>
            <span class="absolute top-0 bottom-0 right-0 px-4 py-3 cursor-pointer"
                onclick="this.closest('div[role=alert]').remove()">
                <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 20 20">
                    <title>Close</title>
                    <path
                        d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                </svg>
            </span>
        </div>
    @elseif (Session::has('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative max-w-md mx-auto mt-20 mb-5"
            role="alert">
            <strong class="font-bold">Error!</strong>
            <span class="block sm:inline">{{ Session::get('error') }}</span>
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
                        <td class=" flex gap-2 px-4 py-5 border-b border-blue-100">
                            <!-- Edit/Update Button -->
                            <a href="{{ route('admin.mcq.edit', ['id' => $mcq->id]) }}"
                                class="text-gray-700 hover:text-green-500 transition-colors" title="Edit">
                                <!-- Pencil SVG icon, lighter weight -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.93z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 7.125L14.25 11.25" />
                                </svg>
                            </a>
                            <!-- Delete Button -->
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
