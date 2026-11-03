<section class="bg-gray-50 py-12 lg:py-16">

    <div class="mx-auto max-w-7xl px-5 sm:px-6 lg:px-8">


        {{-- ================================================= --}}
        {{-- HEADING --}}
        {{-- ================================================= --}}

        <div class="mb-10">

            <span
                class="inline-flex rounded-full bg-orange-100 px-4 py-2 text-sm font-semibold text-orange-600"
            >
                🛒 Shopping Cart
            </span>


            <h1
                class="mt-5 text-3xl font-extrabold text-gray-900 sm:text-4xl"
            >
                Your Cart
            </h1>


            <p class="mt-3 text-gray-600">
                Review your selected items before checkout.
            </p>

        </div>


        {{-- ================================================= --}}
        {{-- EMPTY CART --}}
        {{-- ================================================= --}}

        <template x-if="Object.keys(cart).length === 0">

            <div
                class="rounded-3xl bg-white px-6 py-16 text-center shadow-lg"
            >

                <div class="text-7xl">
                    🛒
                </div>


                <h2
                    class="mt-6 text-2xl font-bold text-gray-900"
                >
                    Your Cart is Empty
                </h2>


                <p
                    class="mx-auto mt-3 max-w-md text-gray-500"
                >
                    You haven't added any products to your cart yet.
                    Explore our menu and choose your favorite food.
                </p>


                <a
                    href="{{ route('home') }}#menu"

                    class="mt-7 inline-flex items-center rounded-2xl bg-gradient-to-r from-orange-500 to-red-500 px-7 py-3 font-semibold text-white shadow-lg transition hover:scale-[1.02]"
                >
                    🍔 Browse Menu
                </a>

            </div>

        </template>


        {{-- ================================================= --}}
        {{-- CART CONTENT --}}
        {{-- ================================================= --}}

        <template x-if="Object.keys(cart).length > 0">

            <div>


                {{-- ================================================= --}}
                {{-- DESKTOP TABLE --}}
                {{-- ================================================= --}}

                <div
                    class="hidden overflow-x-auto rounded-3xl bg-white shadow-lg lg:block"
                >

                    <table class="w-full">

                        <thead class="bg-orange-500 text-white">

                            <tr>

                                <th class="px-6 py-5 text-left">
                                    Product
                                </th>

                                <th class="px-6 py-5 text-center">
                                    Price
                                </th>

                                <th class="px-6 py-5 text-center">
                                    Quantity
                                </th>

                                <th class="px-6 py-5 text-center">
                                    Total
                                </th>

                                <th class="px-6 py-5 text-center">
                                    Action
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            <template
                                x-for="(item, id) in cart"
                                :key="id"
                            >

                                <tr
                                    class="border-b last:border-b-0"
                                >


                                    {{-- PRODUCT --}}

                                    <td class="px-6 py-5">

                                        <div
                                            class="flex items-center gap-4"
                                        >

                                            <template x-if="item.image">

                                                <img
                                                    :src="'/storage/' + item.image"

                                                    :alt="item.name"

                                                    class="h-24 w-24 rounded-2xl object-cover"
                                                >

                                            </template>


                                            <template x-if="!item.image">

                                                <div
                                                    class="flex h-24 w-24 items-center justify-center rounded-2xl bg-orange-50 text-4xl"
                                                >
                                                    🍔
                                                </div>

                                            </template>


                                            <div>

                                                <h3
                                                    x-text="item.name"

                                                    class="text-lg font-bold text-gray-900"
                                                ></h3>

                                            </div>

                                        </div>

                                    </td>


                                    {{-- PRICE --}}

                                    <td
                                        class="px-6 py-5 text-center font-bold text-orange-500"
                                    >

                                        ৳<span
                                            x-text="
                                                Number(item.price)
                                                    .toLocaleString()
                                            "
                                        ></span>

                                    </td>


                                    {{-- QUANTITY --}}

                                    <td class="px-6 py-5">

                                        <div
                                            class="flex justify-center"
                                        >

                                            <div
                                                class="flex items-center rounded-xl border border-gray-200"
                                            >


                                                {{-- MINUS --}}

                                                <button
                                                    type="button"

                                                    @click="
                                                        decrease(id)
                                                    "

                                                    class="flex h-10 w-10 items-center justify-center text-xl font-bold transition hover:bg-orange-50"
                                                >
                                                    −
                                                </button>


                                                {{-- QUANTITY --}}

                                                <span
                                                    x-text="item.quantity"

                                                    class="w-12 text-center font-bold"
                                                ></span>


                                                {{-- PLUS --}}

                                                <button
                                                    type="button"

                                                    @click="
                                                        increase(id)
                                                    "

                                                    class="flex h-10 w-10 items-center justify-center text-xl font-bold text-orange-500 transition hover:bg-orange-50"
                                                >
                                                    +
                                                </button>


                                            </div>

                                        </div>

                                    </td>


                                    {{-- TOTAL --}}

                                    <td
                                        class="px-6 py-5 text-center font-bold text-gray-900"
                                    >

                                        ৳<span
                                            x-text="
                                                (
                                                    Number(item.price) *
                                                    Number(item.quantity)
                                                ).toLocaleString()
                                            "
                                        ></span>

                                    </td>


                                    {{-- REMOVE --}}

                                    <td
                                        class="px-6 py-5 text-center"
                                    >

                                        <button
                                            type="button"

                                            @click="
                                                removeItem(id)
                                            "

                                            class="rounded-xl bg-red-500 px-5 py-2 text-white transition hover:bg-red-600"
                                        >
                                            Remove
                                        </button>

                                    </td>

                                </tr>

                            </template>

                        </tbody>

                    </table>

                </div>


                {{-- ================================================= --}}
                {{-- MOBILE CART --}}
                {{-- ================================================= --}}

                <div class="space-y-5 lg:hidden">

                    <template
                        x-for="(item, id) in cart"
                        :key="id"
                    >

                        <div
                            class="rounded-3xl bg-white p-5 shadow-md"
                        >


                            <div class="flex gap-4">


                                {{-- IMAGE --}}

                                <template x-if="item.image">

                                    <img
                                        :src="'/storage/' + item.image"

                                        :alt="item.name"

                                        class="h-24 w-24 rounded-2xl object-cover"
                                    >

                                </template>


                                <template x-if="!item.image">

                                    <div
                                        class="flex h-24 w-24 items-center justify-center rounded-2xl bg-orange-50 text-4xl"
                                    >
                                        🍔
                                    </div>

                                </template>


                                {{-- INFO --}}

                                <div class="flex-1">

                                    <h3
                                        x-text="item.name"

                                        class="font-bold text-gray-900"
                                    ></h3>


                                    <p
                                        class="mt-2 font-bold text-orange-500"
                                    >

                                        ৳<span
                                            x-text="
                                                Number(item.price)
                                                    .toLocaleString()
                                            "
                                        ></span>

                                    </p>


                                    <p
                                        class="mt-1 text-sm text-gray-500"
                                    >

                                        Item Total:

                                        ৳<span
                                            x-text="
                                                (
                                                    Number(item.price) *
                                                    Number(item.quantity)
                                                ).toLocaleString()
                                            "
                                        ></span>

                                    </p>

                                </div>

                            </div>


                            {{-- ACTIONS --}}

                            <div
                                class="mt-5 flex items-center justify-between gap-3"
                            >


                                {{-- QUANTITY --}}

                                <div
                                    class="flex items-center rounded-xl border border-gray-200"
                                >


                                    <button
                                        type="button"

                                        @click="
                                            decrease(id)
                                        "

                                        class="flex h-10 w-10 items-center justify-center text-xl font-bold"
                                    >
                                        −
                                    </button>


                                    <span
                                        x-text="item.quantity"

                                        class="w-10 text-center font-bold"
                                    ></span>


                                    <button
                                        type="button"

                                        @click="
                                            increase(id)
                                        "

                                        class="flex h-10 w-10 items-center justify-center text-xl font-bold text-orange-500"
                                    >
                                        +
                                    </button>

                                </div>


                                {{-- REMOVE --}}

                                <button
                                    type="button"

                                    @click="
                                        removeItem(id)
                                    "

                                    class="rounded-xl bg-red-500 px-4 py-2 text-sm font-semibold text-white"
                                >
                                    Remove
                                </button>

                            </div>

                        </div>

                    </template>

                </div>

            </div>

        </template>

    </div>

</section>