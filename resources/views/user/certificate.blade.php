<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate of Achievement</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/gold-badge.png') }}">

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        /* Watermark style */
        .watermark {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            opacity: 0.08;
            width: 60%;
            max-width: 600px;
            pointer-events: none;
            z-index: 0;
        }

        /* Ensuring certificate content stays above watermark */
        .content-layer {
            position: relative;
            z-index: 2;
        }

        @media print {
            .no-print {
                display: none !important;
            }

            body {
                background: white !important;
            }

            .certificate-container {
                box-shadow: none !important;
                margin: 0 !important;
                width: 100% !important;
            }
        }
    </style>
</head>

<body class="bg-green-100 flex flex-col items-center justify-center min-h-screen p-2 md:p-6 select-none">

    <div
        class="certificate-container bg-white border-[10px] border-yellow-500 rounded-3xl shadow-xl w-full max-w-4xl p-6 sm:p-10 mt-10 text-center relative">

        <!-- ✅ Watermark -->
        <img src="{{ asset('images/quiz-logo.png') }}" class="watermark" alt="Quizify Logo Watermark">

        <!-- All content wrapped with content-layer -->
        <div class="content-layer">

            <!-- Ribbon -->
            <div
                class="absolute -top-16 left-1/2 transform -translate-x-1/2 bg-yellow-500 text-white font-semibold px-4 sm:px-8 py-1.5 sm:py-2 rounded-full shadow-lg tracking-wide text-sm sm:text-base">
                CERTIFICATE
            </div>

            <!-- Gold Badge -->
            <img src="{{ asset('images/gold-badge.png') }}" class="h-24 sm:h-32 w-24 sm:w-32 mx-auto mt-2 sm:mt-1 mb-3"
                alt="Gold Badge">

            <!-- Title -->
            <h1 class="text-2xl sm:text-4xl font-extrabold text-green-800 tracking-wide leading-tight">
                Certificate of Achievement
            </h1>

            <!-- Subtitle -->
            <p class="text-gray-700 text-base sm:text-lg mt-2 italic">
                This is proudly awarded to
            </p>

            <!-- Recipient Name -->
            <div class="mt-3 text-2xl sm:text-3xl font-bold text-yellow-700 uppercase break-words">
                {{ $record->user->name }}
            </div>

            <!-- Line -->
            <div class="w-24 sm:w-32 h-1 bg-green-600 mx-auto mt-3 rounded"></div>

            <!-- Description -->
            <p class="mt-5 sm:mt-6 text-gray-700 leading-relaxed text-base sm:text-lg px-3">
                For successfully completing the quiz titled
                <span class="font-semibold text-green-700">“{{ $quiz_name }}”</span>
                with excellent performance.
            </p>

            <!-- Score -->
            <p class="mt-4 text-gray-700 text-base sm:text-lg">
                Score: <span class="font-bold text-yellow-700">{{ round($record->score) }}%</span>
            </p>

            <!-- Certificate ID -->
            <p class="mt-3 text-gray-700 text-base sm:text-lg break-all">
                Certificate ID:
                <span class="font-semibold text-green-700 tracking-wider break-all">
                    {{ $record->certificate_id }}
                </span>
            </p>

            <!-- QR Code -->
            <div class="mt-6 flex justify-center">
                {!! QrCode::size(120)->generate(url('/verify-certificate') . '?certificate_id=' . $record->certificate_id) !!}
            </div>

            <!-- Verification Link -->
            <p class="mt-3 text-gray-500 text-xs sm:text-sm break-all">
                Verify at:
                <span class="text-green-700 font-medium">
                    {{ route('user.certificate.verify.form') }}
                </span>
            </p>

            <!-- Award Date -->
            <p class="mt-6 text-gray-600 text-sm sm:text-base">
                Awarded on:
                <span class="font-medium">{{ $record->updated_at->format('d M, Y') }}</span>
            </p>

            <!-- Signatures -->
            <div class="mt-10 flex justify-between items-end px-6 sm:px-16 gap-6">

                <!-- Admin Signature -->
                <div class="text-center flex-1">
                    <img src="{{ asset('images/admin-sign.png') }}" class="h-14 sm:h-20 mx-auto" alt="Admin Signature">
                    <p class="text-xs sm:text-sm font-medium text-gray-700 mt-1">Authorized by Admin</p>
                </div>

                <!-- Authority Signature -->
                <div class="text-center flex-1">
                    <img src="{{ asset('images/demo-sign.png') }}" class="h-12 sm:h-16 mx-auto"
                        alt="Authority Signature">
                    <p class="text-xs sm:text-sm font-medium text-gray-700 mt-1">Quizify Authority</p>
                </div>

            </div>

        </div>
    </div>

    <!-- Buttons -->
    <div class="mt-6 flex flex-wrap gap-3 sm:gap-4 no-print justify-center">
        <button onclick="window.print()"
            class="bg-green-600 text-white px-5 sm:px-6 py-2 rounded-xl shadow hover:bg-green-700 transition text-sm sm:text-base">
            Download / Print
        </button>

        <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(url('/verify-certificate?certificate_id=' . $record->certificate_id)) }}"
            target="_blank"
            class="bg-blue-700 text-white px-5 sm:px-6 py-2 rounded-xl shadow hover:bg-blue-800 transition text-sm sm:text-base text-center">
            Share on LinkedIn
        </a>

        <a href="{{ route('welcome') }}"
            class="bg-gray-600 text-white px-5 sm:px-6 py-2 rounded-xl shadow hover:bg-gray-700 transition text-sm sm:text-base text-center">
            Back Home
        </a>
    </div>

</body>

</html>
