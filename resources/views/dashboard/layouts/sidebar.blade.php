<div class="top-0 sticky flex flex-col justify-between self-start bg-white border-e border-gray-100 w-16 h-screen"> {{-- Re-added h-screen --}}
  <div>
    <div class="inline-flex justify-center items-center size-16">
      {{-- Replaced "KI" text with the Polinema logo image --}}
      <img src="{{ asset('img/logo_polinema.png') }}" alt="Logo Polinema" class="rounded-lg w-auto h-10">
    </div>

    <div class="border-gray-100 border-t">
      <div class="px-2">
        <div class="py-4">
          <a
            href="{{ route('dashboard.dashboard') }}"
            class="group relative flex justify-center bg-blue-50 px-2 py-1.5 rounded-sm text-blue-700"
          >
            <svg
              xmlns="http://www.w3.org/2000/svg"
              class="opacity-75 size-5"
              fill="none"
              viewBox="0 0 24 24"
              stroke="currentColor"
              stroke-width="2"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"
              />
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
              />
            </svg>

            <span
              class="invisible group-hover:visible top-1/2 absolute bg-gray-900 ms-4 px-2 py-1.5 rounded-sm font-medium text-white text-xs -translate-y-1/2 start-full"
            >
              Overview
            </span>
          </a>
        </div>

        <ul class="space-y-1 pt-4 border-gray-100 border-t">
          <li>
            <a
              href="#" {{-- Placeholder for My Applications --}}
              class="group relative flex justify-center hover:bg-gray-50 px-2 py-1.5 rounded-sm text-gray-500 hover:text-gray-700"
            >
              <svg
                xmlns="http://www.w3.org/2000/svg"
                class="opacity-75 size-5"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="2"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"
                />
              </svg>

              <span
                class="invisible group-hover:visible top-1/2 absolute bg-gray-900 ms-4 px-2 py-1.5 rounded-sm font-medium text-white text-xs -translate-y-1/2 start-full"
              >
                My Applications
              </span>
            </a>
          </li>

          <li>
            <a
              href="#" {{-- Placeholder for Settings --}}
              class="group relative flex justify-center hover:bg-gray-50 px-2 py-1.5 rounded-sm text-gray-500 hover:text-gray-700"
            >
              <svg
                xmlns="http://www.w3.org/2000/svg"
                class="opacity-75 size-5"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="2"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"
                />
              </svg>

              <span
                class="invisible group-hover:visible top-1/2 absolute bg-gray-900 ms-4 px-2 py-1.5 rounded-sm font-medium text-white text-xs -translate-y-1/2 start-full"
              >
                Settings
              </span>
            </a>
          </li>

          <li>
            <a
              href="#" {{-- Placeholder for Reports --}}
              class="group relative flex justify-center hover:bg-gray-50 px-2 py-1.5 rounded-sm text-gray-500 hover:text-gray-700"
            >
              <svg
                xmlns="http://www.w3.org/2000/svg"
                class="opacity-75 size-5"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="2"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"
                />
              </svg>

              <span
                class="invisible group-hover:visible top-1/2 absolute bg-gray-900 ms-4 px-2 py-1.5 rounded-sm font-medium text-white text-xs -translate-y-1/2 start-full"
              >
                Reports
              </span>
            </a>
          </li>

          {{-- Unggah Data: Hak Cipta Sentra --}}
          <li>
            <a
              href="{{ route('dashboard.hak_cipta.index') }}"
              class="group relative flex justify-center hover:bg-gray-50 px-2 py-1.5 rounded-sm text-gray-500 hover:text-gray-700"
            >
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="opacity-75 size-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
              </svg>
              <span
                class="invisible group-hover:visible top-1/2 absolute bg-gray-900 ms-4 px-2 py-1.5 rounded-sm font-medium text-white text-xs -translate-y-1/2 start-full"
              >
                Unggah Hak Cipta
              </span>
            </a>
          </li>

          {{-- Unggah Data: Paten Sentra --}}
          <li>
            <a
              href="{{ route('dashboard.paten.index') }}"
              class="group relative flex justify-center hover:bg-gray-50 px-2 py-1.5 rounded-sm text-gray-500 hover:text-gray-700"
            >
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="opacity-75 size-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
              </svg>
              <span
                class="invisible group-hover:visible top-1/2 absolute bg-gray-900 ms-4 px-2 py-1.5 rounded-sm font-medium text-white text-xs -translate-y-1/2 start-full"
              >
                Unggah Paten
              </span>
            </a>
          </li>
          <li>
            <a
              href="{{ route('dashboard.desain_industri.index') }}"
              class="group relative flex justify-center hover:bg-gray-50 px-2 py-1.5 rounded-sm text-gray-500 hover:text-gray-700"
            >
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="opacity-75 size-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
              </svg>
              <span
                class="invisible group-hover:visible top-1/2 absolute bg-gray-900 ms-4 px-2 py-1.5 rounded-sm font-medium text-white text-xs -translate-y-1/2 start-full"
              >
                Unggah Desain Industri
              </span>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </div>

  <div class="bottom-0 sticky inset-x-0 bg-white p-2 border-gray-100 border-t">
    <a
      href="{{ route('logout') }}" {{-- Assuming logout is a POST route, you'll need a form for this --}}
      class="group relative flex justify-center hover:bg-gray-50 px-2 py-1.5 rounded-lg w-full text-gray-500 hover:text-gray-700 text-sm"
    >
      <svg
        xmlns="http://www.w3.org/2000/svg"
        class="opacity-75 size-5"
        fill="none"
        viewBox="0 0 24 24"
        stroke="currentColor"
        stroke-width="2"
      >
        <path
          stroke-linecap="round"
          stroke-linejoin="round"
          d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"
        />
      </svg>

      <span
        class="invisible group-hover:visible top-1/2 absolute bg-gray-900 ms-4 px-2 py-1.5 rounded-sm font-medium text-white text-xs -translate-y-1/2 start-full"
      >
        Logout
      </span>
    </a>
  </div>
</div>
