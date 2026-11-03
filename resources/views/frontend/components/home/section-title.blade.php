@props([
    'title',
    'subtitle'
])

<div class="text-center mb-16">

    <span class="uppercase tracking-[5px] text-orange-500 font-semibold">
        {{ $subtitle }}
    </span>

    <h2 class="mt-4 text-4xl lg:text-5xl font-bold">
        {{ $title }}
    </h2>

</div>