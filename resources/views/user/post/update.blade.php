@extends('layouts.app')

@section('content')

<div class="p-8 mx-auto sm:max-w-xl md:max-w-full lg:max-w-screen-xl md:px-16 lg:p-12">
    <div class="grid gap-10 lg:grid-cols-3 sm:max-w-xl sm:mx-auto lg:max-w-full">
        <div class="md:col-span-1 md:mt-0">
            <div class="px-0">
                <h3 class="text-lg font-semibold leading-6 text-gray-600">Update Post</h3>            
            </div>
        </div>
        <div class="md:col-span-2 md:mt-0">
            <form action="{{ url('/posts/update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="border border-gray-400 drop-shadow sm:overflow-hidden sm:rounded-md">
                    <div class="space-y-12 bg-white px-8 py-12 sm:p-12">
                        <div>
                            <input type="hidden" name="id" value="{{ $post->id }}">
                            <label for="title" class="block text-sm font-semibold text-gray-700">Title</label>
                            <input type="text" name="title" id="title" value="{{ $post->title }}" class="mt-2 block w-full h-10 p-2 rounded-md border bg-white py-2 px-3 sm:text-sm">
                        </div>
                        <div>
                            <label for="content" class="block text-sm font-semibold text-gray-700">Content</label>
                            <textarea id="content" name="content" rows="3" class="mt-2 block w-full h-40 p-2 rounded-md border bg-white py-2 px-3 sm:text-sm">{{ $post->content }}</textarea>
                        </div>
                        <div>
                            <label for="category" class="block text-sm font-semibold text-gray-700">Category</label>
                            <select id="category" name="category_id" class="mt-2 block w-full h-10 p-2 rounded-md border bg-white py-2 px-3 sm:text-sm">
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700">Image</label>
                            <div class="mt-2 flex justify-center rounded-md border-2 border-dashed border-gray-300 px-6 pt-5 pb-6">
                                <div class="space-y-1 text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <p>Upload a file or drag and drop</p>
                                    <div class="flex text-sm justify-content-center text-gray-600">
                                        <label for="file-upload" class="relative cursor-pointer">
                                            <span for="file-upload" class="sr-only">Choose profile photo</span>
                                            <input type="file" name="image" class="block w-full text-sm text-slate-500 file:mr-4 file:ml-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-violet-50 file:text-violet-700 hover:file:bg-violet-100" required="required"/>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">
                        <button type="submit" class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-500 py-2 px-4 text-sm font-semibold text-white tracking-wider hover:bg-indigo-600">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection