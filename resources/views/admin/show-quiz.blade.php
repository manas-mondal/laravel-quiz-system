<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin MCQ</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-gray-100">

    <x-navbar :admin="$admin"></x-navbar>

    <!-- Alert Messages -->
    <div class="pt-24 px-4 max-w-lg mx-auto">
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

    <!-- Quiz Title Card -->
    <div class="flex justify-center mt-6">
        <div class="bg-white p-6 rounded-2xl shadow-md w-11/12 max-w-xl text-center">
            <h2 class="text-2xl font-semibold text-gray-800">Quiz: {{ $quiz_name }}</h2>
        </div>
    </div>

    <!-- Table Section -->
    <div class="max-w-5xl mx-auto mt-10 mb-10 px-4">
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full border-collapse">
                    <thead class="bg-blue-100">
                        <tr>
                            <th class="px-4 py-3 text-left font-semibold text-gray-700">SL. No.</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-700">Question</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-700">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($mcqs as $key => $mcq)
                            <tr class="hover:bg-blue-50 transition border-b">
                                <td class="px-4 py-3 text-gray-600">{{ $key + 1 }}</td>
                                <td class="px-4 py-3 text-gray-700 break-words max-w-xs">{{ $mcq->question }}</td>

                                <td class="px-4 py-3 flex gap-4 items-center">

                                    <a href="{{ route('admin.mcq.edit', ['id' => $mcq->id]) }}"
                                        class="hover:text-green-600 transition" title="Edit">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.93z" />
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M19.5 7.125L14.25 11.25" />
                                        </svg>
                                    </a>

                                    <form action="{{ route('admin.mcq.delete', ['id' => $mcq->id]) }}" method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this MCQ?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="hover:text-red-600 transition" title="Delete">
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
        </div>
    </div>

</body>

</html>
