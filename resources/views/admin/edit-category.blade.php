<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Category</title>
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

    <div class="bg-gray-100 flex justify-center pt-24 pb-5">
        <div class="bg-white p-8 rounded-2xl shadow-md w-full max-w-md">
            <h2 class="text-2xl text-center text-gray-800 mb-6">Edit Category</h2>

            <form action="{{ route('admin.category.update', ['id' => $category->id]) }}" method="POST"
                class="space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <input type="text" name="category_name" value="{{ old('category_name', $category->name) }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition"
                        placeholder="Enter Category name">
                    @error('category_name')
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
