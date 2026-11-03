@extends('frontend.layouts.app')

@section('title', 'Product Details')

@section('content')

@include('frontend.components.product.product-images')

@include('frontend.components.product.product-info')

@include('frontend.components.product.product-description')
@include('frontend.components.product.product-tabs')
@include('frontend.components.product.related-products')

@endsection