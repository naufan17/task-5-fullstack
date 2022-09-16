@extends('layouts.app')

@section('content')

<div class="p-8 mx-auto sm:max-w-xl md:max-w-full lg:max-w-screen-xl md:px-16 lg:p-12">
    <div class="grid gap-10 lg:grid-cols-3 sm:max-w-sm sm:mx-auto lg:max-w-full">
        @foreach($posts as $post)
        <div class="overflow-hidden duration-300 bg-white rounded shadow-sm border border-gray-400 drop-shadow">
            <img src="https://images.pexels.com/photos/2408666/pexels-photo-2408666.jpeg?auto=compress&amp;cs=tinysrgb&amp;dpr=2&amp;w=500" class="object-cover w-full h-64" alt="" />
            <div class="p-4">
                <p class="mb-3 text-xs font-semibold tracking-wide uppercase">
                    <a href="/" class="transition-colors duration-200 text-blue-gray-900 hover:text-deep-purple-accent-700" aria-label="Category" title="traveling">traveling</a>
                    <span class="text-gray-600">— 28 Dec 2020</span>
                </p>
                <h2 class="inline-block mb-3 text-2xl font-bold leading-5">
                    {{ $post->title }}
                </h2>
                <p class="mb-2 text-gray-700">
                    {{ $post->content }}
                </p>
                <a href="/post/{{ $post->id }}" class="inline-flex items-center font-semibold bg-blue-50 py-2 px-3 rounded text-blue-600 hover:bg-blue-100">Detail</a>
                <a href="/posts/update/{{ $post->id }}" class="ml-2 inline-flex items-center font-semibold bg-green-50 py-2 px-3 rounded text-green-600 hover:bg-green-100">Edit</a>
                <a href="/posts/delete/{{ $post->id }}" class="ml-2 inline-flex items-center font-semibold bg-red-50 py-2 px-3 rounded text-red-600 hover:bg-red-100">Delete</a>
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection