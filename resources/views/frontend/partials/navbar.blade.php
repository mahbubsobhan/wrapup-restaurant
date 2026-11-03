<nav
    x-data="{
        open: false,

        cartCount: {{ collect(session('cart', []))->sum('quantity') }},

        init() {

            window.addEventListener(
                'cart-updated',
                (event) => {

                    this.cartCount =
                        event.detail.count ?? 0;

                }
            );

        }
    }"

    class="sticky top-0 z-50 border-b border-orange-100 bg-white/90 shadow-sm backdrop-blur-xl"
>


    <div class="mx-auto max-w-7xl px-6 lg:px-8">


        {{-- ========================================================= --}}
        {{-- NAVBAR MAIN --}}
        {{-- ========================================================= --}}

        <div class="flex h-20 items-center justify-between">


            {{-- ========================================================= --}}
            {{-- LOGO --}}
            {{-- ========================================================= --}}

            <a
                href="{{ route('home') }}"

                class="group flex items-center gap-3"
            >

                <img
                    src="{{ asset('asset/images/wrap-y-removebg-preview.png') }}"

                    alt="WrapUp"

                    class="h-14 transition duration-300 group-hover:rotate-6"
                >

            </a>


            {{-- ========================================================= --}}
            {{-- DESKTOP MENU --}}
            {{-- ========================================================= --}}

{{-- Desktop Menu --}}

<ul class="hidden lg:flex items-center gap-8 font-semibold">

    <li>
        <a href="{{ route('home') }}"
            class="hover:text-orange-500 transition">
            Home
        </a>
    </li>

    <li>
        <a href="{{ route('home') }}#menu"
            class="hover:text-orange-500 transition">
            Menu
        </a>
    </li>

    <li>
        <a href="{{ route('about') }}"
            class="hover:text-orange-500 transition">
            About
        </a>
    </li>

    <li>
        <a href="{{ route('franchises') }}"
            class="hover:text-orange-500 transition">
            Franchises
        </a>
    </li>

    <li>
        <a href="{{ route('contact') }}"
            class="hover:text-orange-500 transition">
            Contact
        </a>
    </li>

</ul>

            {{-- ========================================================= --}}
            {{-- RIGHT SIDE --}}
            {{-- ========================================================= --}}

            <div class="flex items-center gap-3">


                {{-- ================================================= --}}
                {{-- SEARCH --}}
                {{-- ================================================= --}}

                <button
                    type="button"

                    class="hidden h-11 w-11 items-center justify-center rounded-full border border-gray-200 transition hover:bg-orange-500 hover:text-white md:flex"
                >

                    <i class="fa-solid fa-magnifying-glass"></i>

                </button>


                {{-- ================================================= --}}
                {{-- WISHLIST --}}
                {{-- ================================================= --}}

                <button
                    type="button"

                    class="hidden h-11 w-11 items-center justify-center rounded-full border border-gray-200 transition hover:bg-orange-500 hover:text-white md:flex"
                >

                    <i class="fa-regular fa-heart"></i>

                </button>


                {{-- ================================================= --}}
                {{-- CART --}}
                {{-- Only show after first product is added --}}
                {{-- ================================================= --}}

                <a
                    x-show="cartCount > 0"

                    x-cloak

                    href="{{ route('cart') }}"

                    class="relative flex h-11 w-11 items-center justify-center rounded-full border border-gray-200 transition hover:bg-orange-500 hover:text-white"
                >

                    <i class="fa-solid fa-cart-shopping"></i>


                    {{-- CART COUNT --}}

                    <span
                        x-text="cartCount"

                        class="absolute -right-1 -top-1 flex h-5 min-w-5 items-center justify-center rounded-full bg-red-500 px-1 text-[11px] font-bold text-white"
                    ></span>

                </a>


                {{-- ================================================= --}}
                {{-- ORDER NOW --}}
                {{-- ================================================= --}}

<a href="{{ route('home') }}#menu"
    class="hidden md:inline-flex rounded-xl bg-gradient-to-r from-orange-500 to-red-500 px-6 py-3 font-semibold text-white shadow-lg hover:scale-105 transition">
    Order Now
</a>


                {{-- ================================================= --}}
                {{-- MOBILE TOGGLE --}}
                {{-- ================================================= --}}

                <button
                    type="button"

                    @click="open = !open"

                    class="flex h-11 w-11 items-center justify-center rounded-xl border border-gray-200 lg:hidden"
                >


                    {{-- HAMBURGER --}}

                    <svg
                        x-show="!open"

                        xmlns="http://www.w3.org/2000/svg"

                        class="h-7 w-7"

                        fill="none"

                        viewBox="0 0 24 24"

                        stroke="currentColor"
                    >

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"

                            d="M4 6h16M4 12h16M4 18h16"
                        />

                    </svg>


                    {{-- CLOSE --}}

                    <svg
                        x-show="open"

                        x-cloak

                        xmlns="http://www.w3.org/2000/svg"

                        class="h-7 w-7"

                        fill="none"

                        viewBox="0 0 24 24"

                        stroke="currentColor"
                    >

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"

                            d="M6 18L18 6M6 6l12 12"
                        />

                    </svg>


                </button>


            </div>


        </div>


        {{-- ========================================================= --}}
        {{-- MOBILE MENU --}}
        {{-- ========================================================= --}}

        <div
            x-show="open"

            x-cloak

            @click.away="open = false"

            x-transition

            class="border-t bg-white lg:hidden"
        >


            <div class="flex flex-col py-5">


                {{-- HOME --}}

                <a
                    @click="open = false"

                    href="{{ route('home') }}"

                    class="px-4 py-3 transition hover:bg-orange-50"
                >
                    Home
                </a>


                {{-- MENU --}}

                <a
                    @click="open = false"

                    href="{{ route('home') }}#menu"

                    class="px-4 py-3 transition hover:bg-orange-50"
                >
                    Menu
                </a>


                {{-- ABOUT --}}

                <a
                    @click="open = false"

                    href="/about"

                    class="px-4 py-3 transition hover:bg-orange-50"
                >
                    About
                </a>


                {{-- FRANCHISES --}}

                <a
                    @click="open = false"

                    href="/franchises"

                    class="px-4 py-3 transition hover:bg-orange-50"
                >
                    Franchises
                </a>


                {{-- CONTACT --}}

                <a
                    @click="open = false"

                    href="/contact"

                    class="px-4 py-3 transition hover:bg-orange-50"
                >
                    Contact
                </a>


                {{-- ================================================= --}}
                {{-- MOBILE CART --}}
                {{-- ================================================= --}}

                <a
                    x-show="cartCount > 0"

                    x-cloak

                    @click="open = false"

                    href="{{ route('cart') }}"

                    class="flex items-center justify-between px-4 py-3 font-semibold text-orange-500 transition hover:bg-orange-50"
                >

                    <span class="flex items-center gap-3">

                        <i class="fa-solid fa-cart-shopping"></i>

                        Cart

                    </span>


                    <span
                        x-text="cartCount"

                        class="flex h-6 min-w-6 items-center justify-center rounded-full bg-red-500 px-2 text-xs font-bold text-white"
                    ></span>

                </a>


                {{-- ================================================= --}}
                {{-- ORDER NOW --}}
                {{-- ================================================= --}}

                <div class="px-4 pt-4">

<a @click="open=false"
    href="{{ route('home') }}#menu"
    class="block rounded-xl bg-gradient-to-r from-orange-500 to-red-500 py-3 text-center font-semibold text-white">
    Order Now
</a>

                </div>


            </div>


        </div>


    </div>


</nav>


{{-- ========================================================= --}}
{{-- ALPINE CLOAK --}}
{{-- ========================================================= --}}

<style>

    [x-cloak] {
        display: none !important;
    }

</style>