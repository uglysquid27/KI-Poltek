@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <div class="min-h-screen flex flex-col">
        {{-- Navbar included from the selected code --}}
        <div class="navbar bg-[#ffffff] shadow-sm w-full z-50">
            <div class="flex-1 flex items-center m-2">
                <a href="/" class="text-xl flex items-center space-x-2 ml-5">
                    <img src="{{ asset('img/logo_polinema.png') }}" alt="Logo" class="h-13 w-auto">
                    <span class="text-sm font-semibold text-gray-700" style="font-family: 'Montserrat', sans-serif;">
                        Kekayaan Intelektual Politeknik Negeri Malang
                    </span>
                </a>
            </div>
            <div class="flex-none flex items-center space-x-5 mr-5"> {{-- Adjusted space-x for better spacing with new button --}}
                <a class="text-gray-700 hover:text-gray-900 transition duration-200">Penelurusan</a>
                <a class="text-gray-700 hover:text-gray-900 transition duration-200">Total</a>
                <a class="text-gray-700 hover:text-gray-900 transition duration-200">Panduan</a>
                {{-- Login Button --}}
                <a href="{{ route('login') }}" class="px-5 py-2 text-white bg-[#68C5CC] hover:bg-[#5bb3b8] transition duration-200 cursor-pointer rounded-full font-semibold shadow-md">
                    Login
                </a>
            </div>
        </div>

        <div class="flex-grow flex items-center justify-center p-4">
            <div class="bg-white p-8 rounded-lg shadow-xl w-full max-w-md">
                <h2 class="text-3xl font-bold text-gray-700 mb-6 text-center">Login</h2>

                @if (session('error'))
                    <p class="text-red-600 text-center mb-4 p-2 bg-red-100 rounded-md">{{ session('error') }}</p>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf
                    <div>
                        <label for="email" class="block text-gray-600 text-sm font-medium mb-2">Email:</label>
                        <input type="email" name="email" id="email" required
                               class="w-full px-4 py-2 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-[#68C5CC] text-gray-700">
                    </div>

                    <div>
                        <label for="password" class="block text-gray-600 text-sm font-medium mb-2">Password:</label>
                        <div class="relative">
                            <input type="password" id="password" name="password" required
                                   class="w-full px-4 py-2 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-[#68C5CC] text-gray-700 pr-10">
                            <span id="togglePassword" onclick="togglePassword()"
                                  class="cursor-pointer absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-gray-700 transition duration-200">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.981 8.75C4.454 10.834 5.95 12.5 8 12.5c2.05 0 3.546-1.666 4.019-3.75M18.981 8.75C18.508 10.834 17.012 12.5 15 12.5c-2.05 0-3.546-1.666-4.019-3.75M15 12.5c-2.05 0-3.546-1.666-4.019-3.75m4.019 3.75c-.473 2.084-1.97 3.75-4.019 3.75s-3.546-1.666-4.019 3.75m4.019 3.75c.473 2.084 1.97 3.75 4.019 3.75s3.546-1.666 4.019-3.75M12 12.5c-2.05 0-3.546-1.666-4.019-3.75m4.019 3.75c.473 2.084 1.97 3.75 4.019 3.75s3.546-1.666 4.019-3.75M12 12.5V15m0 0v-2.5" />
                                </svg>
                            </span>
                        </div>
                    </div>

                    <button type="submit"
                            class="w-full px-6 py-3 text-white bg-[#68C5CC] hover:bg-[#5bb3b8] transition duration-200 cursor-pointer rounded-full font-semibold text-lg shadow-md">
                        Login
                    </button>
                </form>
            </div>
        </div>

        <script>
            /**
             * Toggles the visibility of the password field and changes the eye icon.
             */
            function togglePassword() {
                const passwordField = document.getElementById("password");
                const toggleIcon = document.getElementById("togglePassword");

                if (passwordField.type === "password") {
                    passwordField.type = "text";
                    // Change icon to eye (visible password)
                    toggleIcon.innerHTML = `
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        </svg>
                    `;
                } else {
                    passwordField.type = "password";
                    // Change icon back to eye-slash (hidden password)
                    toggleIcon.innerHTML = `
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.981 8.75C4.454 10.834 5.95 12.5 8 12.5c2.05 0 3.546-1.666 4.019-3.75M18.981 8.75C18.508 10.834 17.012 12.5 15 12.5c-2.05 0-3.546-1.666-4.019-3.75M15 12.5c-2.05 0-3.546-1.666-4.019-3.75m4.019 3.75c-.473 2.084-1.97 3.75-4.019 3.75s-3.546-1.666-4.019 3.75m4.019 3.75c.473 2.084 1.97 3.75 4.019 3.75s3.546-1.666 4.019-3.75M12 12.5c-2.05 0-3.546-1.666-4.019-3.75m4.019 3.75c.473 2.084 1.97 3.75 4.019 3.75s3.546-1.666 4.019-3.75M12 12.5V15m0 0v-2.5" />
                        </svg>
                    `;
                }
            }
        </script>
    </div>
@endsection
