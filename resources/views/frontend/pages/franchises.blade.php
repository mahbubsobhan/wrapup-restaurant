@extends('frontend.layouts.app')

@section('title', 'Franchises')

@section('content')
@include('frontend.components.franchises.hero')
@include('frontend.components.franchises.why-choose')

@include('frontend.components.franchises.process')
@include('frontend.components.franchises.contact-cta')





@endsection