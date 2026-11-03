@extends('frontend.layouts.app')

@section('content')

    @include('frontend.components.home.hero')

    <section id="menu" class="scroll-mt-24">
        @include('frontend.components.home.categories', [
            'categories' => $categories
        ])
    </section>

    @include('frontend.components.home.featured-products', [
        'products' => $products
    ])

    @include('frontend.components.home.why-choose')

    @include('frontend.components.home.testimonials')

    @include('frontend.components.home.newsletter')

    @include('frontend.components.home.location')

@endsection