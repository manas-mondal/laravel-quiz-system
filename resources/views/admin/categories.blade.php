<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Categories</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <x-navbar :admin="$admin"></x-navbar>

    <!-- Alerts -->
    <div class="max-w-lg mx-auto pt-24 px-4">
        @if (Session::has('success'))
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
        @elseif (Session::has('error'))
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
        @endif
    </div>

    <!-- Add Category Form -->
    <div class="flex justify-center px-4 pb-5">
        <div class="bg-white p-6 md:p-8 rounded-2xl shadow-md w-full max-w-md">
            <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Add Category</h2>

            <form action="{{ route('admin.category.add') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <input
                        class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition"
                        type="text" name="category_name" placeholder="Enter Category Name"
                        value="{{ old('category_name') }}">
                    @error('category_name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <button
                    class="w-full bg-blue-500 hover:bg-blue-600 text-white py-2 rounded-xl transition font-semibold">
                    Add Category
                </button>
            </form>
        </div>
    </div>

    <!-- Category List Section -->
    <div class="max-w-4xl mx-auto px-4 mb-14 mt-10">
        <h1 class="text-xl font-bold mb-4 text-center sm:text-left">Category List</h1>

        <div class="bg-white rounded-xl shadow-md overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead>
                    <tr class="bg-blue-100 text-gray-700">
                        <th class="px-4 py-3 text-left">SL.No</th>
                        <th class="px-4 py-3 text-left">Name</th>
                        <th class="px-4 py-3 text-left">Creator</th>
                        <th class="px-4 py-3 text-left">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($categories as $key => $category)
                        <tr
                            class="border-b hover:bg-blue-50 transition {{ $loop->even ? 'bg-blue-50/40' : 'bg-white' }}">
                            <td class="px-4 py-3 text-gray-600">{{ $key + $categories->firstItem() }}</td>
                            <td class="px-4 py-3 text-gray-800 font-medium">{{ $category->name }}</td>
                            <td class="px-4 py-3 text-gray-600">{{ $category->creator }}</td>

                            <td class="px-4 py-3 flex items-center space-x-3">
                                <!-- View -->
                                <a href="{{ route('admin.quiz.list', ['id' => $category->id, 'category' => $category->name]) }}"
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
                                <a href="{{ route('admin.category.edit', ['id' => $category->id]) }}"
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
                                <form action="{{ route('admin.category.delete', ['id' => $category->id]) }}"
                                    method="POST"
                                    onsubmit="return confirm('Are you sure you want to delete this category?');">
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

        <!-- Pagination -->
        <div class="mt-4 px-4 pb-4 text-center">
            {{ $categories->links() }}
        </div>
    </div>

</body>

</html>
