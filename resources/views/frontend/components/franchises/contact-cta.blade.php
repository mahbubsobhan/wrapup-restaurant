@php
    $phone = '88017XXXXXXXX'; // আপনার WhatsApp নম্বর (+ ছাড়া)

    $message = "Hello WrapUp Team,\n\n"
        . "I'm interested in opening a WrapUp Franchise.\n\n"
        . "My Details:\n\n"
        . "Name:\n"
        . "Phone:\n"
        . "City:\n"
        . "Investment Budget:\n\n"
        . "Looking forward to hearing from you.\n\n"
        . "Thank you.";
@endphp

<section id="contact"
    class="relative overflow-hidden bg-gradient-to-r from-orange-500 via-orange-600 to-red-500">

    <!-- Background Blur -->
    <div class="absolute -top-24 -right-24 h-72 w-72 rounded-full bg-white/10 blur-3xl"></div>
    <div class="absolute -bottom-24 -left-24 h-72 w-72 rounded-full bg-yellow-300/10 blur-3xl"></div>

    <div class="relative max-w-4xl mx-auto px-5 sm:px-6 lg:px-8 py-16 text-center">

        <!-- Badge -->
        <span
            class="inline-flex items-center gap-2 rounded-full bg-white/20 px-4 py-2 text-sm font-semibold text-white">
            <i class="fa-solid fa-store"></i>
            Become Our Franchise Partner
        </span>

        <!-- Heading -->
        <h2 class="mt-6 text-3xl sm:text-4xl lg:text-5xl font-extrabold text-white">

            Ready To Start Your
            <span class="block">
                WrapUp Franchise?
            </span>

        </h2>

        <!-- Description -->
        <p class="mt-5 max-w-2xl mx-auto text-base sm:text-lg leading-8 text-orange-100">

            Contact our franchise team today. We'll guide you through the entire
            process and answer all your questions.

        </p>

        <!-- Contact Cards -->
        <div class="mt-10 grid grid-cols-1 sm:grid-cols-3 gap-5">

            <!-- Phone -->
            <div class="rounded-2xl bg-white p-6 shadow-xl">

                <div
                    class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-orange-100">

                    <i class="fa-solid fa-phone text-2xl text-orange-500"></i>

                </div>

                <h3 class="mt-4 font-bold text-gray-900">

                    Call Us

                </h3>

                <p class="mt-2 text-gray-600">

                    +880 1700-000000

                </p>

            </div>

            <!-- WhatsApp -->
            <div class="rounded-2xl bg-white p-6 shadow-xl">

                <div
                    class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-orange-100">

                    <i class="fa-brands fa-whatsapp text-2xl text-orange-500"></i>

                </div>

                <h3 class="mt-4 font-bold text-gray-900">

                    WhatsApp

                </h3>

                <p class="mt-2 text-gray-600">

                    Quick Response

                </p>

            </div>

            <!-- Location -->
            <div class="rounded-2xl bg-white p-6 shadow-xl">

                <div
                    class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-orange-100">

                    <i class="fa-solid fa-location-dot text-2xl text-orange-500"></i>

                </div>

                <h3 class="mt-4 font-bold text-gray-900">

                    Location

                </h3>

                <p class="mt-2 text-gray-600">

                    Chattogram, Bangladesh

                </p>

            </div>

        </div>

        <!-- CTA Buttons -->
        <div class="mt-10 flex flex-col sm:flex-row justify-center gap-4">

            <!-- WhatsApp -->
            <a href="https://wa.me/{{ $phone }}?text={{ urlencode($message) }}"
                target="_blank"
                class="inline-flex items-center justify-center gap-3 rounded-xl bg-green-500 px-8 py-4 font-semibold text-white shadow-xl transition duration-300 hover:bg-green-600">

                <i class="fa-brands fa-whatsapp text-xl"></i>

                Apply via WhatsApp

            </a>

            <!-- Call -->
            <a href="tel:+8801700000000"
                class="inline-flex items-center justify-center gap-3 rounded-xl border-2 border-white px-8 py-4 font-semibold text-white transition duration-300 hover:bg-white hover:text-orange-600">

                <i class="fa-solid fa-phone"></i>

                Call Now

            </a>

        </div>

    </div>

</section>