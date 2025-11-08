<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate Verification Result</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/quizify-favicon.png') }}">

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
    </style>
</head>

<body class="bg-green-50 font-sans antialiased">

    <x-user-nav />

    <div class="flex justify-center items-center min-h-screen px-4 pt-24 pb-10">
        <div class="bg-white p-8 rounded-3xl shadow-2xl w-full max-w-xl text-center border border-green-200">

            @if ($record)
                <div class="mb-6 animate__animated animate__fadeIn animate-fadeUp">
                    <h2 class="text-2xl sm:text-4xl font-extrabold text-green-700 drop-shadow">✅ Verified Successfully!
                    </h2>
                    <p class="text-gray-700 mt-3 text-sm sm:text-base">Your certificate details are verified.</p>
                </div>

                <div
                    class="border border-green-300 p-6 overflow-x-auto rounded-2xl bg-green-100/60 shadow-inner text-left space-y-4 animate-fadeUp">
                    <p class="text-lg"><span class="font-bold text-green-800">Name:</span> {{ $record->user->name }}</p>
                    <p class="text-lg"><span class="font-bold text-green-800">Email:</span> {{ $record->user->email }}
                    </p>
                    <p class="text-lg"><span class="font-bold text-green-800">Quiz:</span> {{ $record->quiz->name }}</p>
                    <p class="text-lg"><span class="font-bold text-green-800">Score:</span> {{ $record->score }}%</p>
                    <p class="text-lg"><span class="font-bold text-green-800">Certificate ID:</span>
                        {{ $record->certificate_id }}</p>
                    <p class="text-lg"><span class="font-bold text-green-800">Issued On:</span>
                        {{ $record->created_at->format('d M, Y') }}</p>
                    @auth
                        @if (Session::get('user')->id === $record->user_id)
                            <div class="mt-6 text-center">
                                <a href="{{ route('user.view.certificate', ['quiz_name' => str_replace(' ', '-', $record->quiz->name)]) }}"
                                    class="inline-block bg-blue-600 text-white font-semibold px-5 py-2.5 rounded-lg hover:bg-blue-700 shadow-md transition duration-200">
                                    🎓 Download Your Certificate
                                </a>
                            </div>
                        @endif
                    @endauth
                </div>
            @else
                <div class="mb-6 animate__animated animate__shakeX animate-fadeUp">
                    <h2 class="text-3xl sm:text-4xl font-extrabold text-red-600 drop-shadow">❌ Not Found!</h2>
                    <p class="text-gray-700 mt-3 text-sm sm:text-base">Please check the Certificate ID again.</p>
                </div>

                <div class="border border-red-300 p-6 rounded-2xl bg-red-100/60 shadow-inner animate-fadeUp">
                    <p class="text-lg text-red-700 font-semibold">No matching record exists.</p>
                </div>
            @endif

            <a href="{{ route('user.certificate.verify.form') }}"
                class="inline-block mt-8 bg-green-600 hover:bg-green-700 text-white font-bold px-6 py-3 rounded-xl tracking-wide transition-transform duration-200 hover:scale-[1.03] animate-fadeUp">
                Verify Another Certificate
            </a>

        </div>
    </div>

    <x-footer-user />

</body>

</html>
