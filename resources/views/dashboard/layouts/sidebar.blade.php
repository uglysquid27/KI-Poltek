<div class="top-0 sticky flex flex-col justify-between self-start bg-white border-e border-gray-100 w-60 h-screen"> {{--
  Lebarkan dari w-16 jadi w-60 --}}
  <div>
    <div class="inline-flex justify-center items-center size-16">
      {{-- Logo Polinema --}}
      <img src="{{ asset('img/logo_polinema.png') }}" alt="Logo Polinema" class="rounded-lg w-auto h-10">
    </div>

    <div class="border-gray-100 border-t">
      <div class="px-2">
        <div class="py-4">
          <a href="{{ route('dashboard.dashboard') }}"
            class="group flex items-center gap-3 px-3 py-2 rounded-md text-blue-700 bg-blue-50 font-medium">
            {{-- Dashboard Icon --}}
            <svg xmlns="http://www.w3.org/2000/svg" class="opacity-75 w-5 h-5" fill="none" viewBox="0 0 24 24"
              stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M13 5v6h6" />
            </svg>
            <span>Overview</span>
          </a>
        </div>

        <ul class="space-y-1 pt-4 border-gray-100 border-t">
          {{-- Unggah Data: Hak Cipta --}}
          <li>
            <a href="{{ route('dashboard.hak_cipta.index') }}"
              class="group flex items-center gap-3 px-3 py-2 rounded-md text-gray-500 hover:text-gray-700 hover:bg-gray-50 font-medium">
              {{-- Book / Document Icon --}}
              <svg xmlns="http://www.w3.org/2000/svg" class="opacity-75 w-5 h-5" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" />
              </svg>
              <span>Unggah Hak Cipta</span>
            </a>
          </li>

          {{-- Unggah Data: Paten --}}
          <li>
            <a href="{{ route('dashboard.paten.index') }}"
              class="group flex items-center gap-3 px-3 py-2 rounded-md text-gray-500 hover:text-gray-700 hover:bg-gray-50 font-medium">
              {{-- Lightbulb Icon --}}
              <svg xmlns="http://www.w3.org/2000/svg" class="opacity-75 w-5 h-5" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                  d="M12 3c3.866 0 7 3.134 7 7 0 2.387-1.118 4.505-3 5.856V18a2 2 0 01-2 2h-4a2 2 0 01-2-2v-2.144C6.118 14.505 5 12.387 5 10c0-3.866 3.134-7 7-7z" />
              </svg>
              <span>Unggah Paten</span>
            </a>
          </li>

          {{-- Unggah Data: Desain Industri --}}
          <li>
            <a href="{{ route('dashboard.desain_industri.index') }}"
              class="group flex items-center gap-3 px-3 py-2 rounded-md text-gray-500 hover:text-gray-700 hover:bg-gray-50 font-medium">
              {{-- Cube / Design Icon --}}
              <svg xmlns="http://www.w3.org/2000/svg" class="opacity-75 w-5 h-5" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                  d="M21 16V8a2 2 0 00-1-1.732l-7-4a2 2 0 00-2 0l-7 4A2 2 0 003 8v8a2 2 0 001 1.732l7 4a2 2 0 002 0l7-4A2 2 0 0021 16z" />
              </svg>
              <span>Unggah Desain Industri</span>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </div>

  {{-- Logout --}}
  <div class="bottom-0 sticky inset-x-0 bg-white p-2 border-gray-100 border-t">
    <a href="{{ route('logout') }}"
      class="group flex items-center gap-3 px-3 py-2 rounded-md w-full text-gray-500 hover:text-gray-700 hover:bg-gray-50 text-sm font-medium"
      onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
      {{-- Logout Icon --}}
      <svg xmlns="http://www.w3.org/2000/svg" class="opacity-75 w-5 h-5" fill="none" viewBox="0 0 24 24"
        stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round"
          d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
      </svg>
      <span>Logout</span>
    </a>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
      @csrf
    </form>
  </div>
</div>