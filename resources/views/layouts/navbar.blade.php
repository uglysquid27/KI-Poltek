{{-- filepath: d:\Code\KI-Poltek\KI-Poltek\resources\views\layouts\navbar.blade.php --}}
<div class="navbar bg-[#ffffff] shadow-sm absolute top-0 w-full z-50 ">
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