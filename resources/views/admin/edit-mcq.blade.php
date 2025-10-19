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
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative max-w-md mx-auto mt-20 mb-5"
            role="alert">
            <strong class="font-bold">Error!</strong>
            <span class="block sm:inline">{{ Session::get('error') }}</span>
            <span class="absolute top-0 bottom-0 right-0 px-4 py-3 cursor-pointer"
                onclick="this.closest('div[role=alert]').remove()">
                <svg class="fill-current h-6 w-6 text-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path
                        d="M14.348 14.849a1.2 1.2 0 01-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 11-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 111.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 111.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 010 1.698z" />
                </svg>
            </span>
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
