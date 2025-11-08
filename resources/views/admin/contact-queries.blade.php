<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Messages</title>
    <script src="https://cdn.tailwindcss.com"></script>

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

        #modalMessage {
            word-break: break-word;
        }
    </style>
</head>

<body class="bg-gray-50 min-h-screen">
    <x-navbar :admin="$admin"></x-navbar>

    <div class="max-w-6xl mx-auto px-3 sm:px-4 pt-24 pb-14">

        <!-- Alerts -->
        @if (Session::has('success') || Session::has('error'))
            <div class="max-w-lg mx-auto animate-fadeUp">
                <div
                    class="rounded-xl shadow px-4 py-3 flex justify-between items-center
                    {{ Session::has('success') ? 'bg-green-100 border border-green-300 text-green-800' : 'bg-red-100 border border-red-300 text-red-800' }}">
                    <span>
                        <strong>{{ Session::has('success') ? 'Success:' : 'Error:' }}</strong>
                        {{ Session::get('success') ?? Session::get('error') }}
                    </span>
                    <button onclick="this.parentElement.remove()" class="font-bold text-xl">✕</button>
                </div>
            </div>
        @endif

        <!-- Title -->
        <div class="text-center mt-6 mb-8 animate-fadeUp">
            <h2 class="text-2xl md:text-3xl font-extrabold text-gray-900">Contact Messages</h2>
            <p class="text-gray-500 mt-1 text-sm md:text-base">View and manage submitted queries</p>
        </div>

        <!-- Responsive Table -->
        <div class="overflow-x-auto bg-white rounded-2xl shadow-lg animate-fadeUp">
            <table class="min-w-[600px] w-full text-sm">
                <thead class="bg-blue-600 text-white text-xs uppercase">
                    <tr>
                        <th class="px-4 py-3 text-left">SL</th>
                        <th class="px-4 py-3 text-left">User Info</th>
                        <th class="px-4 py-3 text-left">Message</th>
                        <th class="px-4 py-3 text-left hidden sm:table-cell">Date</th>
                        <th class="px-4 py-3 text-left">Action</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200">
                    @forelse ($messages as $key => $msg)
                        <tr class="hover:bg-blue-50 transition">
                            <td class="px-4 py-3 font-bold text-gray-600">
                                {{ $key + $messages->firstItem() }}
                            </td>

                            <td class="px-4 py-3 break-all">
                                <div class="font-bold text-gray-800 break-all">{{ $msg->name }}</div>
                                <div class="text-gray-500 text-xs break-all">{{ $msg->email }}</div>
                            </td>

                            <td class="px-4 py-3">
                                <p class="text-gray-600 text-sm truncate max-w-[200px] sm:max-w-[250px] break-all">
                                    {{ $msg->message }}
                                </p>
                            </td>

                            <td class="px-4 py-3 text-gray-500 text-xs hidden sm:table-cell whitespace-nowrap">
                                {{ $msg->created_at->format('d M, Y h:i A') }}
                            </td>

                            <td class="px-4 py-3 whitespace-nowrap">
                                <button onclick="openModal(`{{ addslashes($msg->message) }}`)"
                                    class="text-blue-600 hover:bg-blue-600 hover:text-white px-3 py-1
                                           rounded-lg border border-blue-600 text-xs transition font-semibold">
                                    View
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-6 text-center text-gray-500">
                                No messages found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6 flex justify-center">
            {{ $messages->links() }}
        </div>

        <!-- Modal -->
        <div id="messageModal"
            class="hidden fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center p-3 z-[9999]">

            <div
                class="bg-white w-full max-w-lg h-[75vh] md:h-[65vh] rounded-2xl shadow-xl
                        p-5 sm:p-6 animate-fadeUp relative flex flex-col">

                <button onclick="closeModal()"
                    class="absolute right-3 top-2 text-gray-400 hover:text-gray-700 text-xl font-bold">✕</button>

                <h3 class="text-lg md:text-xl font-bold text-gray-800 mb-3 text-center">Message</h3>

                <div
                    class="bg-gray-100 p-4 rounded-lg border text-gray-700 text-sm overflow-y-auto flex-1 whitespace-normal break-words">
                    <span id="modalMessage"></span>
                </div>


                <button onclick="closeModal()"
                    class="mt-4 bg-blue-600 hover:bg-blue-700 text-white w-full py-2 rounded-lg text-sm font-semibold">
                    Close
                </button>
            </div>
        </div>

    </div>

    <!-- Modal JS -->
    <script>
        function openModal(message) {
            document.getElementById('modalMessage').innerText = message;
            document.getElementById('messageModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('messageModal').classList.add('hidden');
        }
        document.getElementById('messageModal').addEventListener('click', function(e) {
            if (e.target === this) closeModal();
        });
    </script>

</body>

</html>
