<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<main>
    <section class="bg-cover bg-center bg-fixed" style="background-image: url('http://www.listercarterhomes.com/wp-content/uploads/2013/11/dummy-image-square.jpg')">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto min-h-screen lg:py-0">
            <div class="w-screen h-full flex justify-end items-start p-6 pr-32">
                <a href="#" class="flex items-center text-4xl font-semibold text-gray-900">
                    <img class="w-12 h-12 mr-2" src="https://upload.wikimedia.org/wikipedia/commons/d/d5/Tailwind_CSS_Logo.svg" alt="logo">
                    Logo
                </a>
            </div>
            <div class="w-full bg-transparent md:mt-0 sm:max-w-md xl:p-0">
                <div class="p-6 sm:p-8">
                    <div class="mb-14">
                        <h1 class="my-4 text-3xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">
                            Selamat datang di Lapor Pak
                        </h1>
                        <p class="my-4 text-md leading-tight tracking-tight text-gray-900">
                            Masuk untuk akses akun Anda.
                        </p>
                    </div>
                    <form class="space-y-4 md:space-y-6" action="#">
                        <div>
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email</label>
                            <input type="email" name="email" id="email" class="bg-blue-50 border border-blue-300 text-gray-900 rounded-lg block w-full p-2.5" placeholder="login@email.com" required="">
                        </div>
                        <div>
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Password</label>
                            <input type="password" name="password" id="password" placeholder="••••••••" class="bg-blue-50 border border-gray-300 text-gray-900 rounded-lg  block w-full p-2.5" required="">
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-start">
                                <div class="flex items-center h-5">
                                    <input id="remember" aria-describedby="remember" type="checkbox" class="w-4 h-4 border border-black rounded bg-gray-50" required="">
                                </div>
                                <div class="ml-3 text-sm">
                                    <label for="remember" class="text-black">Ingatkan saya</label>
                                </div>
                            </div>
                            <a href="#" class="text-sm font-medium hover:underline">Lupa password?</a>
                        </div>
                        <button type="submit" class="w-full bg-black text-white focus:outline-none font-medium rounded-xl text-sm px-5 py-2.5 text-center">Sign in</button>
                        <p class="text-xs text-center font-light text-black">
                            Belum punya akun? <a href="#" class="font-medium text-red-600 hover:underline">Daftar disini.</a>
                        </p>
                        <div class="flex flex-col">
                            <p class="flex items-start self-start text-xs text-center font-light text-blue-500">atau lanjutkan dengan</p>
                            <div class="flex justify-center items-center mt-4 gap-6">
                                <!-- Google Login -->
                                <a href="#" class="flex items-center justify-center w-20 h-10 rounded-full bg-white border border-blue-600 hover:bg-gray-200">
                                    <img src="https://upload.wikimedia.org/wikipedia/commons/c/c1/Google_%22G%22_logo.svg" alt="Google" class="w-6 h-6">
                                </a>

                                <!-- Facebook Login -->
                                <a href="#" class="flex items-center justify-center w-20 h-10 rounded-full bg-white border border-blue-600 hover:bg-gray-200">
                                    <img src="https://upload.wikimedia.org/wikipedia/commons/5/51/Facebook_f_logo_%282019%29.svg" alt="Facebook" class="w-6 h-6">
                                </a>

                                <!-- Apple Login -->
                                <a href="#" class="flex items-center justify-center w-20 h-10 rounded-full bg-white border border-blue-600 hover:bg-gray-200">
                                    <img src="https://upload.wikimedia.org/wikipedia/commons/f/fa/Apple_logo_black.svg" alt="Apple" class="w-6 h-6">
                                </a>

                                <!-- Twitter Login -->
                                <a href="#" class="flex items-center justify-center w-20 h-10 rounded-full bg-white border border-blue-600 hover:bg-gray-200">
                                    <img src="https://upload.wikimedia.org/wikipedia/commons/6/6f/Logo_of_Twitter.svg" alt="Twitter" class="w-6 h-6">
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</main>
</html>