@extends('layouts.auth')

@section('content')
<main>
    <section class="bg-cover bg-center bg-fixed h-screen" style="background-image: url('images/login-background.png');">
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto min-h-screen lg:py-0">
        <div class="w-full max-w-md sm:max-w-lg md:max-w-xl bg-white rounded-3xl shadow-lg md:mt-24 xl:p-0">
            <div class="px-6 py-8 sm:px-12 sm:py-12">
                <div class="mb-8 text-center sm:text-left">
                    <h1 class="text-2xl sm:text-3xl md:text-4xl font-extrabold leading-tight tracking-tight text-gray-900">
                        Selamat datang di Lapor Pak
                    </h1>
                    <p class="mt-2 text-sm sm:text-lg md:text-xl leading-tight tracking-tight text-gray-900">
                        Masuk untuk akses akun anda
                    </p>
                </div>
                    <form class="space-y-4 md:space-y-6" action="{{ route('login') }}" method="POST">
                        @csrf
                        <div>
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email</label>
                            <input type="email" name="email" id="email" class="bg-blue-50 border border-blue-300 text-gray-900 rounded-lg block w-full p-2.5" placeholder="login@email.com" required="">
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>
                        <div>
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Password</label>
                            <input type="password" name="password" id="password" placeholder="••••••••" class="bg-blue-50 border border-gray-300 text-gray-900 rounded-lg  block w-full p-2.5" required="">
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>
                        <div class="flex flex-col sm:flex-row items-center justify-between">
                            <div  class="flex items-center mb-4 sm:mb-0">
                                 <input id="remember" aria-describedby="remember" type="checkbox" class="w-4 h-4 border border-gray-300 rounded bg-white">
                                 <label for="remember" class="ml-2 text-sm text-gray-700">Ingatkan saya</label>
                            </div>
                            @if (Route::has('password.request'))
                            <a href="#" class="text-sm font-medium hover:underline">Lupa password?</a>
                            @endif
                        </div>
                        <button type="submit" class="w-full bg-black text-white focus:outline-none font-medium rounded-xl text-sm px-5 py-2.5">Sign in</button>
                        <p class="text-sm text-center font-light text-gray-900 mt-4">
                            Belum punya akun? <a href="{{ route('register') }}" class="font-medium text-blue-600 hover:underline">Daftar disini.</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

</main>
@endsection


{{-- <x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}
