@extends('web.layout.app')

@section('content')
    @include('web.components.hero')

    <!-- Quick Highlights Section -->
    @include('web.components.highlights')

    <!-- About the Villa Section -->
    @include('web.components.about')

    <!-- Rooms Section -->
    @include('web.components.rooms')

    @include('web.components.gallery')

    <!-- Location Section -->
    @include('web.components.location')

    <!-- Guest Reviews Section -->
    @include('web.components.reviews')

    <!-- Contact Section -->
    @include('web.components.contact')
@endsection