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
                    <div class="text-3xl font-semibold text-black my-4">Lupa Kata Sandi</div>
                    <div class="text-sm mb-6">Jangan khawatir, ini bisa terjadi pada siapa saja. Masukkan <br>
                        email Anda di bawah ini untuk memulihkan kata sandi Anda.</div>
                </div>
                <div>
                    <form method="POST" action="{{ route('register') }}" class="flex text-black text-xs flex-col gap-2 mb-4">
                        @csrf
                        <!-- Email -->
                        <div>
                            <label class="block" for="email">Email</label>
                            <input class="placeholder-black w-full rounded border-black" id="email" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="login@gmail.com">
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <button type="submit" class="bg-black text-white py-2 px-8 rounded-full mt-8">Kirim Kode Verifikasi</button>
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