<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Add Quiz</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Smooth animations -->
    <style>
        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fadeUp {
            animation: fadeUp .3s ease-out;
        }
    </style>
</head>

<body class="bg-gray-100 min-h-screen">
    <!-- NAVBAR -->
    <x-navbar :admin="$admin"></x-navbar>

    <div class="pt-24">
        <!-- ALERTS -->
        @if (Session::has('success'))
            <div class="max-w-lg mx-auto px-4 animate-fadeUp">
                <div class="flex items-center bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded-xl shadow-sm mb-5 animate-fadeIn"
                    role="alert">
                    <span class="flex-1">
                        <strong class="font-semibold">Success:</strong> {{ Session::get('success') }}
                    </span>
                    <button onclick="this.closest('div[role=alert]').remove()"
                        class="text-green-700 hover:text-green-900 hover:font-bold">
                        ✕
                    </button>
                </div>
            </div>
        @elseif (Session::has('error'))
            <div class="max-w-lg mx-auto px-4 animate-fadeUp">
                <div class="flex items-center bg-red-100 border border-red-300 text-red-800 px-4 py-3 rounded-xl shadow-sm mb-5 animate-fadeIn"
                    role="alert">
                    <span class="flex-1">
                        <strong class="font-semibold">Error:</strong> {{ Session::get('error') }}
                    </span>
                    <button onclick="this.closest('div[role=alert]').remove()"
                        class="text-red-700 hover:text-red-900 hover:font-bold">
                        ✕
                    </button>
                </div>
            </div>
        @endif

        @if (!Session::has('quizDetails'))
            <!-- ADD QUIZ FORM -->
            <div class="flex justify-center pb-8 px-4 animate-fadeUp">
                <div class="bg-white p-8 rounded-2xl shadow-md w-full max-w-md">
                    <h2 class="text-2xl text-center text-gray-800 mb-6 font-bold">Add Quiz</h2>
                    <form action="{{ route('admin.quiz.add') }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <input type="text" name="quiz_name" placeholder="Quiz Name"
                                value="{{ old('quiz_name') }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition" />
                            @error('quiz_name')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <select name="category_id"
                                class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition">
                                <option value="" disabled selected>Select Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <button
                            class="w-full bg-blue-500 hover:bg-blue-600 text-white py-2 rounded-xl transition font-semibold">Add</button>
                    </form>
                </div>
            </div>

            <!-- QUIZ LIST TABLE -->
            <div class="max-w-4xl mx-auto px-4 mb-16 mt-10 animate-fadeUp">
                <h1 class="text-xl font-bold mb-4 text-center sm:text-left">All Quiz List</h1>
                <div class="overflow-x-auto bg-white rounded-xl shadow-md">
                    <table class="min-w-full text-left text-sm">
                        <thead class="bg-blue-100 text-gray-700">
                            <tr>
                                <th class="py-3 px-4">SL</th>
                                <th class="py-3 px-4">Quiz Name</th>
                                <th class="py-3 px-4">Category</th>
                                <th class="py-3 px-4">Total MCQs</th>
                                <th class="py-3 px-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($quizzes as $key => $quiz)
                                <tr class="border-t hover:bg-blue-50">
                                    <td class="py-3 px-4">{{ $key + $quizzes->firstItem() }}</td>
                                    <td class="py-3 px-4 font-medium">{{ $quiz->name }}</td>
                                    <td class="py-3 px-4">{{ $quiz->category->name }}</td>
                                    <td class="py-3 px-4">{{ $quiz->mcqs->count() ?? 0 }}</td>
                                    <td class="py-3 px-4 flex gap-3 items-center">
                                        <!-- View -->
                                        <a href="{{ route('admin.quiz.show', ['id' => $quiz->id, 'quiz_name' => $quiz->name]) }}"
                                            class="text-gray-600 hover:text-blue-500 transition" title="View">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                        </a>

                                        <!-- Edit -->
                                        <a href="{{ route('admin.quiz.edit', ['id' => $quiz->id]) }}"
                                            class="text-gray-600 hover:text-green-600 transition" title="Edit">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.93z" />
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M19.5 7.125L14.25 11.25" />
                                            </svg>
                                        </a>

                                        <!-- Delete -->
                                        <form action="{{ route('admin.quiz.delete', ['id' => $quiz->id]) }}"
                                            method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this Quiz?');">
                                            @csrf
                                            @method('DELETE')
                                            <button class="text-gray-600 hover:text-red-600 transition" title="Delete">
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
                <div class="mt-3">{{ $quizzes->links() }}</div>
            </div>
        @else
            <div class="bg-gray-100 flex  justify-center px-2 pb-5 animate-fadeUp">
                <div class="bg-white p-8 rounded-2xl shadow-md w-full max-w-md">
                    <div class="text-green-500 font-bold text-center"><span class="text-yellow-500">Quiz:</span>
                        {{ Session::get('quizDetails')->name }}
                    </div>
                    <div class="text-green-500 font-bold text-center mb-5"><span class="text-yellow-500">Total
                            MCQs:</span>
                        {{ $totalMcqs }}
                        @if ($totalMcqs > 0)
                            <span
                                class="text-blue-600 text-sm font-semibold underline-offset-4 hover:text-blue-800 hover:underline transition-colors duration-200"><a
                                    href="{{ route('admin.quiz.show', ['id' => Session::get('quizDetails')->id, 'quiz_name' => Session::get('quizDetails')->name]) }}">Show
                                    MCQs →</a></span>
                        @endif
                    </div>
                    <h2 class="text-2xl text-center font-semibold text-gray-800 mb-6">Add MCQs</h2>
                    <form action="{{ route('admin.mcqs.add') }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <textarea
                                class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition"
                                name="question" cols="30" rows="3" placeholder="Enter question here">{{ old('question') }}</textarea>
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
                                name="correct_option">
                                <option value="" disabled {{ old('correct_option') ? '' : 'selected' }}>Right
                                    answer
                                </option>
                                <option value="option_a" {{ old('correct_option') == 'option_a' ? 'selected' : '' }}>
                                    Option
                                    A</option>
                                <option value="option_b" {{ old('correct_option') == 'option_b' ? 'selected' : '' }}>
                                    Option
                                    B</option>
                                <option value="option_c" {{ old('correct_option') == 'option_c' ? 'selected' : '' }}>
                                    Option
                                    C</option>
                                <option value="option_d" {{ old('correct_option') == 'option_d' ? 'selected' : '' }}>
                                    Option
                                    D</option>
                            </select>
                            @error('correct_option')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" name="submit" value="add-more"
                            class="w-full bg-blue-500 rounded-xl py-2 text-white hover:bg-blue-600">Add More</button>
                        <button type="submit" name="submit" value="done"
                            class="w-full bg-green-500 rounded-xl py-2 text-white hover:bg-green-600">Add &
                            Submit</button>
                        <a href="{{ route('admin.quiz.cancel') }}"
                            class="w-full block text-center bg-red-500 rounded-xl py-2 text-white hover:bg-red-600">Cancel
                            Quiz</a>
                    </form>
                </div>
            </div>
        @endif
    </div>

</body>

</html>
