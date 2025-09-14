<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite('resources/css/app.css')
</head>

<body>
    <x-user-nav />
    <div class="pt-24 h-screen flex flex-col items-center bg-green-100">
        <h1 class="text-4xl font-bold text-green-900">Check Your Skills</h1>
        <div class="w-full flex justify-center max-w-md">
            <div class="relative mt-8 w-96">
                <input
                    class="w-full px-4 py-2 shadow-sm text-gray-700 border border-green-300 rounded-xl focus:border-green-500 focus:ring-2 focus:ring-green-200 outline-none transition"
                    type="text" name="" placeholder="Search quiz..." id="">
                <button class="absolute right-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 -ml-8 mt-2 text-green-400 cursor-pointer"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </button>
            </div>
        </div>
        <div class="min-w-3xl mx-auto mt-10">
            <h1 class="text-xl text-green-700 font-bold mb-4">Category List</h1>
            <table class="min-w-full bg-white rounded-xl shadow-md overflow-hidden">
                <thead>
                    <tr class="bg-green-200">
                        <th class="px-4 py-2 border-b border-green-100 text-left text-green-700">SL.NO</th>
                        <th class="px-4 py-2 border-b border-green-100 text-left text-green-700">Name</th>
                        <th class="px-4 py-2 border-b border-green-100 text-left text-green-700">Total Quiz</th>
                        <th class="px-4 py-2 border-b border-green-100 text-left text-green-700">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $key => $category)
                        <tr class="{{ $loop->even ? 'bg-green-50' : 'bg-white' }}">
                            <td class="px-4 py-2 border-b border-green-100 text-gray-600">{{ $key + 1 }}</td>
                            <td class="px-4 py-2 border-b border-green-100 text-gray-600">{{ $category->name }}</td>
                            <td class="px-4 py-2 border-b border-green-100 text-gray-600">{{ $category->quizzes_count }}
                            </td>
                            <td class="px-4 py-2 border-b border-green-100 flex space-x-2">
                                <!-- View Button -->
                                <a href="{{ route('admin.quiz.list', ['id' => $category->id, 'category' => $category->name]) }}"
                                    class="text-green-700 hover:text-blue-500 transition-colors" title="View">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </a>
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
