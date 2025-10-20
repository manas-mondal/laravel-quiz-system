<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit MCQ</title>
    @vite('resources/css/app.css')
</head>

<body>
    <x-navbar :admin="$admin"></x-navbar>

    @if (Session::has('error'))
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
    <div class="bg-gray-100 flex justify-center pt-24 pb-5">
        <div class="bg-white p-8 rounded-2xl shadow-md w-full max-w-md">
            <h2 class="text-2xl text-center text-gray-800 mb-6">Edit MCQ</h2>
            <form action="{{ route('admin.mcq.update', $mcq->id) }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <textarea name="question"
                        class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition"
                        rows="3" placeholder="Enter question here">{{ old('question', $mcq->question) }}</textarea>
                    @error('question')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <input type="text" name="option_a" value="{{ old('option_a', $mcq->option_a) }}"
                        placeholder="Option A"
                        class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition" />
                    @error('option_a')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <input type="text" name="option_b" value="{{ old('option_b', $mcq->option_b) }}"
                        placeholder="Option B"
                        class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition" />
                    @error('option_b')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <input type="text" name="option_c" value="{{ old('option_c', $mcq->option_c) }}"
                        placeholder="Option C"
                        class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition" />
                    @error('option_c')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <input type="text" name="option_d" value="{{ old('option_d', $mcq->option_d) }}"
                        placeholder="Option D"
                        class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition" />
                    @error('option_d')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <select name="correct_option"
                        class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition">
                        <option value="" disabled {{ old('correct_option') ? '' : 'selected' }}>Select Correct
                            Option</option>
                        <option value="option_a"
                            {{ old('correct_option', $mcq->correct_option) == 'option_a' ? 'selected' : '' }}>
                            Option A
                        </option>
                        <option value="option_b"
                            {{ old('correct_option', $mcq->correct_option) == 'option_b' ? 'selected' : '' }}>
                            Option B
                        </option>
                        <option value="option_c"
                            {{ old('correct_option', $mcq->correct_option) == 'option_c' ? 'selected' : '' }}>
                            Option C
                        </option>
                        <option value="option_d"
                            {{ old('correct_option', $mcq->correct_option) == 'option_d' ? 'selected' : '' }}>
                            Option D
                        </option>
                    </select>
                    @error('correct_option')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="w-full bg-blue-500 rounded-xl py-2 text-white hover:bg-blue-600">Update
                    MCQ</button>
            </form>
        </div>
    </div>
</body>

</html>
