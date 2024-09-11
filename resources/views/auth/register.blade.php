@extends('layouts.auth')

@section('content')

<main class="flex h-screen items-center justify-center">
    <section class="flex w-full h-full items-center justify-center max-h-[500px]">
        <div class="flex h-full w-full max-w-[1200px] rounded-tr-xl rounded-bl-xl rounded-br-xl shadow-lg">
            <!-- Form Container -->
            <div class="w-full md:w-1/2 h-full flex flex-col justify-center p-8 bg-white border-r">
                <div>
                    <div class="text-3xl font-semibold text-black my-4">Daftar Akun Anda</div>
                    <div class="text-sm mb-6">Ayo, isi detail Anda di sini dan bergabung dengan kami!</div>
                </div>
                <div>
                    <form method="POST" action="{{ route('register') }}" class="flex text-black text-xs flex-col gap-2 mb-4">
                        @csrf
                        <!-- Name -->
                        <div>
                            <label class="block" for="name">Complete Name</label>
                            <input class="placeholder-black w-full rounded border-black" id="name place" type="text" name="name" :value="old('name')" required autocomplete="name" placeholder="John doe">
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                        <!-- Email -->
                        <div>
                            <label class="block" for="email">Email</label>
                            <input class="placeholder-black w-full rounded border-black" id="email" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="login@gmail.com">
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>
                        <!-- Password -->
                        <div>
                            <label class="block" for="password">Password</label>
                            <input class="placeholder-black w-full rounded border-black" id="password" type="password" name="password" :value="old('password')" required autocomplete="new-password" placeholder="********">
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>
                        <!-- Confirm Password -->
                        <div>
                            <label class="block" for="password_confirmation">Confirm Password</label>
                            <input class="placeholder-black w-full rounded border-black" id="password_confirmation" type="password" name="password_confirmation" :value="old('password_confirmation')" required autocomplete="new-password" placeholder="********">
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>
                        <div class="flex items-center">
                            <input id="link-checkbox" type="checkbox" value="" class="w-4 h-4 text-blue-700 bg-gray-100 border-black rounded">
                            <label for="link-checkbox" class="ms-2 text-sm text-gray-900>I agree with the <a href="#" 
                                class="text-blue-600 dark:text-blue-500 hover:underline">Saya setuju dengan semua <a class="hover:underline text-blue-700" href="#">Syarat dan Ketentuan</a> serta  <a class="hover:underline text-blue-700" href="#">Kebijakan Privasi.</a>.</label>
                        </div>
                        <button type="submit" class="bg-black text-white py-2 px-8 rounded-full">Buat Akun</button>
                        <p class="text-sm text-center font-light text-gray-900">
                            Sudah punya akun? <a href="{{ route('login') }}" class="font-medium text-blue-700 hover:underline">Masuk.</a>
                        </p>
                    </form>
                </div>
            </div>
            <!-- Image Container -->
            <div class="shadow-lg hidden md:block w-full md:w-1/2 h-full bg-gray-500 bg-cover bg-center rounded-r-lg" style="background-image: url('images/register-image.png');">
                <!-- Image will be displayed here -->
            </div>
        </div>
    </section>
</main>

@endsection



{{-- <x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}
