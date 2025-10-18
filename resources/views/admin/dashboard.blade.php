<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Dashboard</title>
    @vite('resources/css/app.css')
</head>

<body>
    <x-navbar :admin="$admin"></x-navbar>
    <div class="bg-gray-100 flex  justify-center pt-24 pb-5">
        <div class="bg-white p-8 rounded-2xl shadow-md w-full max-w-md">
            <h2 class="text-2xl text-center text-gray-800">All Users</h2>
        </div>
    </div>
    <div class="max-w-2xl mx-auto mt-10">
        <table class="min-w-full bg-white rounded-xl shadow-md overflow-hidden">
            <thead>
                <tr class="bg-blue-100">
                    <th class="px-4 py-2 border-b border-blue-100 text-left text-gray-700">SL.No.</th>
                    <th class="px-4 py-2 border-b border-blue-100 text-left text-gray-700">Name</th>
                    <th class="px-4 py-2 border-b border-blue-100 text-left text-gray-700">Email</th>
                    <th class="px-4 py-2 border-b border-blue-100 text-left text-gray-700">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $key => $user)
                    <tr class="{{ $loop->even ? 'bg-blue-50' : 'bg-white' }}">
                        <td class="px-4 py-2 border-b border-blue-100 text-gray-600">{{ $key + $users->firstItem() }}
                        </td>
                        <td class="px-4 py-2 border-b border-blue-100 text-gray-600">{{ $user->name }}</td>
                        <td class="px-4 py-2 border-b border-blue-100 text-gray-600">{{ $user->email }}</td>
                        <td class="px-4 py-2 border-b border-blue-100 text-gray-600">
                            @if ($user->active == 1)
                                <span class="text-red-600 font-semibold">Not Verified</span>
                            @else
                                <span class="text-green-600 font-semibold">Verified</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-4">
            {{ $users->links() }}
        </div>
    </div>
</body>

</html>
