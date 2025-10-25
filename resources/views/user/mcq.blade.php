<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MCQ: Question</title>
    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-green-100">
    <x-user-nav />

    <div class="min-h-screen flex flex-col items-center pt-24 pb-10 px-4">

        {{-- Success / Error Message --}}
        @if (Session::has('success'))
            <div class="bg-green-200 w-full max-w-lg mb-5 border border-green-400 text-green-800 px-4 py-3 rounded-lg shadow flex items-center justify-between"
                role="alert">
                <div>
                    <strong class="font-semibold">Success!</strong>
                    <span class="block sm:inline">{{ Session::get('success') }}</span>
                </div>
                <button type="button" onclick="this.closest('div[role=alert]').remove()"
                    class="ml-4 text-green-700 hover:text-green-900 focus:outline-none">
                    ✕
                </button>
            </div>
        @elseif (Session::has('error'))
            <div class="bg-red-200 w-full max-w-lg mb-5 border border-red-400 text-red-800 px-4 py-3 rounded-lg shadow flex items-center justify-between"
                role="alert">
                <div>
                    <strong class="font-semibold">Error!</strong>
                    <span class="block sm:inline">{{ Session::get('error') }}</span>
                </div>
                <button type="button" onclick="this.closest('div[role=alert]').remove()"
                    class="ml-4 text-red-700 hover:text-red-900 focus:outline-none">
                    ✕
                </button>
            </div>
        @endif

        {{-- Quiz Info Card --}}
        <div class="bg-white w-full max-w-lg p-6 sm:p-8 rounded-2xl shadow-md text-center transition transform">
            <h2 class="text-2xl sm:text-3xl font-bold text-green-800">{{ $quiz_name }}</h2>
            <p class="text-green-700 text-sm sm:text-base mt-2">
                Question <strong>{{ Session::get('current_quiz')['current_mcq'] }}</strong>
                of {{ Session::get('current_quiz')['total_mcqs'] }}
            </p>
        </div>

        {{-- Question Form --}}
        <div class="bg-white w-full max-w-2xl p-6 sm:p-8 rounded-2xl shadow-md mt-6 mb-6 transition transform">
            <h3 class="text-base sm:text-lg md:text-xl font-semibold mb-6 text-green-700 leading-snug">
                Q{{ Session::get('current_quiz')['current_mcq'] }}.
                {{ $mcq->question }}
            </h3>

            @error('option')
                <p class="text-red-500 text-sm mb-3">{{ $message }}</p>
            @enderror

            <form action="{{ route('user.quiz.submit.next') }}" method="POST" class="space-y-4">
                @csrf
                <input type="hidden" name="mcq_id" value="{{ $mcq->id }}">

                {{-- Options --}}
                @php
                    $options = [
                        'option_a' => $mcq->option_a,
                        'option_b' => $mcq->option_b,
                        'option_c' => $mcq->option_c,
                        'option_d' => $mcq->option_d,
                    ];
                @endphp

                @foreach ($options as $key => $value)
                    <label for="{{ $key }}"
                        class="flex items-center border border-green-300 p-3 rounded-lg bg-gray-50 cursor-pointer hover:bg-green-50 hover:border-green-400 hover:shadow-md transition-all duration-300 ease-in-out active:scale-[0.98]">
                        <input type="radio" id="{{ $key }}" name="option" value="{{ $key }}"
                            class="mr-3 w-5 h-5 text-green-600 focus:ring-green-500"
                            {{ old('option') == $key ? 'checked' : '' }}>
                        <span class="text-gray-700 text-sm sm:text-base">{{ $value }}</span>
                    </label>
                @endforeach

                {{-- Submit Button --}}
                <div class="mt-8 text-center">
                    <button type="submit"
                        class="bg-green-600 text-white text-sm sm:text-base font-semibold px-6 sm:px-8 py-2.5 sm:py-3 rounded-full hover:bg-green-700 active:bg-green-800 focus:ring-2 focus:ring-green-300 transition-all duration-300 shadow-md hover:shadow-lg">
                        Submit Answer
                    </button>
                </div>
            </form>
        </div>
    </div>

    <x-footer-user />
</body>

</html>
