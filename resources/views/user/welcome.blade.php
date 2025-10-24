<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Quiz System Home Page</title>
    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- @vite('resources/css/app.css') --}}
</head>

<body class="bg-green-100 text-gray-700">
    <x-user-nav />

    <div class="pt-24 pb-8 min-h-screen flex flex-col items-center px-4 sm:px-6">
        {{--  Success / Error Messages --}}
        @if (Session::has('success'))
            <div class="flex items-center bg-green-200 border border-green-400 text-green-800 px-4 py-3 rounded-lg shadow relative max-w-md w-full mb-4"
                role="alert">
                <span class="flex-1">
                    <strong class="font-semibold">Success!</strong>
                    <span class="block sm:inline">{{ Session::get('success') }}</span>
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
            <div class="flex items-center bg-red-200 border border-red-400 text-red-800 px-4 py-3 rounded-lg shadow relative max-w-md w-full mb-4"
                role="alert">
                <span class="flex-1">
                    <strong class="font-semibold">Error!</strong>
                    <span class="block sm:inline">{{ Session::get('error') }}</span>
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

        <h1 class="text-3xl sm:text-4xl md:text-5xl font-bold text-green-900 text-center leading-tight mb-6">
            Check Your Skills
        </h1>

        {{--  Search Box --}}
        <div class="w-full flex justify-center max-w-md">
            <div class="relative mt-6 w-full">
                <form action="{{ route('welcome') }}" method="GET"
                    class="max-w-md mx-auto mb-6 relative flex items-center">
                    @csrf
                    <input
                        class="w-full px-4 py-3 shadow-sm text-gray-700 border border-green-300 rounded-2xl focus:border-green-500 focus:ring-2 focus:ring-green-200 outline-none transition text-base sm:text-lg"
                        type="text" name="search" placeholder="Search category..." value="{{ request('search') }}">
                    <button type="submit"
                        class="absolute right-3 flex items-center justify-center h-full text-green-600 hover:text-green-800 focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 sm:h-6 sm:w-6" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </button>
                </form>
            </div>
        </div>


        {{--  Category Table --}}
        <div class="w-full max-w-4xl overflow-x-auto mt-10">
            <h2 class="text-lg sm:text-xl text-green-700 font-bold mb-4 text-center sm:text-left">Top Categories</h2>
            <table
                class="min-w-full bg-white rounded-2xl shadow-md overflow-hidden text-sm sm:text-base text-left border border-green-100">
                <thead>
                    <tr class="bg-green-200">
                        <th class="px-4 py-3 text-green-700">SL.NO</th>
                        <th class="px-4 py-3 text-green-700">Name</th>
                        <th class="px-4 py-3 text-green-700">Total Quiz</th>
                        <th class="px-4 py-3 text-green-700">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $key => $category)
                        <tr class="{{ $loop->even ? 'bg-green-50' : 'bg-white' }} hover:bg-green-100 transition">
                            <td class="px-4 py-3 whitespace-nowrap">{{ $key + $categories->firstItem() }}</td>
                            <td class="px-4 py-3 whitespace-nowrap">{{ $category->name }}</td>
                            <td class="px-4 py-3 whitespace-nowrap">{{ $category->quizzes_count }}</td>
                            <td class="px-4 py-3">
                                <a href="{{ route('user.quiz.list', ['id' => $category->id, 'category' => str_replace(' ', '-', $category->name)]) }}"
                                    class="inline-flex items-center gap-1 text-green-700 hover:text-blue-500 transition-colors text-sm sm:text-base"
                                    title="View">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
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

                    @if ($categories->isEmpty())
                        <tr>
                            <td colspan="4" class="px-4 py-4 text-center text-gray-600">
                                No categories found for "{{ request('search') }}"
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="mt-4 px-4 pb-4 text-center">
                {{ $categories->links() }}
            </div>
        </div>
    </div>

    <!-- Footer -->
    <x-footer-user />
</body>

</html>
