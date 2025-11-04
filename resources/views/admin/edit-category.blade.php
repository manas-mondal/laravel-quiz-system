<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Category</title>
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

<body class="bg-gray-100">
    <x-navbar :admin="$admin"></x-navbar>

    <!-- Alert Messages -->
    <div class="max-w-lg mx-auto pt-24 px-4">
        @if (Session::has('success'))
            <div class="flex items-center bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded-xl shadow-sm mb-5 animate-fadeIn animate-fadeUp"
                role="alert">
                <span class="flex-1">
                    <strong class="font-semibold">Success:</strong> {{ Session::get('success') }}
                </span>
                <button onclick="this.closest('div[role=alert]').remove()"
                    class="text-green-700 hover:text-green-900 hover:font-bold">
                    ✕
                </button>
            </div>
        @elseif (Session::has('error'))
            <div class="flex items-center bg-red-100 border border-red-300 text-red-800 px-4 py-3 rounded-xl shadow-sm mb-5 animate-fadeIn animate-fadeUp"
                role="alert">
                <span class="flex-1">
                    <strong class="font-semibold">Error:</strong> {{ Session::get('error') }}
                </span>
                <button onclick="this.closest('div[role=alert]').remove()"
                    class="text-red-700 hover:text-red-900 hover:font-bold">
                    ✕
                </button>
            </div>
        @endif
    </div>

    <!-- Edit Form -->
    <div class="flex justify-center px-4 pb-12 animate-fadeUp">
        <div class="bg-white p-6 md:p-8 rounded-2xl shadow-md w-full max-w-md">
            <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Edit Category</h2>

            <form action="{{ route('admin.category.update', ['id' => $category->id]) }}" method="POST"
                class="space-y-5">
                @csrf
                @method('PUT')

                <div>
                    <input type="text" name="category_name" value="{{ old('category_name', $category->name) }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition"
                        placeholder="Enter Category Name">

                    @error('category_name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit"
                    class="w-full bg-green-500 hover:bg-green-600 text-white py-2 rounded-xl font-semibold transition">
                    Update Category
                </button>
            </form>
        </div>
    </div>

</body>

</html>
