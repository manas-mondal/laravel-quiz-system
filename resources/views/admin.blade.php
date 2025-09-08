<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite('resources/css/app.css')
</head>

<body>
    <nav class="p-4 bg-white shadow-xl flex justify-between items-center">
        <div class="text-2xl font-bold cursor-pointer">
            Quize System
        </div>
        <div class="space-x-4">
            <a class="text-gray-700 hover:text-blue-500" href="">Categories</a>
            <a class="text-gray-700 hover:text-blue-500" href="">Quiz</a>
            <a class="text-gray-700 hover:text-blue-500" href="">Welcome {{ $admin->name }}</a>
            <a class="text-gray-700 hover:text-blue-500" href="">Login</a>
        </div>
    </nav>
</body>

</html>
