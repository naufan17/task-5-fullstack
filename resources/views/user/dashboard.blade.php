@extends('layouts.app')

@section('content')

<div class="px-4 py-16 mx-auto sm:max-w-xl md:max-w-full lg:max-w-screen-xl md:px-24 lg:px-8 lg:py-20">
    <div class="mb-16 md:mb-0 md:max-w-xl sm:mx-auto md:text-center">
        <h2 class="mb-5 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl sm:leading-none">
            Hello User {{auth()->user()->name}}
        </h2>
        <p class="mb-5 text-base text-gray-700 md:text-lg">
            Add Posts and Categories by pressing the button below 
        </p>
        <div class="flex items-center md:justify-center">
            <a href="/posts/create" class="inline-flex items-center justify-center h-10 px-6 mr-6 rounded-md border border-transparent bg-indigo-500 text-sm font-semibold text-white tracking-wider hover:bg-indigo-600">
                Create Post
            </a>
            <a href="/categories/create" class="inline-flex items-center justify-center h-10 px-6 mr-6 rounded-md border border-transparent bg-indigo-500 text-sm font-semibold text-white tracking-wider hover:bg-indigo-600">
                Create Category
            </a>
        </div>
    </div>
</div>
@endsection
