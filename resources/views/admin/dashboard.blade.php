<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <x-navbar :admin="$admin"></x-navbar>
    <div class="pt-24">
        <!-- Alert Messages -->
        @if (Session::has('success'))
            <div class="max-w-lg mx-auto px-4">
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
            </div>
        @elseif (Session::has('error'))
            <div class="max-w-lg mx-auto px-4">
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
            </div>
        @endif

        <!-- Page Title -->
        <div class="pb-6 mx-5 flex justify-center">
            <div class="bg-white p-6 md:p-8 rounded-2xl shadow-md w-full max-w-lg text-center">
                <h2 class="text-3xl font-bold text-gray-800">All Users</h2>
                <p class="text-gray-500 mt-1 text-sm">Manage registered users in the system</p>
            </div>
        </div>

        <!-- Table Section -->
        <div class="max-w-4xl mx-auto px-3 md:px-0 mb-10">
            <div class="overflow-x-auto bg-white rounded-xl shadow-md">
                <table class="min-w-full text-sm">
                    <thead>
                        <tr class="bg-blue-100 text-gray-700">
                            <th class="px-4 py-3 text-left">SL.No.</th>
                            <th class="px-4 py-3 text-left">Name</th>
                            <th class="px-4 py-3 text-left">Email</th>
                            <th class="px-4 py-3 text-left">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $key => $user)
                            <tr
                                class="border-b hover:bg-blue-50 transition {{ $loop->even ? 'bg-blue-50/40' : 'bg-white' }}">
                                <td class="px-4 py-3 text-gray-600">{{ $key + $users->firstItem() }}</td>
                                <td class="px-4 py-3 text-gray-700 font-medium">{{ $user->name }}</td>
                                <td class="px-4 py-3 text-gray-600">{{ $user->email }}</td>
                                <td class="px-4 py-3">
                                    @if ($user->active == 1)
                                        <span
                                            class="px-3 py-1 text-xs font-semibold text-red-600 sm:bg-red-100 rounded-full">
                                            Not Verified
                                        </span>
                                    @else
                                        <span
                                            class="px-3 py-1 text-xs font-semibold text-green-600 sm:bg-green-100 rounded-full">
                                            Verified
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-4 px-4 pb-4 text-center">
                {{ $users->links() }}
            </div>
        </div>
    </div>

</body>

</html>
