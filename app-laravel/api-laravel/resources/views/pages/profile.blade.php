@extends('layout')

@section('content')
    <div class="w-full md:w-1/3 sm:w-full">
        <div class="bg-gray-800 rounded-lg shadow-sm p-6 border border-gray-700 text-center">
            @if(session('status'))
                <div class="bg-green-900 border-l-4 border-green-500 text-green-100 p-4 mb-4">
                    {{session('status')}}
                </div>
            @endif
            <h3 class="text-xl font-semibold mb-4 text-gray-100">My profile</h3>
            @include('admin.errors')

            <img src="{{$user->getImage()}}" alt="" class="w-32 h-32 object-cover rounded-full mx-auto mb-6">

            <form class="text-left" role="form" method="post" action="/profile" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="mb-4">
                    <input type="text"
                           class="w-full px-4 py-2 border border-gray-600 bg-gray-700 text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                           id="name" name="name"
                           placeholder="Name" value="{{$user->name}}">
                </div>
                <div class="mb-4">
                    <input type="email"
                           class="w-full px-4 py-2 border border-gray-600 bg-gray-700 text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                           id="email" name="email"
                           placeholder="Email" value="{{$user->email}}">
                </div>
                <div class="mb-4">
                    <input type="password"
                           class="w-full px-4 py-2 border border-gray-600 bg-gray-700 text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                           id="password" name="password"
                           placeholder="Password">
                </div>
                <div class="mb-6">
                    <label class="block text-gray-300 text-sm font-bold mb-2" for="image">
                        Profile Image
                    </label>
                    <input type="file"
                           class="w-full px-3 py-2 border border-gray-600 bg-gray-700 text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm"
                           id="image" name="avatar">
                </div>
                <button type="submit"
                        class="w-full bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-md transition duration-200 font-medium">
                    Update
                </button>
            </form>
        </div>
    </div>
@endsection
