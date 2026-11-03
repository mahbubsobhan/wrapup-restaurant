<section class="py-16 bg-gray-50">

    <div class="max-w-7xl mx-auto px-5 sm:px-6 lg:px-8">

        <div x-data="{ tab: 'description' }">

            <!-- Tabs -->

            <div class="flex flex-wrap justify-center gap-3 border-b border-gray-200 pb-5">

                <button
                    @click="tab='description'"
                    :class="tab==='description'
                        ? 'bg-orange-500 text-white'
                        : 'bg-white text-gray-700 hover:bg-orange-50'"
                    class="rounded-xl px-6 py-3 font-semibold transition">

                    Description

                </button>

                <button
                    @click="tab='additional'"
                    :class="tab==='additional'
                        ? 'bg-orange-500 text-white'
                        : 'bg-white text-gray-700 hover:bg-orange-50'"
                    class="rounded-xl px-6 py-3 font-semibold transition">

                    Additional Info

                </button>

                <button
                    @click="tab='reviews'"
                    :class="tab==='reviews'
                        ? 'bg-orange-500 text-white'
                        : 'bg-white text-gray-700 hover:bg-orange-50'"
                    class="rounded-xl px-6 py-3 font-semibold transition">

                    Reviews (245)

                </button>

            </div>

            <!-- Description -->

            <div
                x-show="tab==='description'"
                x-transition
                class="mt-8 rounded-3xl bg-white p-8 shadow-sm">

                <h3 class="text-2xl font-bold text-gray-900">

                    Product Description

                </h3>

                <p class="mt-5 leading-8 text-gray-600">

                    Our Classic Beef Burger is made using premium quality beef,
                    fresh vegetables, cheddar cheese and our signature homemade sauce.
                    Every burger is freshly cooked after your order to ensure the
                    best taste and quality.

                </p>

                <p class="mt-5 leading-8 text-gray-600">

                    Perfect for takeaway or home delivery. Pair it with fries
                    and a cold drink for the ultimate meal.

                </p>

            </div>

            <!-- Additional Information -->

            <div
                x-show="tab==='additional'"
                x-transition
                class="mt-8 overflow-hidden rounded-3xl bg-white shadow-sm">

                <table class="w-full">

                    <tbody>

                        <tr class="border-b">

                            <td class="w-1/3 p-5 font-semibold">

                                Category

                            </td>

                            <td class="p-5 text-gray-600">

                                Burger

                            </td>

                        </tr>

                        <tr class="border-b">

                            <td class="p-5 font-semibold">

                                Weight

                            </td>

                            <td class="p-5 text-gray-600">

                                350g

                            </td>

                        </tr>

                        <tr class="border-b">

                            <td class="p-5 font-semibold">

                                Preparation Time

                            </td>

                            <td class="p-5 text-gray-600">

                                15 Minutes

                            </td>

                        </tr>

                        <tr>

                            <td class="p-5 font-semibold">

                                Delivery

                            </td>

                            <td class="p-5 text-gray-600">

                                25–30 Minutes

                            </td>

                        </tr>

                    </tbody>

                </table>

            </div>

            <!-- Reviews -->

            <div
                x-show="tab==='reviews'"
                x-transition
                class="mt-8 space-y-6">

                <!-- Review 1 -->

                <div class="rounded-3xl bg-white p-6 shadow-sm">

                    <div class="flex items-center justify-between">

                        <div>

                            <h4 class="font-bold">

                                John Smith

                            </h4>

                            <p class="text-sm text-gray-500">

                                Verified Customer

                            </p>

                        </div>

                        <div class="text-yellow-400">

                            ⭐⭐⭐⭐⭐

                        </div>

                    </div>

                    <p class="mt-4 leading-7 text-gray-600">

                        Amazing burger! Fresh ingredients, quick delivery and
                        excellent taste. Highly recommended.

                    </p>

                </div>

                <!-- Review 2 -->

                <div class="rounded-3xl bg-white p-6 shadow-sm">

                    <div class="flex items-center justify-between">

                        <div>

                            <h4 class="font-bold">

                                Sarah Khan

                            </h4>

                            <p class="text-sm text-gray-500">

                                Verified Customer

                            </p>

                        </div>

                        <div class="text-yellow-400">

                            ⭐⭐⭐⭐⭐

                        </div>

                    </div>

                    <p class="mt-4 leading-7 text-gray-600">

                        One of the best burgers I've had. The takeaway service
                        was fast and the food arrived hot.

                    </p>

                </div>

            </div>

        </div>

    </div>

</section>