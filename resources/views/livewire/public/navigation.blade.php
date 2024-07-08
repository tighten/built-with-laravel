<nav class="mt-4 flex flex-1 gap-3 justify-center">
    <a
        href="/#about"
        class="rounded-2xl border px-4 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] bg-gray-100 hover:bg-gray-200"
    >
        About
    </a>

    <a
        href="{{ route('suggestions.create') }}"
        class="rounded-2xl border px-4 text-white ring-1 ring-transparent transition focus:outline-none focus-visible:ring-[#FF2D20] bg-black hover:bg-gray-700"
    >
        Suggest
    </a>

    {{--
    <a
        href="{{ route('submit') }}"
        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20]"
    >
        Submit
    </a>
    --}}

    {{--
    @auth
        <a
            href="{{ url('/dashboard') }}"
            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20]"
        >
            Dashboard
        </a>
    @else
        <a
            href="{{ route('login') }}"
            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20]"
        >
            Log in
        </a>

        @if (Route::has('register'))
            <a
                href="{{ route('register') }}"
                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20]"
            >
                Register
            </a>
        @endif
    @endauth
    --}}
</nav>
