@extends('frontend.layouts.app')

@section('title', 'Contact Us')

@section('content')

@include('frontend.components.contact.contact-banner')

@include('frontend.components.contact.contact-info')

@include('frontend.components.contact.contact-form')

@include('frontend.components.contact.google-map')

@endsection