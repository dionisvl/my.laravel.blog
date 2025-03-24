@extends('layout')

@section('content')
    <div class="w-full md:w-3/4 pr-0 md:pr-6">
        <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
            <h3 class="text-xl font-semibold mb-4">Register</h3>
            @include('admin.errors')

            <form class="mt-4" role="form" method="post" action="/register">
                {{csrf_field()}}
                <x-inputs.honeypot/>
                <x-inputs.countme/>

                <div class="mb-4">
                    <input type="text"
                           class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                           id="name" name="name"
                           placeholder="Name" value="{{old('name')}}">
                </div>

                <div class="mb-4">
                    <input type="text"
                           class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                           id="email" name="email"
                           placeholder="Email" value="{{old('email')}}">
                </div>

                <div class="mb-6">
                    <input type="password"
                           class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                           id="password" name="password"
                           placeholder="Password" onkeyup="count_keyup()">
                </div>

                <button type="submit"
                        class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-6 rounded-md transition duration-200 font-medium">
                    Register
                </button>
            </form>
        </div>
    </div>
    @include('pages._sidebar')
@endsection
