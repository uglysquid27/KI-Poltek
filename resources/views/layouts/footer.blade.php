{{-- filepath: d:\Code\KI-Poltek\KI-Poltek\resources\views\layouts\footer.blade.php --}}
<footer class="bg-[#051D47] text-white py-6">
    <div class="container mx-auto">
        <!-- Polinema Footer Image -->
        <img src="{{ asset('img/polinema-footer.png') }}" alt="Polinema Footer Logo" class="mb-4 h-16 w-auto">

        <!-- Address and Additional Information -->
        <font size="-2">
            <b>BLU POLITEKNIK NEGERI MALANG</b> <br>
            - Soekarno Hatta Street No.9 Malang 65141 <br>
            &nbsp; Jatimulyo, Kec. Lowokwaru, Malang, <br>
            &nbsp; East Java - Indonesia<br>
            - PMDN
        </font>

        <!-- Copyright -->
        <p class="text-sm mt-4">&copy; {{ date('Y') }} KI-Poltek. All rights reserved.</p>
    </div>
</footer>