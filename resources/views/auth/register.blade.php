@extends('layouts.app')

@section('content')

<div class="px-4 py-16 mx-auto sm:max-w-xl md:max-w-full lg:max-w-screen-xl md:px-24 lg:px-8 lg:py-20">
    <div class="flex flex-col items-center justify-center">
        <div class="w-full max-w-xl xl:px-8 xl:w-5/12">
            <div class="relative">
                <div class="relative bg-white border border-gray-400 drop-shadow sm:overflow-hidden sm:rounded-md p-7 sm:p-10">
                    <h3 class="mb-4 text-xl font-semibold sm:text-center sm:mb-6 sm:text-2xl">
                        Register
                    </h3>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="mb-4 sm:mb-8">
                            <label for="name" class="inline-block mb-1 font-medium">Name</label>
                            <input type="text" id="name" name="name" required autocomplete="name" class="form-control @error('name') is-invalid @enderror flex-grow w-full h-10 p-2 rounded-md border bg-white py-2 px-3 sm:text-sm"/>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-4 sm:mb-8">
                            <label for="email" class="inline-block mb-1 font-medium">Email</label>
                            <input type="email" id="email" name="email" required autocomplete="email" class="form-control @error('email') is-invalid @enderror flex-grow w-full h-10 p-2 rounded-md border bg-white py-2 px-3 sm:text-sm"/>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-4 sm:mb-8">
                            <label for="password" class="inline-block mb-1 font-medium">Password</label>
                            <input  type="password" id="password" name="password" required autocomplete="password" class="form-control @error('password') is-invalid @enderror flex-grow w-full h-10 p-2 rounded-md border bg-white py-2 px-3 sm:text-sm"/>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-4 sm:mb-8">
                            <label for="password-confirm" class="inline-block mb-1 font-medium">Password Confirm</label>
                            <input type="password" id="password-confirm" name="password-confirm" required autocomplete="password-confirm" class="flex-grow w-full h-10 p-2 rounded-md border bg-white py-2 px-3 sm:text-sm"/>
                        </div>
                        <div class="mt-8 mb-2 sm:mb-4">
                            <button type="submit" class="inline-flex items-center justify-center w-full h-10 px-6 rounded-md border border-transparent bg-indigo-500 text-sm font-semibold text-white tracking-wider hover:bg-indigo-600">
                                Register
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
