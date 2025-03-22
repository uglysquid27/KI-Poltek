{{-- filepath: d:\Code\KI-Poltek\KI-Poltek\resources\views\layouts\navbar.blade.php --}}
<div class="navbar bg-[#ffffff] shadow-sm absolute top-0 w-full z-50">
    <div class="flex-1 flex items-center m-2">
        <a href="/" class="text-xl flex items-center space-x-2 ml-5">
            <img src="{{ asset('img/logo_polinema.png') }}" alt="Logo" class="h-13 w-auto">
            <span class="text-sm font-semibold text-gray-700" style="font-family: 'Montserrat', sans-serif;">
                Kekayaan Intelektual Politeknik Negeri Malang
            </span>
        </a>
    </div>
    <div class="flex-none">
        <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
    </div>
</div>