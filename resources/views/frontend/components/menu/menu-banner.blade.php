Menu Banner 
<section
    x-data="{ active: 'burger' }"
    class="sticky top-20 z-40 bg-white/95 backdrop-blur border-b border-orange-100 shadow-sm">

    <div class="max-w-7xl mx-auto">

        <div
            class="flex overflow-x-auto whitespace-nowrap gap-3 px-4 py-3 scrollbar-hide">

            <!-- Burger -->

            <button
                @click="active='burger'"
                :class="active==='burger'
                    ? 'bg-orange-500 text-white'
                    : 'bg-orange-100 text-orange-600'"
                class="flex-shrink-0 rounded-full px-5 py-3 font-semibold transition">

                🍔 

            </button>

            <!-- Wrap -->

            <button
                @click="active='wrap'"
                :class="active==='wrap'
                    ? 'bg-orange-500 text-white'
                    : 'bg-orange-100 text-orange-600'"
                class="flex-shrink-0 rounded-full px-5 py-3 font-semibold transition">

                🌯 Wrap

            </button>

            <!-- Chicken -->

            <button
                @click="active='chicken'"
                :class="active==='chicken'
                    ? 'bg-orange-500 text-white'
                    : 'bg-orange-100 text-orange-600'"
                class="flex-shrink-0 rounded-full px-5 py-3 font-semibold transition">

                🍗 Chicken

            </button>

            <!-- Fries -->

            <button
                @click="active='fries'"
                :class="active==='fries'
                    ? 'bg-orange-500 text-white'
                    : 'bg-orange-100 text-orange-600'"
                class="flex-shrink-0 rounded-full px-5 py-3 font-semibold transition">

                🍟 Fries

            </button>

            <!-- Drinks -->

            <button
                @click="active='drinks'"
                :class="active==='drinks'
                    ? 'bg-orange-500 text-white'
                    : 'bg-orange-100 text-orange-600'"
                class="flex-shrink-0 rounded-full px-5 py-3 font-semibold transition">

                🥤 Drinks

            </button>

        </div>

    </div>

</section>

