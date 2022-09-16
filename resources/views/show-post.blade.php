@extends('layouts.app')

@section('content')

<div class="p-8 mx-auto sm:max-w-xl md:max-w-full lg:max-w-screen-xl md:px-16 lg:p-12">
    <div class="max-w-xl mb-10 md:mx-auto sm:text-center lg:max-w-2xl md:mb-12">
        <h2 class="max-w-lg mb-6 text-3xl font-bold leading-none tracking-tight text-gray-900 sm:text-4xl md:mx-auto">
            {{ $post->title }}
        </h2>
        <p class="mb-3 text-md font-semibold tracking-wide uppercase">
            <span class="text-blue-gray-900">Traveling</span>
            <span class="text-gray-600">— 28 Dec 2020</span>
        </p>
    </div>
    <div class="mx-auto lg:max-w-2xl">
        <div class="relative w-full transition-shadow duration-300 hover:shadow-xl">
            <img class="object-cover w-full h-56 rounded shadow-lg sm:h-64 md:h-80 lg:h-96" src="{{ URL::to('/') }}/image/{{ $post->image }}" alt="" />
        </div>
    </div>
    <div class="mt-12 mb-10 mx-auto lg:max-w-4xl md:mb-12">
        <p class="text-base text-gray-700 md:text-lg">
            {{ $post->content }}
        </p>
    </div>
</div>

@endsection