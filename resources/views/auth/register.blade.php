@extends('layouts.auth')

@section('content')
<main class="flex h-screen items-center justify-center">
    <section class="flex w-full h-full flex-col items-center justify-center max-h-[640px]">
        <div class="flex h-full w-full max-w-[1200px] gap-12">
            <div class="w-full h-full flex flex-col justify-center gap-8 pl-16">
                <div>
                    <div class="text-4xl font-semibold text-black">Daftar Akun Anda</div>
                    <div>Ayo, isi detail Anda di sini dan bergabung dengan kami!</div>
                </div>
                <div>
                    <form method="POST" action="{{ route('register') }}" class="flex flex-col gap-4">
                        @csrf
                        {{-- name --}}
                        <div>
                            <label class="block" for="name">Nama Lengkap</label>
                            <input class="w-full rounded" id="name" type="text" name="name" :value="old('name')" required autocomplete="name">
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                        {{-- email --}}
                        <div>
                            <label class="block" for="">Email</label>
                            <input class="w-full rounded" id="email" type="email" name="email" :value="old('email')" required autocomplete="username">
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>
                        {{-- password --}}
                        <div>
                            <label class="block" for="">Password</label>
                            <input class="w-full rounded" id="password" type="password" name="password" :value="old('password')" required autocomplete="new-password">
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>
                        {{-- confirm password --}}
                        <div>
                            <label class="block" for="">Confirm Password</label>
                            <input class="w-full rounded" id="password_confirmation" type="password" name="password_confirmation" :value="old('password_confirmation')" required autocomplete="new-password">
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>
                        <button type="submit" class="bg-black text-white py-4 px-8 rounded-full">Buat Akun</button>
                    </form>
                </div>
            </div>
            <div class="w-full h-full bg-gray-500">

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
