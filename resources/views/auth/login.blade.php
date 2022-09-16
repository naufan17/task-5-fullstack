@extends('layouts.app')

@section('content')

<div class="px-4 py-16 mx-auto sm:max-w-xl md:max-w-full lg:max-w-screen-xl md:px-24 lg:px-8 lg:py-20">
    <div class="flex flex-col items-center justify-center">
        <div class="w-full max-w-xl xl:px-8 xl:w-5/12">
            <div class="relative">
                <div class="relative bg-white border border-gray-400 drop-shadow sm:overflow-hidden sm:rounded-md p-7 sm:p-10">
                    <h3 class="mb-4 text-xl font-semibold sm:text-center sm:mb-6 sm:text-2xl">
                        Login
                    </h3>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-4 sm:mb-8">
                            <label for="email" class="inline-block mb-1 font-medium">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror flex-grow w-full h-10 p-2 rounded-md border bg-white py-2 px-3 sm:text-sm" id="email" name="email" required autocomplete="email"/>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-4 sm:mb-8">
                            <label for="password" class="inline-block mb-1 font-medium">Password</label>
                            <input  type="password" class="form-control @error('password') is-invalid @enderror flex-grow w-full h-10 p-2 rounded-md border bg-white py-2 px-3 sm:text-sm" id="password" name="password" required autocomplete="password"/>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-4 sm:mb-8">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                        <div class="mt-6 mb-2 sm:mb-4">
                            <button type="submit" class="inline-flex items-center justify-center w-full h-10 px-6 rounded-md border border-transparent bg-indigo-500 text-sm font-semibold text-white tracking-wider hover:bg-indigo-600">
                                Login
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection