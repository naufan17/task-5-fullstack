@extends('layouts.app')

@section('content')

<div class="p-8 mx-auto sm:max-w-xl md:max-w-full lg:max-w-screen-xl md:px-16 lg:p-12">
    <div class="grid gap-10 lg:grid-cols-3 sm:max-w-xl sm:mx-auto lg:max-w-full">
        <div class="md:col-span-1 md:mt-0">
            <div class="px-0">
                <h3 class="text-lg font-semibold leading-6 text-gray-600">Create Category</h3>            
            </div>
        </div>
        <div class="md:col-span-2 md:mt-0">
            <form action="{{ url('/categories/store') }}" method="POST">
                @csrf
                <div class="border border-gray-400 drop-shadow sm:overflow-hidden sm:rounded-md">
                    <div class="space-y-12 bg-white px-8 py-12 sm:p-12">
                        <div>
                            <label for="name" class="block text-sm font-semibold text-gray-600">Name</label>
                            <input type="text" name="name" id="name" class="mt-2 block w-full h-10 p-2 rounded-md border bg-white py-2 px-3 sm:text-sm">
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