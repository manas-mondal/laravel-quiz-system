<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Certificate</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/quizify-favicon.png') }}">

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-green-100 font-sans antialiased">

    <x-user-nav />

    <div class="flex flex-col items-center justify-center min-h-screen px-4 pt-20 pb-5">

        <div class="bg-white w-full max-w-md p-6 rounded-2xl shadow-xl border border-yellow-500 mt-10">

            <h2 class="text-2xl font-bold text-center text-green-800 mb-4">
                Verify Certificate
            </h2>

            @if (session('error'))
                <p class="bg-red-100 text-red-600 p-2 rounded mb-3 text-center">
                    {{ session('error') }}
                </p>
            @endif

            <form action="{{ route('user.certificate.verify') }}" method="POST" class="space-y-4">
                @csrf

                <label class="font-medium text-gray-700">
                    Enter Certificate ID:
                </label>

                <input type="text" name="certificate_id"
                    class="w-full border border-gray-300 p-2 rounded-lg focus:border-green-500 focus:ring-2 focus:ring-green-200 outline-none transition text-base sm:text-lg"
                    placeholder="Example: ABCD123XYZ" required>

                <button type="submit"
                    class="w-full bg-green-600 text-white py-2 rounded-lg shadow hover:bg-green-700 transition">
                    Verify Now
                </button>
            </form>
        </div>

        <a href="{{ route('welcome') }}"
            class="mt-6 bg-gray-600 text-white px-6 py-2 rounded-xl shadow hover:bg-gray-700 transition">
            Back Home
        </a>

    </div>

    <x-footer-user />

</body>

</html>
