@extends('layouts.app')

@section('content')

<div class="p-8 mx-auto sm:max-w-xl md:max-w-full lg:max-w-screen-xl md:px-16 lg:p-12">
    <div class="inline-block min-w-full overflow-hidden border border-gray-400 drop-shadow sm:overflow-hidden sm:rounded-md">
        <table class="min-w-full leading-normal">
            <thead class="border-b-2">
                <tr>
                    <th scope="col" class="px-5 py-3 bg-gray-100 border-b border-gray-200 text-gray-800  text-left text-md font-semibold">
                        Name
                    </th>
                    <th scope="col" class="px-5 py-3 bg-gray-100 border-b border-gray-200 text-gray-800  text-left text-md font-semibold">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                <tr>
                    <td class="px-5 py-3 border-b border-gray-200 bg-white text-md">
                        <div class="flex items-center">
                            <p class="text-gray-900 whitespace-no-wrap">
                                {{ $category->name }}
                            </p>
                        </div>
                    </td>
                    <td class="px-5 py-3 border-b border-gray-200 bg-white text-md">
                        <a href="/categories/edit/{{ $category->id }}" class="font-semibold text-green-600 hover:text-green-500">
                            Edit
                        </a>
                        <a href="/categories/delete/{{ $category->id }}" class="ml-4 font-semibold text-red-600 hover:text-red-500">
                            Delete
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="p-8 mx-auto sm:max-w-xl md:max-w-full lg:max-w-screen-xl md:px-16 lg:p-12">
    {{ $categories->links() }}
</div>

@endsection