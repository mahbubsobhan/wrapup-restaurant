<section class="bg-gray-50 py-6">

    <div class="max-w-7xl mx-auto px-5 sm:px-6 lg:px-8">

        <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">

            <!-- Search -->

            <div class="relative w-full lg:max-w-xl">

                <input
                    type="text"
                    placeholder="Search burgers, wraps, chicken..."
                    class="w-full rounded-2xl border border-gray-200 bg-white py-4 pl-14 pr-4 text-gray-700 outline-none transition focus:border-orange-500 focus:ring-4 focus:ring-orange-100">

                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="absolute left-5 top-1/2 h-5 w-5 -translate-y-1/2 text-gray-400"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor">

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M21 21l-4.35-4.35m1.85-5.15a7 7 0 11-14 0a7 7 0 0114 0z" />

                </svg>

            </div>

            <!-- Filters -->

            <div class="flex flex-col gap-3 sm:flex-row">

                <select
                    class="rounded-2xl border border-gray-200 bg-white px-5 py-4 text-gray-700 outline-none transition focus:border-orange-500">

                    <option>Sort By</option>
                    <option>Popular</option>
                    <option>Newest</option>
                    <option>Price Low To High</option>
                    <option>Price High To Low</option>

                </select>

                <select
                    class="rounded-2xl border border-gray-200 bg-white px-5 py-4 text-gray-700 outline-none transition focus:border-orange-500">

                    <option>Price Range</option>
                    <option>Under ৳200</option>
                    <option>৳200 - ৳500</option>
                    <option>৳500 - ৳1000</option>
                    <option>Above ৳1000</option>

                </select>

            </div>

        </div>

    </div>

</section>