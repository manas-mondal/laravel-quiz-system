<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Quiz</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <x-navbar :admin="$admin" />

    <!-- Alerts -->
    <div class="max-w-md mx-auto mt-24 px-4">
        @if (Session::has('success'))
            <div class="flex items-center bg-green-200 border border-green-400 text-green-800 px-4 py-3 rounded-lg shadow relative"
                role="alert">
                <span class="flex-1">
                    <strong class="font-semibold">Success!</strong>
                    <span class="block sm:inline">{{ Session::get('success') }}</span>
                </span>
                <button type="button" onclick="this.closest('div[role=alert]').remove()"
                    class="ml-4 text-green-600 hover:text-green-800 hover:font-bold focus:outline-none">
                    ✕
                </button>
            </div>
        @elseif (Session::has('error'))
            <div class="flex items-center bg-red-200 border border-red-400 text-red-800 px-4 py-3 rounded-lg shadow relative"
                role="alert">
                <span class="flex-1">
                    <strong class="font-semibold">Error!</strong>
                    <span class="block sm:inline">{{ Session::get('error') }}</span>
                </span>
                <button type="button" onclick="this.closest('div[role=alert]').remove()"
                    class="ml-4 text-red-600 hover:text-red-800 hover:font-bold focus:outline-none">
                    ✕
                </button>
            </div>
        @endif
    </div>

    <!-- Edit Form Card -->
    <div class="flex justify-center pt-10 pb-10 px-4">
        <div class="bg-white p-8 rounded-2xl shadow-lg w-full max-w-lg">
            <h2 class="text-2xl text-center text-gray-800 font-semibold mb-6">Edit Quiz</h2>

            <form action="{{ route('admin.quiz.update', ['id' => $quiz->id]) }}" method="POST" class="space-y-5">
                @csrf
                @method('PUT')

                <!-- Quiz Name -->
                <div>
                    <label class="block text-gray-700 mb-1 font-medium">Quiz Name</label>
                    <input type="text" name="quiz_name" value="{{ old('quiz_name', $quiz->name) }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition"
                        placeholder="Enter Quiz Name">
                    @error('quiz_name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Category Selection -->
                <div>
                    <label class="block text-gray-700 mb-1 font-medium">Category</label>
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
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Button -->
                <button type="submit"
                    class="w-full bg-green-500 rounded-xl py-2 text-white text-lg font-medium hover:bg-green-600 transition">
                    Update Quiz
                </button>

            </form>
        </div>
    </div>

</body>

</html>
