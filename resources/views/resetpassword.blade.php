@extends('layouts.auth')

@section('content')

<main class="flex h-screen items-center justify-center">
    <section class="flex w-full h-full items-center justify-center max-h-[500px]">
        <div class="flex h-full w-full max-w-[1200px] rounded-tr-xl rounded-bl-xl rounded-br-xl shadow-lg">
            <!-- Form Container -->
            <div class="w-full md:w-1/2 h-full flex flex-col justify-center p-8">
                <div class="inline-flex items-center p-1 gap-2 bg-white space-x-2">
                    <a class="p-1 text-black bg-white" href="{{ route('login') }}">
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z" />
                        </svg>
                    </a>
                    <p class="text-black text-xs font-bold">Kembali Login</p>
                </div>
                <div>
                    <div class="text-3xl font-semibold text-black my-4">Atur Kata Sandi</div>
                    <div class="text-sm mb-6">Kata sandi Anda yang sebelumnya telah di reset. Silahkan atur<br>
                        kata sandi baru untuk akun Anda.</div>
                </div>
                <div>
                    <form method="POST" action="{{ route('register') }}" class="flex text-black text-xs flex-col gap-2 mb-4">
                        @csrf
                        <!-- New Password (Configuration Needed) -->
                        <div>
                            <label class="block" for="password">Buat kata sandi</label>
                            <input class="placeholder-black w-full rounded border-black" id="password" type="password" name="password" :value="old('password')" required autocomplete="new-password" placeholder="********">
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>
                        <!-- Confirm New Password Configuration Needed) -->
                        <div>
                            <label class="block" for="password_confirmation">Masukkan ulang kata sandi</label>
                            <input class="placeholder-black w-full rounded border-black" id="password_confirmation" type="password" name="password_confirmation" :value="old('password_confirmation')" required autocomplete="new-password" placeholder="********">
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>

                        <button type="submit" class="bg-black text-white py-2 px-8 rounded-full mt-8">Atur Kata Sandi</button>
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