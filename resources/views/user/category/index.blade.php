@extends('layouts.app')

@section('content')

<div class="p-8 mx-auto sm:max-w-xl md:max-w-full lg:max-w-screen-xl md:px-16 lg:p-12">
    <div class="inline-block min-w-full overflow-hidden border border-gray-400 drop-shadow sm:overflow-hidden sm:rounded-md">
        <table class="min-w-full leading-normal">
            <thead class="border-b-2">
                <tr>
                    <th scope="col" class="px-5 py-3 bg-gray-100 border-b border-gray-200 text-gray-800  text-left text-sm font-semibold">
                        Name
                    </th>
                    <th scope="col" class="px-5 py-3 bg-gray-100 border-b border-gray-200 text-gray-800  text-left text-sm font-semibold">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    @foreach($categories as $category)
                    <td class="px-5 py-3 border-b border-gray-200 bg-white text-sm">
                        <div class="flex items-center">
                            <div class="ml-3">
                                <p class="text-gray-900 whitespace-no-wrap">
                                    {{ $category->name }}
                                </p>
                            </div>
                        </div>
                    </td>
                    <td class="px-5 py-3 border-b border-gray-200 bg-white text-sm">
                        <a href="#" class="font-semibold text-green-600 hover:text-green-500">
                            Edit
                        </a>
                        <a href="#" class="ml-4 font-semibold text-red-600 hover:text-red-500">
                            Delete
                        </a>
                    </td>
                    @endforeach
                </tr>
            </tbody>
        </table>
        {{ $categories->links() }}
    </div>
</div>

@endsection