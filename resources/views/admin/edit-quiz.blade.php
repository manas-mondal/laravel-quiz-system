<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Quiz</title>
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
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative max-w-md mx-auto  mt-20 mb-5"
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

    <div class="bg-gray-100 flex justify-center pt-24 pb-5">
        <div class="bg-white p-8 rounded-2xl shadow-md w-full max-w-md">
            <h2 class="text-2xl text-center text-gray-800 mb-6">Edit Quiz</h2>

            <form action="{{ route('admin.quiz.update', ['id' => $quiz->id]) }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <input type="text" name="quiz_name" value="{{ old('quiz_name', $quiz->name) }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition"
                        placeholder="Enter Quiz name">
                    @error('quiz_name')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <select name="category_id"
                        class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition">
                        <option value="" disabled {{ old('category_id') ? '' : 'selected' }}>Select Category
                        </option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ old('category_id', $quiz->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <button type="submit" class="w-full bg-green-500 rounded-xl py-2 text-white hover:bg-green-600">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
