<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>SiMonik - Login</title>

    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            background-image: url('{{ asset('images/bg-login.png') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
    </style>
</head>

<body class="h-full flex items-center justify-end px-24 py-8">
    <div class="w-full max-w-lg md:w-1/2 lg:w-1/3 mr-16">
        <div class="text-center mb-6">
            <img class="mx-auto h-16 w-auto" src="https://via.placeholder.com/150" alt="SiMonik Logo">
            <h2 class="mt-6 text-2xl font-bold text-white">
                Masuk ke Akun Anda
            </h2>
            <p class="mt-2 text-sm text-gray-400">
                Sistem Informasi Monitoring Dosen
            </p>
        </div>

        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf

            <div>
                <label for="email" class="block text-sm font-medium text-gray-300">Alamat Email</label>
                <div class="mt-1">
                    <input id="email" name="email" type="email" required autocomplete="email"
                           class="appearance-none block w-full px-3 py-2 border border-gray-600 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm bg-gray-800 bg-opacity-75 text-white @error('email') border-red-500 @enderror"
                           value="{{ old('email') }}">
                    @error('email')
                        <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-300">Password</label>
                <div class="mt-1">
                    <input id="password" name="password" type="password" required autocomplete="current-password"
                           class="appearance-none block w-full px-3 py-2 border border-gray-600 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm bg-gray-800 bg-opacity-75 text-white @error('password') border-red-500 @enderror">
                    @error('password')
                        <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <input id="remember_me" name="remember" type="checkbox"
                           class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-600 rounded">
                    <label for="remember_me" class="ml-2 block text-sm text-gray-300">Ingat Saya</label>
                </div>
                @if (Route::has('password.request'))
                    <div class="text-sm">
                        <a href="{{ route('password.request') }}" class="font-medium text-blue-400 hover:text-blue-300">Lupa password?</a>
                    </div>
                @endif
            </div>

            <div>
                <button type="submit"
                        class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-gray-900 bg-yellow-500 hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
                    Masuk
                </button>
            </div>
        </form>
    </div>
</body>
</html>