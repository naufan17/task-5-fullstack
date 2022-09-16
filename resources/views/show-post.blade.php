@extends('layouts.app')

@section('content')

<div class="p-8 mx-auto sm:max-w-xl md:max-w-full lg:max-w-screen-xl md:px-16 lg:p-12">
    <div class="max-w-xl mb-10 md:mx-auto sm:text-center lg:max-w-2xl md:mb-12">
        <h2 class="max-w-lg mb-6 font-sans text-3xl font-bold leading-none tracking-tight text-gray-900 sm:text-4xl md:mx-auto">
            {{ $post->title }}
        </h2>
        <p class="text-base text-gray-700 md:text-lg">
            Traveling - 26 DES 2020
        </p>
    </div>
    <div class="mx-auto lg:max-w-2xl">
        <div class="relative w-full transition-shadow duration-300 hover:shadow-xl">
            <img class="object-cover w-full h-56 rounded shadow-lg sm:h-64 md:h-80 lg:h-96" src="https://images.pexels.com/photos/927022/pexels-photo-927022.jpeg?auto=compress&amp;cs=tinysrgb&amp;dpr=3&amp;h=750&amp;w=1260" alt="" />
        </div>
    </div>
    <div class="max-w-xl mt-12 mb-10 md:mx-auto sm:text-center lg:max-w-2xl md:mb-12">
        <p class="text-base text-gray-700 md:text-lg">
            {{ $post->content }}
        </p>
    </div>
</div>

@endsection