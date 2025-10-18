<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add Quiz</title>
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
    @if (!Session::has('quizDetails'))
        <div class="bg-gray-100 flex  justify-center pt-24 pb-5">
            <div class="bg-white p-8 rounded-2xl shadow-md w-full max-w-md">
                <h2 class="text-2xl text-center text-gray-800 mb-6">Add Quiz</h2>
                @error('user')
                    <div class="text-red-500">{{ $message }}</div>
                @enderror
                <form action="{{ route('admin.quiz.add') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <input
                            class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition"
                            type="text" name="quiz_name" placeholder="Enter Quiz name"
                            value="{{ old('quiz_name') }}">
                        @error('quiz_name')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <select
                            class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition"
                            type="text" name="category_id">
                            <option value="" disabled selected>Select Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <button class="w-full bg-blue-500 rounded-xl py-2 text-white hover:bg-blue-600"
                            type="submit">Add</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="max-w-2xl mx-auto mt-10 mb-10">
            <h1 class="text-xl font-bold mb-4">All Quiz List</h1>
            <table class="min-w-full bg-white rounded-xl shadow-md overflow-hidden">
                <thead>
                    <tr class="bg-blue-100">
                        <th class="px-4 py-2 border-b border-blue-100 text-left text-gray-700">SL.NO</th>
                        <th class="px-4 py-2 border-b border-blue-100 text-left text-gray-700">Name</th>
                        <th class="px-4 py-2 border-b border-blue-100 text-left text-gray-700">Category</th>
                        <th class="px-4 py-2 border-b border-blue-100 text-left text-gray-700">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($quizzes as $key => $quiz)
                        <tr class="{{ $loop->even ? 'bg-blue-50' : 'bg-white' }}">
                            <td class="px-4 py-2 border-b border-blue-100 text-gray-600">
                                {{ $key + $quizzes->firstItem() }}</td>
                            <td class="px-4 py-2 border-b border-blue-100 text-gray-600">{{ $quiz->name }}</td>
                            <td class="px-4 py-2 border-b border-blue-100 text-gray-600">{{ $quiz->category->name }}
                            </td>
                            <td class="px-4 py-2 border-b border-blue-100 flex space-x-2">
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
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-2">
                {{ $quizzes->links() }}
            </div>
        </div>
    @else
        <div class="bg-gray-100 flex  justify-center pt-24 pb-5">
            <div class="bg-white p-8 rounded-2xl shadow-md w-full max-w-md">
                <div class="text-green-400 font-bold text-center">Quiz:
                    {{ Session::get('quizDetails')->name }}</div>
                <div class="text-green-400 font-bold text-center">Total MCQs: {{ $totalMcqs }}
                    @if ($totalMcqs > 0)
                        <span class="text-blue-400 text-sm"><a
                                href="{{ route('admin.quiz.show', ['id' => Session::get('quizDetails')->id, 'quiz_name' => Session::get('quizDetails')->name]) }}">Show
                                MCQs</a></span>
                    @endif
                </div>
                <h2 class="text-2xl text-center text-gray-800 mb-6">Add MCQs</h2>
                <form action="{{ route('admin.mcqs.add') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <textarea
                            class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition"
                            name="question" id="" cols="30" rows="3" placeholder="Enter question here"></textarea>
                        @error('question')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <input
                            class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition"
                            type="text" name="option_a" placeholder="Enter option A"
                            value="{{ old('option_a') }}">
                        @error('option_a')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <input
                            class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition"
                            type="text" name="option_b" placeholder="Enter option B"
                            value="{{ old('option_b') }}">
                        @error('option_b')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <input
                            class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition"
                            type="text" name="option_c" placeholder="Enter option C"
                            value="{{ old('option_c') }}">
                        @error('option_c')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <input
                            class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition"
                            type="text" name="option_d" placeholder="Enter option D"
                            value="{{ old('option_d') }}">
                        @error('option_d')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <select
                            class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition"
                            type="text" name="correct_option">
                            <option value="" disabled selected>Right answer</option>
                            <option value="option_a">Option A</option>
                            <option value="option_b">Option B</option>
                            <option value="option_c">Option C</option>
                            <option value="option_d">Option D</option>
                        </select>
                        @error('correct_option')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <button type="submit" name="submit" value="add-more"
                            class="w-full bg-blue-500 rounded-xl py-2 text-white hover:bg-blue-600">Add
                            More</button>
                    </div>
                    <div>
                        <button type="submit" name="submit" value="done"
                            class="w-full bg-green-500 rounded-xl py-2 text-white hover:bg-green-600">Add &
                            Submit</button>
                    </div>
                    <div>
                        <a href="{{ route('admin.quiz.cancel') }}"
                            class="w-full block text-center bg-red-500 rounded-xl py-2 text-white hover:bg-red-600">Cancel
                            Quiz</a>
                    </div>
                </form>
            </div>
        </div>
    @endif
</body>

</html>
