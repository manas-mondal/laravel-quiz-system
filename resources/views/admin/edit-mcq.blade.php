<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit MCQ</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-gray-100">

    <x-navbar :admin="$admin"></x-navbar>

    <!-- Alert Messages -->
    <div class="pt-24 px-4 py-5 max-w-lg mx-auto">
        @if (Session::has('error'))
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
    <div class="flex justify-center pb-10 px-4">
        <div class="bg-white p-6 rounded-2xl shadow-md w-full max-w-lg">

            <h2 class="text-2xl font-semibold text-center text-gray-800 mb-6">Edit MCQ</h2>

            <form action="{{ route('admin.mcq.update', $mcq->id) }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')

                <!-- Question -->
                <div>
                    <label class="text-sm font-medium text-gray-700">Question</label>
                    <textarea name="question" rows="3"
                        class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition resize-none"
                        placeholder="Write the question here...">{{ old('question', $mcq->question) }}</textarea>
                    @error('question')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Option Inputs -->
                @foreach (['a', 'b', 'c', 'd'] as $opt)
                    <div>
                        <label class="text-sm font-medium text-gray-700">Option {{ strtoupper($opt) }}</label>
                        <input type="text" name="option_{{ $opt }}"
                            value="{{ old('option_' . $opt, $mcq->{'option_' . $opt}) }}"
                            class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition"
                            placeholder="Enter Option {{ strtoupper($opt) }}">
                        @error('option_' . $opt)
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                @endforeach

                <!-- Correct Answer -->
                <div>
                    <label class="text-sm font-medium text-gray-700">Correct Answer</label>
                    <select name="correct_option"
                        class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition">
                        <option value="" disabled>Select Correct Option</option>
                        @foreach (['option_a' => 'Option A', 'option_b' => 'Option B', 'option_c' => 'Option C', 'option_d' => 'Option D'] as $val => $text)
                            <option value="{{ $val }}"
                                {{ old('correct_option', $mcq->correct_option) == $val ? 'selected' : '' }}>
                                {{ $text }}
                            </option>
                        @endforeach
                    </select>
                    @error('correct_option')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit -->
                <button type="submit"
                    class="w-full bg-blue-500 rounded-xl py-2 text-white font-medium hover:bg-blue-600 transition shadow-sm">
                    Update MCQ
                </button>

            </form>
        </div>
    </div>

</body>

</html>
