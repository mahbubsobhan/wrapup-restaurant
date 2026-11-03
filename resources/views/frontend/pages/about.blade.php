@extends('frontend.layouts.app')

@section('title', 'About Us')

@section('content')

@include('frontend.components.about.about-banner')

@include('frontend.components.about.our-story')

@include('frontend.components.about.our-values')

@include('frontend.components.about.our-team')

@endsection