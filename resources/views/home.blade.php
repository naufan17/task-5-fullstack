@extends('layouts.app')

@section('content')

<div class="p-8 mx-auto sm:max-w-xl md:max-w-full lg:max-w-screen-xl md:px-16 lg:p-12">
    <div class="grid gap-10 grid-cols-1 md:grid-cols-2 lg:grid-cols-3 sm:max-w-sm sm:mx-auto md:max-w-full lg:max-w-full">
        @foreach($posts as $post)
        <div class="overflow-hidden duration-300 bg-white rounded shadow-sm border border-gray-400 drop-shadow">
            <img src="{{ URL::to('/') }}/image/{{ $post->image }}" class="object-cover w-full h-64" alt="" />
            <div class="p-4">
                <p class="mb-3 text-sm font-semibold tracking-wide">
                    <span class="text-purple-700">{{ $post->name }}</span>
                    <span class="text-purple-700">{{ date("d-m-Y", strtotime($post->created_at)) }}</span>
                </p>
                <h2 href="/" aria-label="Category" title="Visit the East" class="inline-block mb-3 text-2xl font-bold leading-5 transition-colors duration-200 hover:text-deep-purple-accent-700">
                    {{ $post->title }}
                </h2>
                <p class="mb-2 text-gray-700">
                    {{ mb_strimwidth($post->content, 0, 200, "...") }}
                </p>
                <a href="/post/{{ $post->id }}" aria-label="" class="inline-flex items-center font-semibold transition-colors duration-200 text-deep-purple-accent-400 hover:text-deep-purple-800">Learn more</a>
            </div>
        </div>
        @endforeach
    </div>
</div>
<div class="p-8 mx-auto sm:max-w-xl md:max-w-full lg:max-w-screen-xl md:px-16 lg:p-12">
    {{ $posts->links() }}
</div>

@endsection